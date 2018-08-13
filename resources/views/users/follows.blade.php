@extends('layouts.app')

@section('content')
  {{-- Title Username --}}
  <h1>{{ $user->username }} have {{ $follows->count() }} {{ $action }}</h1>

  {{-- List of users --}}
  <ul class="list-unstiled" >
    @foreach ($follows as $follow )
      <li>{{$follow->username}}</li>
    @endforeach
  </ul>
@endsection