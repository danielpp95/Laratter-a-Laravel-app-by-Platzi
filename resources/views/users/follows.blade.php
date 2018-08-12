@extends('layouts.app')

@section('content')
  @foreach ($user->follows as $follow )
    <p>{{$follow->name}}</p>
  @endforeach
@endsection