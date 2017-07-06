@extends('admin.3-pages.home')

@section('content')
    <section class="col-lg-10">
        <form class="form-horizontal" name="article" method="post" action="{{ $action }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            {{--title field--}}
            <div class="form-group">
                <label id="title" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" id="title" name="title" value="{{ getFromModelOrSession($article, 'title') }}">

                    {{--TODO change separated info msg about errors into one--}}
                </div>
            </div>

            {{--subtitle field--}}
            <div class="form-group">
                <label id="subheading" class="col-lg-2 control-label">Subtitle</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" id="subheading" name="subheading" value="{{ getFromModelOrSession($article, 'subheading') }}">
                </div>
            </div>

            {{--content field--}}
            <div class="form-group">
                <label id="content" class="col-lg-2 control-label">Content</label>
                <div class="col-lg-8">
                    <textarea class="form-control" name="content" id="content" rows="15">{{ getFromModelOrSession($article, 'content') }}</textarea>

                </div>
            </div>

            {{--image--}}
            <div class="form-group">
                <label id="image" class="col-lg-2 control-label">Image</label>
                <div class="col-lg-8">
                    <div class="image-img col-lg-8">
                        <img class="img-rounded article_img" src="{{ $imgPath }}" alt="">
                    </div>
                    <div class="image-new-file col-lg-4">
                        <strong>Upload new image:</strong>
                        <input type="file" class="article_img_upload" name="file">
                        <button class="btn btn-primary btn-xs" type="submit" name="button" value="upload">Upload</button>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-2 control-label">Tags</label>
                <div class="col-lg-10">
                    This is the place for tags
                </div>
            </div>

            {{--buttons--}}
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-2">
                    <button class="form-control btn btn-success" type="submit" name="button" value="save">Save</button>
                </div>
                <div class="col-lg-2">
                    <button class="form-control btn btn-default" type="submit" name="button" value="cancel">Cancel</button>
                </div>
            </div>
            
        </form><br>

        @if (isset($msg) && !empty($msg))
            <div class="alert alert-info col-lg-offset-2 col-lg-8 article_msg">{{ $msg }}</div>
        @endif
        @if ($errors->all())
            <div class="alert alert-danger col-lg-offset-2 col-lg-8 article_msg">
            @foreach($errors->all() as $error)
                    {{ $error }}<br>
            @endforeach
            </div>
        @endif

    </section>
@endsection