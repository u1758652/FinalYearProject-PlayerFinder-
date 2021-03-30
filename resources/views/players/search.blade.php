@extends("layouts.app")
@section('playersearch')
    <h4>Search Results</h4>
    <div>
        @foreach($players as $player)
        <div>
            Player: {{$player->username}}
           <p>MMR: {{$player->competitive_rank}}</p>

           Roles: @foreach($player -> role as $role)
             {{$role->name}}
            @endforeach

        </div>

        @endforeach
    </div>
@endsection
