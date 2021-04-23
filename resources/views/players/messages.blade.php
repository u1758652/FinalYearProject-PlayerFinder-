@extends('layouts.app')
@section('playermessages')
    <div>
        <form method="GET" action="/players/{{$player->id}}/showconvo">
            @csrf
            <select name="playername">
                    @foreach($conversations as $conversation)
                      <option value="{{$conversation->id}}"> {{$conversation->username}} </option>
                    @endforeach
            </select>
            <button type="submit">Search</button>
        </form>
        <div>
        @foreach($allUserMessages as $message)
             <div>
                 @if($message->receiver->id != \Illuminate\Support\Facades\Auth::id())
                     <p style="color: #3869d4"> Sent to: {{$message->receiver->username}} by {{$message->sender->username}} at {{$message->created_at}} </p>
                     <p style="padding-bottom: 25px">{{$message->text}}</p>
                 @elseif($message->sender->id != \Illuminate\Support\Facades\Auth::id() )
                     <p style="color: #b21f2d ">Sent by: {{$message->sender->username}} to {{$message->receiver->username}} at {{$message->created_at}}</p>
                     <p style="padding-bottom:25px"> {{$message->text}}</p>
                 @endif
                 @endforeach
             </div>
        </div>

    </div>
@endsection
