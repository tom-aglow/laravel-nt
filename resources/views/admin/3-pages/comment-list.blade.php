@extends('admin.3-pages.home')

@section('content')
    <section class="col-md-7 col-xs-12">
        <table class="table table-striped ">
            <tr>
                <th>Date</th>
                <th colspan="3">Comment</th>
            </tr>
            @forelse($comments as $comment)
            <tr>
                <td class="t-col-md">{{ formatStrToDate($comment->created_at) }}</td>
                <td>{{ $comment->user_comment }}</td>

            </tr>
            @empty

            @endforelse
        </table>
        @if (isset($msg) && !empty($msg))
            <div class="alert alert-info col-md-8 article_msg">{{ $msg }}</div>
        @endif
    </section>
@endsection