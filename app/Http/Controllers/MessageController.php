<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnValue;

class MessageController extends Controller
{
    public function forwardMessage(User $player, Request $request)
    {
        $body=$request->input("message");
        $playerId=$player->id;

        $message=Auth::user()->forwardMessageTo($playerId,$body);

        return view("players.show",compact("message","player"));
    }

    public function retrieveConversation (User $player, Request $request)
    {
        $userSelection = $request->input("playername");
        $players = $player->latest()->get();
        $currentUserId = Auth::id();

        $messageHistory = Message::query()
            ->whereHas("sender", function ($q) use ($currentUserId,$userSelection){
                $q->where("sender_id","=",$currentUserId)
                    ->Where("receiver_id","=",$userSelection);
            })
            ->orWhereHas("receiver", function ($q) use ($currentUserId,$userSelection){
                $q->where("sender_id","=", $userSelection)
                    ->Where("receiver_id","=",$currentUserId);
            })
            ->orderBy("created_at","asc")
            ->get();

        return view("players.showconvo",compact("messageHistory","players"));
    }

    public function retrieveMessages(User $player)
    {
        $currentUserId = Auth::id();

        $conversations= User::query()
            ->whereHas("sent", function ($q) use ($currentUserId){
                $q->where("receiver_id",$currentUserId);
            })
            ->orWhereHas("received", function ($q) use ($currentUserId){
                $q->where("sender_id",$currentUserId);
            })
            ->get();

        $allUserMessages = Message::query()
            ->where('receiver_id', $currentUserId)
            ->orWhere('sender_id', $currentUserId)
            ->orderBy("created_at","desc")
            ->get();

        return view("players.messages", compact( "player","allUserMessages","conversations"));
    }
}
