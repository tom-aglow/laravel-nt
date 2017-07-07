@extends('admin.1-layout.layout')

@section('header')

@endsection

@section('content')
    <section class="col-lg-10">
        <div class="jumbotron">
            <h1>Error {{ $errorCode }}</h1>
            <p>{{ $errorMessage }}</p>
        </div>
    </section>
@endsection
