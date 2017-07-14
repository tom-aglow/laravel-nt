<div class="tags  widget-tags">
    <h6>Tags</h6>
    <hr>
    {{ debug($tagList) }}
    @forelse($tagList as $tag)
        <a href="#" class="tags__link">{{ $tag->tag_name }}</a>
    @empty
        <p>No tags</p>
    @endforelse
</div>