<div class="card" id="reply-{{ $reply->id }}">
    <div class="card-content blue-grey lighten-5">
        <strong><a class="light-blue-text text-darken-4" href="#">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...</strong>
        <p class="body">{{ $reply->body }}</p>
    </div>
    <div class="card-action card-action__group">
        <form method="post" action="{{ route('client.replies.favourite', [$reply->id]) }}">
            {{csrf_field()}}
            <button type="submit" class="waves-effect waves-light valign-wrapper btn {{ $reply->isFavourited() ? 'disabled' : '' }}"><i class="material-icons left">favorite_border</i> <span>{{ $reply->getFavouriteCountsAttribute() }}</span> </button>
        </form>
        @can('update', $reply)
        <form method="post" action="{{ route('client.replies.delete', [$reply->id]) }}">
            {{csrf_field()}}
            {{ method_field("DELETE") }}
            <button type="submit" class="waves-effect waves-light btn red"><i class="material-icons">delete_forever</i></button>
        </form>
        @endcan
    </div>
</div>