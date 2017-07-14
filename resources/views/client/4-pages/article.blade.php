<div class="container">
    <div class="boxed  push-down-60">
        <div class="meta">
            <img class="wp-post-image" src="{{ getImageLink('widen/1138', $article->image->path, $article->image->ext) }}" alt="Blog image" width="1138" height="493">
            <div class="row">
                <div class="col-xs-12  col-sm-10  col-sm-offset-1  col-md-8  col-md-offset-2">
                    <div class="meta__container--without-image">
                        <div class="row">
                            <div class="col-xs-12  col-sm-8">
                                <div class="meta__info">
                                    <span class="meta__date"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;{{ formatStrToDate($article->created_at, 'd M Y') }}</span>
                                </div>
                            </div>
                            <div class="col-xs-12  col-sm-4">
                                <div class="comment-icon-counter-detail">
                                    <span class="glyphicon glyphicon-comment comment-icon"></span>
                                    <span class="comment-counter">{{ count($article->comments) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-10  col-xs-offset-1  col-md-8  col-md-offset-2  push-down-60">

                <div class="post-content">
                    <h1>
                        <a href="#">{{ $article->title }}</a>
                    </h1>
                    <h3>{{ $article->subheading }}</h3>
                    <p>{{ $article->content }}</p>
                </div>

                <div class="row">
                    <div class="col-xs-12  col-sm-6">

                        <div class="post-comments">
                            <a class="btn  btn-primary" href="single-post-without-image.html">Comments ({{ count($article->comments) }})</a>
                        </div>

                    </div>
                    <div class="col-xs-12  col-sm-6">

                        <div class="social-icons">
                            <a href="#" class="social-icons__container"> <span class="zocial-facebook"></span> </a>
                            <a href="#" class="social-icons__container"> <span class="zocial-twitter"></span> </a>
                            <a href="#" class="social-icons__container"> <span class="zocial-email"></span> </a>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="tags">
                            <h6>Tags</h6>
                            <hr>
                            @forelse($article->tags as $tag)
                                <a href="#" class="tags__link">{{ $tag->tag_name }}</a>
                            @empty
                                <p>No tags</p>
                            @endforelse

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="comments">
                            <h6>Comments</h6>
                            <hr>
                            @forelse($article->comments as $comment)
                                <div class="comment clearfix">
                                    <div class="comment-avatar pull-left">
                                        <img src="/img/dummy/about-5.jpg" alt="User Avatar" class="img-circle comment-avatar-image">
                                    </div>
                                    <div class="comment-body clearfix">
                                        <div class="comment-header">
                                            <strong class="primary-font">{{ $comment->user->name }}</strong>
                                            <small class="pull-right text-muted">
                                                <span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;{{ formatStrToDate($comment->created_at, 'd M Y') }}
                                            </small>
                                        </div>
                                        <p class="comment-text">{{ $comment->user_comment }}</p>
                                    </div>
                                </div>
                            @empty
                                <p>No comments yet</p>
                            @endforelse


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>