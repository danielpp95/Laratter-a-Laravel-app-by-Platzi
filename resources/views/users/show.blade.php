@extends('layouts.app')

@section('content')
  {{-- Title --}}
  <h1>{{$user->name}}</h1>

  {{-- Messages --}}
  <div class="row">
    @foreach ($userMessages as $message)
      <div class="col-6">
        @include('messages.message')
      </div>
    @endforeach
  </div>


  {{-- Pagination --}}
  @if (count($userMessages))
    <div class="mt-2 mx-auto">
        {{ $userMessages->links() }}
    </div>
  @endif


@endsection