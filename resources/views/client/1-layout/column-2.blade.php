@extends('client.1-layout.standard')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col l8">
                @yield('column-2-col-1')
            </div>
            <div class="col l4">
                @yield('column-2-col-2')
            </div>
        </div>
    </main>
@endsection