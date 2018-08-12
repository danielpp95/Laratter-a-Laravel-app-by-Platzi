@extends('layouts.app')

@section('content')
  {{-- Title --}}
  <h1>{{$user->name}}</h1>

  {{-- Follow form --}}
  <form action="/{{ $user->username }}/follow" method="POST"> 
    {{csrf_field()}}
    @if (session('success'))
      <span class="text-success">{{session('success')}}</span>
    @endif
    <button class="btn btn-primary">Follow</button>
  </form>

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