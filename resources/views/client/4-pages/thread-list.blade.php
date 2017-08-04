 <div class="row">
    <div class="col l8 offset-l2">
        @foreach($threads as $thread)
        <div class="card blue-grey lighten-5">
            <div class="card-content">
                <span class="card-title">
                    <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                    <span class="new badge" data-badge-caption="{{ str_plural('reply', $thread->replies_count) }}">{{ $thread->replies_count }}</span>
                </span>
                <p class="body">{{ $thread->body }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>