@extends('pages.mainPage')
@section('footer')
    <h2>This is new footer</h2>
@endsection

@section('content')
    <select name="" id="">
        @for($i = 1990; $i < 2017; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select><br>
    @unless($isAdmin)
        <strong>You are not admin</strong>
    @endunless
    <br>
    @php
        echo date('Y.m.d')
    @endphp

    <br>
    {{ formatDate() }}
@endsection