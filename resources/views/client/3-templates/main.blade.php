@extends('client.1-layout.column-2')

@section('column-2-col-1')
    @include($page)
@endsection

@section('column-2-col-2')
    @include('client.5-widgets.author')
    <div class="sidebar  boxed  push-down-30">
        <div class="row">
            <div class="col-xs-10  col-xs-offset-1">
                @include('client.5-widgets.categories')
                @include('client.5-widgets.featured-post')
                @include('client.5-widgets.posts')
                @include('client.5-widgets.tags')
            </div>
        </div>
    </div>
@endsection