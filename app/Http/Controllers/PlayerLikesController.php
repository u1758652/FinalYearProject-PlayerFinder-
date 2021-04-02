<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PlayerLikesController extends Controller
{
    public function store(User $player){
        $currentUser = Auth::user();
        $player->like($currentUser);

        return back();
    }

    public function destroy(User $player){
        $currentUser = Auth::user();
        $player->dislike($currentUser);

        return back();
    }
}
