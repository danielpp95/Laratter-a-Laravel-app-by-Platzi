@extends('layouts.app')

@section('content')
  {{-- Title --}}
  <h1>{{$user->name}}</h1>

  <a href="{{'@'}}{{ $user->username }}/follows" class="btn btn-link" >Follows <span class="badge badge-secondary">{{ $user->follows->count() }}</span> </a>
  <a href="{{'@'}}{{ $user->username }}/followers">Followers <span class="badge badge-secondary">{{ $user->followers->count() }}</span> </a>
  

  {{-- Is Auth --}}
  @if (Auth::check())
    @if (Auth::user()->isFollowing($user))
      {{-- If i'm following the user --}}
      {{-- Unfollow Form --}}
      <form action="/{{'@'}}{{ $user->username }}/unfollow" method="POST"> 
        {{csrf_field()}}
        @if (session('success'))
        <span class="text-success">{{session('success')}}</span>
        @endif
        <button class="btn btn-danger">Unfollow</button>
      </form>

    @else
      {{-- if i'm not following the user --}}
      {{-- Follow form --}}
      <form action="/{{'@'}}{{ $user->username }}/follow" method="POST"> 
        {{csrf_field()}}
        @if (session('success'))
        <span class="text-success">{{session('success')}}</span>
        @endif
        <button class="btn btn-primary">Follow</button>
      </form>
        
    @endif


  @endif

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