<div class="row">
    <div class="col l8 offset-l2">
        <h1>{{ $profileUser->name }}</h1>
        <p>since {{ $profileUser->created_at->diffForHumans() }}</p>

        <hr>
        <br><br>
        @foreach($profileUser->threads as $thread)
        <div class="card teal lighten-1">
            <div class="card-content white-text">
                <a class="blue-text text-darken-3" href="#">{{ $thread->creator->name }}</a> posted {{ $thread->created_at->diffForHumans() }}:<br><br>
                <span class="card-title">{{ $thread->title }}</span>
                <p>{{ $thread->body }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>