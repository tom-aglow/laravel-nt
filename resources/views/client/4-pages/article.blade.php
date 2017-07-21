<div class="row">
    <div class="col l12">
        <div class="card">
            <div class="card-image">
                <img src="{{ getImageLink('widen/748', $article->image->path, $article->image->ext) }}" alt="Blog image">
            </div>
            <div class="card-content">
                <div class="valign-wrapper article_date">
                    <i class="material-icons tiny">today</i>
                    <span> {{ formatStrToDate($article->created_at, 'd M Y') }} </span>
                </div>
                <h1>{{ $article->title }}</h1>
                <h4>{{ $article->subheading }}</h4>
                <p>{{ $article->content }}</p>
                @forelse($article->tags as $tag)
                    <a href="#" class="chip article_tag_cloud">{{ $tag->tag_name }}</a>
                @empty
                    <p>No tags</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col l12">
        <div class="card grey lighten-5">
            <div class="card-content">
                <span class="card-title">Comments ({{ count($comments) }})</span>
                @forelse($comments as $comment)
                    <div class="row">
                        <div class="card-panel col offset-l3 l6">
                            <div class="row valign-wrapper">
                                <div class="col l2">
                                    <img src="/img/dummy/about-5.jpg" alt="" class="circle responsive-img">
                                </div>
                                <div class="col l10">
                                    <div class="comment-header">
                                        <strong>{{ $comment->user->name }}</strong>
                                        <span class="comment-date">{{ formatStrToDate($comment->created_at, 'd M Y') }}</span>
                                    </div>
                                    <span class="">{{ $comment->user_comment }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No comments yet</p>
                @endforelse
                <div class="row">
                    <div class="col offset-l3 l6">
                        @if(Auth::check())
                            <form action="{{ route('client.article.show', $article->slug) }}" method="post">
                                {{ csrf_field() }}
                                <div class="input-field col l12">
                                    <textarea id="comment" class="materialize-textarea" rows="6" name="comment" class="validate" placeholder="Your comment" required></textarea>
                                    <label for="comment" data-error="wrong" data-success="right">Comment</label>
                                </div>
                                <input type="submit" value="Leave Comment" class="btn">

                            </form>
                            @if ($errors->any())
                                <div class="alert alert-danger article_msg">
                                    @foreach($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <p>Please sign in to leave a comment</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>