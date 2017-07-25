@extends('admin.3-pages.home')

@section('content')
    <section class="col-lg-10">
        <div class="jumbotron">
            <h1>Error {{ $errorCode }}</h1>
            <p>{{ $errorMessage }}</p>
            <a href="{{ route('admin.admin.index') }}">Go to main page</a>
        </div>
    </section>
@endsection
