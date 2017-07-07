@extends('admin.3-pages.home')

@section('content')
    <section class="col-lg-10">
        <table class="table table-striped ">
            <tr>
                <th>Date</th>
                <th>Article title</th>
                <th>Status</th>
                <th>Visible from</th>
                <th>Visible to</th>
                <th colspan="2">Actions</th>
            </tr>
            @forelse($articles as $article)
            <tr>
                <td class="t-col-md">{{ formatStrToDate($article->created_at) }}</td>
                <td>{{ $article->title }}</td>
                <td>Draft</td>
                <td class="t-col-md">{{ $article->active_from }}</td>
                <td class="t-col-md">{{ $article->active_to }}</td>


                <td class="t-col-sm"><a class="btn btn-xs btn-warning" href="{{ route('admin.article.edit', $article->id) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                <td class="t-col-sm"><a class="btn btn-xs btn-danger" href="{{ route('admin.article.delete', $article->id) }}" onclick="return confirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
            </tr>
            @empty

            @endforelse
        </table>
        <a class="btn btn-sm btn-info" href="{{ route('admin.article.add') }}">+add</a><br>
        {{ debug($msg) }}
        @if (isset($msg) && !empty($msg))
            <div class="alert alert-info col-md-8 article_msg">{{ $msg }}</div>
        @endif
    </section>
@endsection