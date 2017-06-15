@extends('client.1-layout.base')

@section('header')
    @include('client.2-parts.header-logo')
    @include('client.2-parts.header-navbar')
    @include('client.2-parts.header-search-bar')
    @include('client.2-parts.header-navbar-toggle')
    @include('client.2-parts.header-search-panel')
@endsection

@section('footer')
    @include('client.2-parts.footer-links')
    @include('client.2-parts.footer-copyright')
@endsection