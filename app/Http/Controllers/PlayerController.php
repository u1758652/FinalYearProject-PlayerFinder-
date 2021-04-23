<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PlayerController extends Controller
{

    public function index()
    {

        $roles= Role::latest()->get();

        $players = User::latest()->get();

        $user=Auth::user();

        $competitiveRank=$this->getCurrentUserMMR();

        $user->competitive_rank = $competitiveRank;

        $user->save();

        return view("players.index", compact("players","competitiveRank","roles"));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }


    public function show(User $player)
    {

        return view("players.show",compact("player"));
    }




    public function edit(User $player)
    {
       $roles = Role::all();

       return view("players.edit", compact("player"), ["roles"=>Role::all()]);
    }


    public function update(User $player)
    {
        $player->role()->attach(\request("roles"));
        $player->update();

        return redirect("/players");
    }


    public function destroy($id)
    {
        //
    }

    function convert_steamid_64bit_to_32bit($id)
    {
        $result = substr($id, 3) - 61197960265728;
        return (string) $result;
    }

    function getCurrentUserMMR()
    {
        $steamid = Auth::user()->steamid;
        $opendotaid=$this->convert_steamid_64bit_to_32bit($steamid);

        $client = new Client();
        $request = $client->get("https://api.opendota.com/api/players/$opendotaid");
        $response = json_decode($request->getBody()->getContents(),true);
        $competitiveRank = json_encode($response["competitive_rank"]);

        if ($competitiveRank == "null"){
            return 0;
        }else{
            return $competitiveRank;
        }
    }

    function search(Request $request)
    {
        $nameReq = $request->input("search");
        $roleReq = $request->input("roles");
        $minMMRReq = $request->input("minMMR");
        $maxMMRReq = $request->input("maxMMR");

        $players = User::query()
            ->where("username","LIKE","%$nameReq%")
            ->whereHas("role", function ($query) use($roleReq){
                if ($roleReq == ""){
                    $query->where("name","!=", $roleReq);
                }else{
                    $query->where("name",$roleReq);
                }
            })
            ->whereBetween("competitive_rank",[$minMMRReq,$maxMMRReq])
            ->get();

        return view("players.search",compact("players"));
    }
}
