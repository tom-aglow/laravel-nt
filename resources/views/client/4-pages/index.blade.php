@forelse($articles as $article)
    @include('client.2-parts.article-preview')
@empty
    <p>No articles to display</p>
@endforelse
