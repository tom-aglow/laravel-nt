<div class="row">
    <div class="col l12">
        <div class="card grey lighten-5">
            <div class="card-content">
                <span class="card-title">Tags</span>
                @forelse($tagList as $tag)
                    <a href="#" class="chip">{{ $tag->tag_name }}</a>
                @empty
                    <p>No tags</p>
                @endforelse
            </div>
        </div>
    </div>
</div>