@extends('layouts.app')

@section('content')
  <h1 class='h3' >Message ID: {{$message->id}}</h1>
  <img class='img-thumbnail' src={{$message->image}} alt="">
  <p class="text-muted" >{{$message->content}}</p>
@endsection