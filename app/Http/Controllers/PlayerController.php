<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{

    public function index()
    {
        $players = User::latest()->get();

        $user=Auth::user();

        $competitiveRank=$this->getCurrentUserMMR();

        $user->competitive_rank = $competitiveRank;

        $user->save();

        return view("players.index", compact("players","competitiveRank"));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
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
}
