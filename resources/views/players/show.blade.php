<!DOCTYPE html>
@extends("layouts.app")
@section("playershow")
    <div>
        {{$player->username}}

        @foreach($player -> role as $role)
            <p>{{$role->name}}</p>
        @endforeach

    </div>
<div>
    <form method="POST" action="/players/{{$player->id}}">
        @csrf
        <input type="text" name="message">
        <button type="submit">Send</button>
    </form>

</div>
@endsection
