<div class="card">
    <div class="card-content blue-grey lighten-3">
        <strong><a class="light-blue-text text-darken-4" href="#">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...</strong>
        <p class="body">{{ $reply->body }}</p>
    </div>
</div>