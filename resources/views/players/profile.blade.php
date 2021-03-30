@extends("layouts.app")
@section('playerprofile')
    <h4>{{$player->username}}'s Profile</h4>
    <form method="POST" action="/players/{{$player->id}}">
        @csrf
        <div class="">
        <select name="roles">
            @foreach($roles as $role)
                 <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>


            {{--        <tr>--}}
            {{--            @foreach($player -> role as $role)--}}
            {{--                <a href="/players?role={{$role -> name}}">{{$role -> name}}</a>--}}
            {{--            @endforeach--}}
            {{--        </tr>--}}

            {{--        @foreach($roles as $rol)--}}
            {{--            {{$rol->name}}--}}
            {{--        @endforeach--}}
        </div>
    </form>

@endsection

