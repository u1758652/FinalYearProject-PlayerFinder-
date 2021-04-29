<!DOCTYPE html>
@extends('layouts.app')
@section('players')
    <div class="flex">
        <aside class="h-screen sticky top-0 bg-gray-300">
            <form action="/players/search" method="GET">
                @csrf
                <p>Search by name</p>
                <p><input type="text" name="search" /></p>
                <p>Search by min MMR</p>
                <p><input type="number" name="minMMR" value="0" /></p>
                <p>Search by max MMR</p>
                <p><input type="number" name="maxMMR" value="10000"/></p>
                <p>Search by role</p>
                <p><select name="roles">
                        <option value=""></option>
                         @foreach($roles as $role)
                             <option value="{{$role->name}}">{{$role->name}}</option>
                         @endforeach
                     </select>
                </p>

                <input type="submit" class="btn btn-sm btn-primary"/>

            </form>
        </aside>
        <main>
            <div>
                @foreach($players as $player)
                    <img src="{{$player->avatar}}">
                    <a href="/players/{{$player->id}}">{{$player->username}}</a>
                    MMR: {{$player->competitive_rank}}

                    <p>Roles: @foreach($player -> role as $role)
                            {{$role->name}}
                        @endforeach</p>
                <p>
                    <form method="post" action="/players/{{$player->id}}/like">
                        @csrf
                        <div style="height: 10px;" class="flex items-center"  >
                            <button type="submit">
                                <svg  viewBox="7 0 24 24" stroke="currentColor" class="w-7">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1"
                                          d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                            </button>
                            <span class="text-xs" >{{$player->likes()->where('liked',true)->count()}}</span>
                        </div>
                    </form>
                </p>

                    <form method="post" action="/players/{{$player->id}}/like">
                        @csrf
                        @method("DELETE")
                        <div style="height: 10px;" class="flex items-center"  >
                            <button type="submit">
                                <svg  viewBox="7 0 24 24" stroke="currentColor" class="w-7" style="transform: scaleY(-1)">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1"
                                          d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                            </button>
                            <span class="text-xs">{{$player->likes()->where('liked',false)->count()}}</span>
                        </div>
                    </form>
                @endforeach

            </div>
            {{ $players->links() }}
        </main>
    </div>
@endsection
