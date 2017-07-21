@extends('admin.3-pages.home')

@section('content')
    <section class="col-lg-10">
        <form class="form-horizontal" id="blog-article" name="article" method="post" action="{{ $action }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            {{--title field--}}
            <div class="form-group">
                <label id="title" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" id="title" name="title" value="{{ getFromModelOrSession($article, 'title') }}">
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
                        <img class="img-rounded article_img" src="{{ getImageLink('widen/400', $img['path'], $img['ext']) }}" alt="">
                    </div>
                    <div class="image-new-file col-lg-4">
                        <strong>Upload new image:</strong>
                        <input type="file" class="article_img_upload" name="file">
                        <button class="btn btn-primary btn-xs" id="img-upload" type="submit" name="button" value="upload">Upload</button>
                    </div>
                </div>
            </div>

            {{--is article active--}}
            <div class="form-group">
                <label id="active" class="col-lg-2 control-label">Visibility<br>(from / to / is active)</label>
                <div class="col-lg-8">
                    active_from
                    <div class='col-lg-5'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" name="active_from" value="{{ getFromModelOrSession($article, 'active_from') }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{--active_to--}}
                    <div class='col-lg-5'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker2'>
                                <input type='text' class="form-control" name="active_to" value="{{ getFromModelOrSession($article, 'active_to') }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker1').datetimepicker();
                            $('#datetimepicker2').datetimepicker({
                                useCurrent: false //Important! See issue #1075
                            });
                            $("#datetimepicker1").on("dp.change", function (e) {
                                $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
                            });
                            $("#datetimepicker2").on("dp.change", function (e) {
                                $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
                            });
                        });
                    </script>

                    {{--is active--}}
                    <div class="col-lg-2">
                        <input type="checkbox" name="is_active" value="1"
                               @if(getFromModelOrSession($article, 'is_active'))
                                checked
                               @endif
                               data-toggle="toggle" data-on="active" data-off="inactive" data-size="small">
                    </div>
                </div>
            </div>

            {{--tags--}}
            <div class="form-group">
                <label class="col-lg-2 control-label">Tags</label>
                <div class="col-lg-10">
                        @foreach($tags as $tag)
                            <label class="checkbox-inline">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                @if (!empty($article) && in_array($tag->id, $article->tags->pluck('id')->toArray()))
                                    {{ 'checked' }}
                                @endif
                                >{{ $tag->tag_name }}</label>
                        @endforeach
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



    </section>
@endsection

@section('footer_script')
    <script>
        $(function () {
            $('#img-upload').click(function () {
                $.ajax({
                    url: "{{ $action }}",
                    data: new FormData($('#blog-article')[0]),
                    dataType: 'json',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    success: function(request){
                        console.log(request.parse());
                    },
                });
            });
        });
    </script>
@endsection