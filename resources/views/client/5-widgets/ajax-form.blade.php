<form class="form-horizontal" name="upload-form" id="upload-form" method="post" action="" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{--title field--}}
    <div class="form-group">
        <label id="title" class="col-lg-2 control-label">Title</label>
        <div class="col-lg-8">
            <input class="form-control" type="text" id="title" name="title" value="">

            {{--TODO change separated info msg about errors into one--}}
        </div>
    </div>


    {{--image--}}
    <div class="form-group">
        <label id="image" class="col-lg-2 control-label">Image</label>
        <div class="col-lg-8">
            <div class="image-img col-lg-8">
                <img class="img-rounded article_img" src="" alt="">
            </div>
            <div class="image-new-file col-lg-4">
                <strong>Upload new image:</strong>
                <input type="file" class="article_img_upload" name="file">
            </div>
        </div>
    </div>

    {{--buttons--}}
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-2">
            <button class="form-control btn btn-success" id="btn-add" type="submit" name="button" value="save">Save</button>
        </div>
        <div class="col-lg-2">
            <button class="form-control btn btn-default" type="submit" name="button" value="cancel">Cancel</button>
        </div>
    </div>

</form><br>
<script>
    $(function () {
        $('#btn-add').click(function () {
            $.ajax({
                url: '{{route('client.test.ajax')}}',
                data: new FormData($('#upload-form')[0]),
                datatype: 'json',
                type: 'post',
                processData: false,
                success: function(data){
                    console.log(data);
                },
            });
        });

    });
</script>