@extends('admin.3-pages.home')

@section('content')
    <section class="col-md-10">
        <form method="post" class="form-horizontal">
            <div class="form-group">
                <label id="title" class="col-sm-1 control-label">Title</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" id="title" name="title" value="{{ $article->title or '' }}">
                @if ($errors->has('title'))
                    <div class="alert alert-danger col-md-8 article_msg">{{ $errors->first('title') }}</div>
                @endif
                    {{--TODO change separated info msg about errors into one--}}
                </div>
            </div>
            <div class="form-group">
                <label id="content" class="col-sm-1 control-label">Text</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="content" id="content" rows="15">{{ $article->content or '' }}</textarea>
                @if ($errors->has('content'))
                    <div class="alert alert-danger col-md-8 article_msg">{{ $errors->first('content') }}</div>
                @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">Tags</label>
                <div class="col-md-8">
                    This is the place for tags
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-md-2">
                    <input class="form-control btn btn-success" type="submit" value="Save" name="save">
                </div>
                <div class="col-md-2">
                    <input class="form-control btn btn-default" type="submit" value="Cancel" name="cancel">
                </div>
            </div>
        </form><br>
        @if (isset($msg) && !empty($msg))
            <div class="alert alert-info col-md-8 article_msg">{{ $msg }}</div>
        @endif

    </section>
@endsection