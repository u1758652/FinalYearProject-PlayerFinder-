<!DOCTYPE html>
@extends('layouts.app')
@section('players')
<div>
@foreach($players as $player)
    <img src="{{$player->avatar}}">
    {{$player->username}}
    MMR: {{$player->competitive_rank}}
    @endforeach
</div>

@endsection
