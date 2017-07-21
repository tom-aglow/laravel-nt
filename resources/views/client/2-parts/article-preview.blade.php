@forelse($articles as $article)
    <div class="row">
        <div class="col l12">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="{{ getImageLink('widen/748', $article->image->path, $article->image->ext) }}" alt="Blog image" width="748" height="auto">
                    <span class="card-title">{{ $article->title }}</span>
                </div>
                <div class="card-content">
                    <div class="valign-wrapper article_date">
                        <i class="material-icons tiny">today</i>
                        <span> {{ formatStrToDate($article->created_at, 'd M Y') }} </span>
                    </div>
                    <p>{{ mb_substr($article->content, 0, 500) . '...' }}</p>
                </div>
                <div class="card-action valign-wrapper article_action">
                    <a href="{{ route('client.article.show', $article->slug) }}">Read more</a>
                    <span class="badge valign-wrapper" data-badge-caption=""><i class="material-icons tiny right-align">comment</i>&nbsp;{{ count($article->comments) }}</span>
                </div>
            </div>
        </div>
    </div>
@empty
    <p>No articles to display</p>
@endforelse
{{ $articles->links() }}

