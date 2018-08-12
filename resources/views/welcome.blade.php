@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
    <h1>Laratter</h1>
    <nav  >
        <ul class='nav nav-pills'>
            <li class='nav-item' >
                <a href="/" class='nav-link' >Home</a>
            </li>
        </ul>
    </nav>
</div>

<div class="row">
    <form action="/messages/create" method='post'>
        <div class="from-group">
            {{ csrf_field() }}
            <input type="text" name="message" id="" class="form-control @if($errors->has('message')) is-invalid @endif" placeholder="Qué estás pensando?" >
            {{-- @if ($errors->any()) --}}
            @if ($errors->has('message'))
                @foreach ($errors->get('message') as $error)
                    <div class="invalid-feedback" >{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </form>
</div>

<div class="row">
    @forelse ($messages as $message)
        <div class="col-6">
            @include('messages.message')
        </div>
    @empty
        <div class="col-12 text-center">
            <h5>No hay mensajes destacados</h5>
        </div>
    @endforelse

    @if (count($messages))
    <div class="mt-2 mx-auto">
        {{ $messages->links() }}
    </div>
    @endif

</div>
@endSection