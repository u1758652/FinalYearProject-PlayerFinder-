@extends("layouts.app")
@section("convo")
<div>

    @foreach($messageHistory as $message)
        <p>{{$message->sender->username}}</p>
        {{$message->text}}
    @endforeach
</div>
@endsection
