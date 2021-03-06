@extends('admin.1-layout.layout')

@section('side-bar')
    <aside class="col-lg-2">
        <div class="list-group">
            @can('all', App\Models\Article::class)
            <a href="{{ route('admin.article.list') }}" class="list-group-item {{ $menuActive['article'] or '' }}">Articles</a>
            @endcan

            @can('view', App\Models\Comment::class)
            <a href="{{ route('admin.comment.list') }}" class="list-group-item {{ $menuActive['comment'] or '' }}">Comments
                @isset($badgeComment)
                    <span class="badge pull-right">{{ $badgeComment }}</span>
                @endisset
            </a>
            @endcan

            @can('all', App\Models\Tag::class)
            <a href="{{ route('admin.tag.list') }}" class="list-group-item {{ $menuActive['tag'] or '' }}">Tags</a>
            @endcan

            {{--<a href="#" class="list-group-item {{ $menuActive['user'] or '' }}">Users</a>--}}

            @if (isset($msg) && !empty($msg))
                <div class="alert alert-info article_msg">{{ $msg }}</div>
            @endif
            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger article_msg">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
        </div>
    </aside>
@endsection

@section('content')
    <section class="col-lg-10">
        <div class="jumbotron">
            <h1>Welcome to admin world!</h1>
            <p>This all is yours</p>
        </div>
    </section>
@endsection