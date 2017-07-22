<div class="row">
    <div class="col l12">
        <div class="card grey lighten-5">
            <div class="card-content">
                <span class="card-title">Tags</span>
                @forelse($tagList as $tag)
                    <a href="{{ route('client.client.listByTag', ['tag' => strtolower($tag->tag_name)]) }}" class="chip">{{ $tag->tag_name }}</a>
                @empty
                    <p>No tags</p>
                @endforelse
            </div>
        </div>
    </div>
</div>