<!DOCTYPE html>
@extends("layouts.app")
@section("playershow")

    <div>
        {{$player->username}}

        @foreach($player -> role as $role)
            <p>{{$role->name}}</p>
        @endforeach

    </div>

@endsection
