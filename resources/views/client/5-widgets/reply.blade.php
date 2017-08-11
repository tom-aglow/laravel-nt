<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div class="card" id="reply-{{ $reply->id }}">
        <div class="card-content blue-grey lighten-5">
            <strong><a class="light-blue-text text-darken-4" href="#">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...</strong>
            <hr>
            <div v-if="editing">
                <textarea class="materialize-textarea" cols="30" rows="5" v-model="body"></textarea>
                <button class="waves-effect waves-light btn deep-purple darken-1" @click="update">Save</button>
                <button class="waves-effect waves-light btn grey lighten-1" @click="editing = false">Cancel</button>

            </div>
            <div v-else v-text="body"></div>
        </div>
        <div class="card-action card-action__group">
            <form method="post" action="{{ route('client.replies.favourite', [$reply->id]) }}">
                {{csrf_field()}}
                <button type="submit" class="waves-effect waves-light valign-wrapper btn {{ $reply->isFavourited() ? 'disabled' : '' }}"><i class="material-icons left">favorite_border</i> <span>{{ $reply->getFavouriteCountsAttribute() }}</span> </button>
            </form>
            @can('update', $reply)
            <button class="waves-effect waves-light btn light-blue darken-3" @click="editing = true"><i class="material-icons">edit</i></button>
            <button class="waves-effect waves-light btn red" @click="destroy"><i class="material-icons">delete_forever</i></button>
            @endcan
        </div>
    </div>

</reply>

