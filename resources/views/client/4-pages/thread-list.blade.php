 <div class="row">
    <div class="col l12">
        <div class="card">
            <div class="card-content">
            @foreach($threads as $thread)
                <article>
                    <h4><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4>
                    <div class="body">{{ $thread->body }}</div>
                </article>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>