@extends('admin.3-pages.home')

@section('content')
    <section class="col-lg-9">
        @forelse($comments as $key => $commentCollection)
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading-{{ $key }}">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $key }}" aria-expanded="true" aria-controls="collapse-{{ $key }}">
                            Article #{{ $key }}: {{ $commentCollection[0]->article->title }}
                        </a>
                        <span class="badge pull-right">{{ $commentCollection->filter(function ($item) {return $item->status->status === 'on moderation';})->count() }}</span>
                    </h4>
                </div>
                <div id="collapse-{{ $key }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-{{ $key }}">
                    <div class="panel-body">
                        <table class="table table-striped ">
                            <tr>
                                <th>Date</th>
                                <th>User</th>
                                <th>Comment</th>
                                <th colspan="4">Status</th>
                            </tr>
                            @forelse($commentCollection as $comment)
                                <tr>
                                    <td class="t-col-md">{{ formatStrToDate($comment->created_at) }}</td>
                                    <td>{{ $comment->user->username }}</td>
                                    <td>{{ $comment->user_comment }}</td>
                                    <td>{{ $comment->status->status }}</td>
                                    @if($comment->status->status === config('blog.commentStatus.accepted'))
                                        <td class="t-col-sm"><a class="btn btn-xs btn-info" href="{{ route('admin.comment.action', ['id' => $comment->id, 'action' => 'return']) }}"><span class="glyphicon glyphicon-repeat" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Return to moderation"></span></a></td>
                                    @elseif($comment->status->status === config('blog.commentStatus.new'))
                                        <td class="t-col-sm"><a class="btn btn-xs btn-success" href="{{ route('admin.comment.action', ['id' => $comment->id, 'action' => 'accept']) }}"><span class="glyphicon glyphicon-ok" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Accept"></span></a></td>
                                    @else
                                        <td class="t-col-sm"><a class="btn btn-xs btn-info disabled" href="{{ route('admin.comment.action', ['id' => $comment->id, 'action' => 'return']) }}"><span class="glyphicon glyphicon-repeat" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Return to moderation"></span></a></td>
                                    @endif
                                    @if($comment->status->status === config('blog.commentStatus.deleted'))
                                        <td class="t-col-sm"><a class="btn btn-xs btn-warning" href="{{ route('admin.comment.action', ['id' => $comment->id, 'action' => 'restore']) }}" onclick="return confirmDelete();"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Restore"></span></a></td>
                                    @else
                                        <td class="t-col-sm"><a class="btn btn-xs btn-warning" href="{{ route('admin.comment.action', ['id' => $comment->id, 'action' => 'delete']) }}" onclick="return confirmDelete();"><span class="glyphicon glyphicon-eye-close" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Delete temporary"></span></a></td>
                                    @endif
                                    <td class="t-col-sm"><a class="btn btn-xs btn-danger @cannot('delete', App\Models\Comment::class) {{ 'disabled' }} @endcannot" href="{{ route('admin.comment.action', ['id' => $comment->id, 'action' => 'kill']) }}" onclick="return confirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Delete forever"></span></a></td>
                                </tr>
                            @empty

                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
        {{ $comments->setPath(route('admin.comment.list'))->render('vendor.pagination.bootstrap-4') }}
        <br><br>
        @if (isset($msg) && !empty($msg))
            <div class="alert alert-info col-md-8 article_msg">{{ $msg }}</div>
        @endif
    </section>
@endsection