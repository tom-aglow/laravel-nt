<div class="row">
    <div class="col l8 offset-l2">
        <h1>{{ $profileUser->name }}</h1>
        <p>since {{ $profileUser->created_at->diffForHumans() }}</p>

        <hr>
        <br><br>
        @foreach($profileUser->threads as $thread)
        <div class="card teal lighten-1">
            <div class="card-content white-text">
                <a class="indigo-text text-darken-4 " href="#">{{ $thread->creator->name }}</a> posted {{ $thread->created_at->diffForHumans() }}:<br><br>
                <a class="card-title indigo-text text-darken-4" href="{{ route('client.threads.show', ['channel' => $thread->channel, 'thread' => $thread]) }}">{{ $thread->title }}</a>
                <p>{{ $thread->body }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>