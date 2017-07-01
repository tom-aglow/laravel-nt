<div class="boxed  push-down-45">
    <div class="meta">
        <img class="wp-post-image" src="img/dummy-licensed/blog-image.jpg" alt="Blog image" width="748" height="324">
        <div class="row">
            <div class="col-xs-12  col-sm-10  col-sm-offset-1">
                <div class="meta__container--without-image">
                    <div class="row">
                        <div class="col-xs-12  col-sm-8">
                            <div class="meta__info">
                                <a href="#">Articles</a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="meta__comments">
                                <span class="meta__date"><span class="glyphicon glyphicon-calendar"></span> {{ formatStrToDate($article->created_at, 'd M Y') }} </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10  col-xs-offset-1">
            <div class="post-content--front-page">
                <h2 class="front-page-title">
                    <a href="/article/{{ $article->id }}">{{ $article->title }}</a>
                </h2>
                <h3>{{ $article->subheading }}</h3>
                <p>{{ mb_substr($article->content, 0, 500) . '...' }} </p>
            </div>
            <a href="/article/{{ $article->id }}">
                <div class="read-more">
                    Read more <span class="glyphicon glyphicon-chevron-right"></span>
                    <div class="comment-icon-counter">
                        <span class="glyphicon glyphicon-comment comment-icon"></span>
                        <span class="comment-counter">{{ count($article->comments) }}</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

