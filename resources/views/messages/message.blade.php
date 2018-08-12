<img src={{ $message->image }}  class="img-thumbnail">
<div class="text-muted">
  Escrito por:
<a href="/{{$message->user->username}}"> {{$message->user->name}} </a>
</div>
<p class="card-text">{{ $message->content}}
  <a href="/messages/{{ $message->id }}">Leer más</a>
</p>