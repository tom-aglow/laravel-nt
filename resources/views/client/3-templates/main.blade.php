@extends('client.1-layout.column-2')

@section('column-2-col-1')
    @include($page)
@endsection

@section('column-2-col-2')
    @include('client.5-widgets.author')
    {!! $tagList !!}

    {{--<div class="">--}}
        {{--<div class="row">--}}
            {{--<div class="col l12">--}}
                {{--@include('client.5-widgets.categories')--}}
                {{--@include('client.5-widgets.featured-post')--}}
                {{--@include('client.5-widgets.posts')--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection