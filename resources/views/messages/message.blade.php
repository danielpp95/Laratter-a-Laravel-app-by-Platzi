{{-- Image --}}
<img src={{ $message->image }}  class="img-thumbnail">

{{-- Writted by --}}
<div class="text-muted">
  Escrito por:
  <a href="{{$message->user->username}}"> {{$message->user->name}} </a>
</div>

{{-- Text --}}
<p class="card-text">{{ $message->content}}
  <a href="/messages/{{ $message->id }}">Leer más</a>
</p>

{{-- Date --}}
<div class="card-text text-muted float-right">
  {{$message->created_at}}
</div>