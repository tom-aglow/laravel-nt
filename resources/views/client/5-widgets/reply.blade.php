<div class="card">
    <div class="card-content blue-grey lighten-5">
        <strong><a class="light-blue-text text-darken-4" href="#">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...</strong>
        <span class="new badge " data-badge-caption="">{{ $reply->favourites_count }}</span>
        <p class="body">{{ $reply->body }}</p>
        <form method="post" action="{{ route('client.replies.favourite', [$reply->id]) }}">
            {{csrf_field()}}
            <button type="submit" class="btn-floating halfway-fab waves-effect waves-light red btn-like {{ $reply->isFavourited() ? 'disabled' : '' }}"><i class="material-icons">favorite_border</i></button>
        </form>
    </div>
</div>