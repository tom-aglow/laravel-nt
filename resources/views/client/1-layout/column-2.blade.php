@extends('client.1-layout.standard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                @yield('column-2-col-1')
            </div>
            <div class="col-xs-12 col-md-4">
                @yield('column-2-col-2')
            </div>
        </div>
    </div>
@endsection