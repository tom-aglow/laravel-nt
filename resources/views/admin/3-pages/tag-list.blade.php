@extends('admin.3-pages.home')

@section('content')
    <section class="col-lg-4">
        <div class="panel panel-info">
            <div class="panel-heading">Tags</div>
            <div class="panel-body">
                @foreach($tags as $tag)
                <form class="input-group input-group-sm tag-group" name="tags" method="post" action="{{ route('admin.tag.update', $tag->id) }}">

                    <span class="input-group-addon" id="basic-addon1">#</span>
                    <div class="input-group-btn" style="width: 0">
                        {{ csrf_field() }}
                    </div>
                    <input type="text" class="form-control" placeholder="tagname" aria-describedby="basic-addon1" name="tag_name" value="{{ $tag->tag_name }}">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-xs" type="submit" name="button" value="update" data-toggle="tooltip" data-placement="top" title="Update tag">update</button>
                        <button class="btn btn-danger btn-xs" type="submit" name="button" value="delete" data-toggle="tooltip" data-placement="top" title="Delete tag">delete</button>
                    </div>

                </form>
                @endforeach

                <h6 class="tag-add">Add new tag</h6>
                <form class="input-group input-group-sm tag-group" name="tags" method="post" action="{{ route('admin.tag.add') }}">

                    <span class="input-group-addon" id="basic-addon1">#</span>
                    <div class="input-group-btn" style="width: 0">
                        {{ csrf_field() }}
                    </div>
                    <input type="text" class="form-control" placeholder="tagname" aria-describedby="basic-addon1" name="tag_name">
                    <div class="input-group-btn">
                        <button class="btn btn-info btn-xs" type="submit" name="button" value="add" data-toggle="tooltip" data-placement="top" title="Add tag">add</button>
                    </div>

                </form>
            </div>
        </div>
        @if (isset($msg) && !empty($msg))
            <div class="alert alert-info col-md-8 article_msg">{{ $msg }}</div>
        @endif
    </section>
@endsection