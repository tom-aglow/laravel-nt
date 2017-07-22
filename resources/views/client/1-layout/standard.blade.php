@extends('client.1-layout.base')

@section('header')
    <div class="navbar-fixed">
        <nav class="pink darken-1">
            <div class="nav-wrapper">
                @include('client.2-parts.header-logo')
                @include('client.2-parts.header-navbar')
            </div>
        </nav>
    </div>
@endsection

@section('footer')
    <footer class="page-footer pink darken-1">
        @include('client.2-parts.footer-links')
        @include('client.2-parts.footer-copyright')
    </footer>
@endsection