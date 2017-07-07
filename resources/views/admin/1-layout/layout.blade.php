@extends('admin.1-layout.base')

@section('header')
    @include('admin.2-parts.header')
@endsection

@section('container')
    <main class="container">
        @yield('side-bar')
        @yield('content')
    </main>
@endsection