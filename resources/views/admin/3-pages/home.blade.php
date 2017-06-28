@extends('admin.1-layout.layout')

@section('side-bar')
    <aside class="col-md-2 col-xs-4">
        <div class="list-group">
            <a href="{{ route('admin.article.list') }}" class="list-group-item {{ $menuActive['article'] or '' }}">Articles</a>
            <a href="#admin/tag/list" class="list-group-item {{ $menuActive['tag'] or '' }}">Tags</a>
            <a href="#admin/user" class="list-group-item {{ $menuActive['users'] or '' }}">Users</a>
        </div>
    </aside>
@endsection

@section('content')
    <section class="col-md-8 col-xs-12">
        <div class="jumbotron">
            <h1>Hello, admin!</h1>
            <p>The world is yours</p>
        </div>
    </section>
@endsection