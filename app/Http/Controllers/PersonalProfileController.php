<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalProfileController extends Controller
{
    public function getAllRoles()
    {
        $roles = \App\Models\Role::latest()->get();

        return view("players.profile", compact("roles"));
    }


}
