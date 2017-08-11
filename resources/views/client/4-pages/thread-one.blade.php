<thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
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
                        @can('update', $thread)
                        <form action="{{ $thread->path() }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="waves-effect waves-light btn red darken-4 btn-small"><i class="material-icons">delete_forever</i></button>
                        </form>
                        @endcan
                    </div>
                    <br><br>
                    <span class="card-title">{{ $thread->title }}</span>
                    <p class="body">{{ $thread->body }}</p>
                </div>
            </div>

            {{--replies--}}
            <replies :data="{{ $thread->replies }}" @added="repliesCount++" @removed="repliesCount--"></replies>

            {{--{{ $replies->links() }}--}}

            {{--form for leaving a reply--}}

        </div>
        <div class="col l3">
            <div class="card">
                <div class="card-content blue-grey lighten-3">
                    <p class="body">This thread was published {{ $thread->created_at->diffForHumans() }} by <a href="">{{ $thread->creator->name }}</a>, and currently has <span v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</thread-view>
