 <div class="row">
    <div class="col l8 offset-l1">
        {{--thread body--}}
        <div class="card">
            <div class="card-content blue-grey darken-3 white-text">
                <div class="card-head-container">
                    <span>
                        <a class="light-blue-text text-lighten-2" href="{{ route('client.profiles.show', ['user' => $thread->creator]) }}">{{ $thread->creator->name }}</a>
                         posted:
                    </span>
                    <form action="{{ $thread->path() }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="waves-effect waves-light btn red darken-4 btn-small"><i class="material-icons">delete_forever</i></button>
                    </form>
                </div>
                <br><br>
                <span class="card-title">{{ $thread->title }}</span>
                <p class="body">{{ $thread->body }}</p>
            </div>
        </div>

        {{--replies--}}
        @foreach($replies as $reply)
            @include('client.5-widgets.reply')
        @endforeach

        {{ $replies->links() }}

        {{--form for leaving a reply--}}
        @if(Auth::check())
            <form action="{{ $thread->path() . '/replies' }}" method="post">
                {{ csrf_field() }}
                <div class="input-field col l12">
                    <textarea id="reply" class="materialize-textarea" rows="6" name="body" class="validate" placeholder="Have something to say?" required></textarea>
                    <label for="reply" data-error="wrong" data-success="right">Your reply</label>
                </div>
                <input type="submit" value="Leave a Reply" class="btn">

            </form>
            @if ($errors->any())
                <div class="alert alert-danger article_msg">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
        @else
            <p>Please <a href="{{ route('client.auth.login') }}">sign in</a> to participate in this discussion </p>
        @endif
    </div>
    <div class="col l3">
        <div class="card">
            <div class="card-content blue-grey lighten-3">
                <p class="body">This thread was published {{ $thread->created_at->diffForHumans() }} by <a href="">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                </p>
            </div>
        </div>
    </div>
</div>