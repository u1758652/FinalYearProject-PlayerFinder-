<!Doctype html>
@extends("layouts.app")
@section('playerprofile')
    <div>
        <h4>My Profile</h4>
        <form method="POST" action="/players/{{$player->id}}">
            @csrf
            @method("PUT")
            <div class="">
                <select name="roles">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
                <div>
                    <button type="submit">Submit</button>
                </div>

                <div>
                    <a href="/players/{{$player->id}}/messages">My Conversations</a>
                </div>
    </div>

@endsection
