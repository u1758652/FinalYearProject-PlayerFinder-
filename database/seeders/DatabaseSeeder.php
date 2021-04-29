<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Role::factory(5)->create();
         \App\Models\User::factory(100)->create();

         $roles = \App\Models\Role::all();

        \App\Models\User::all()->each(function ($user) use ($roles) {
            $user->role()->attach(
                $roles->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

    }
}

