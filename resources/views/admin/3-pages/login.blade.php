@extends('admin.1-layout.layout')

@section('content')
    <section class="col-md-10">
        <form method="post" action="#admin/auth/login" class="form-horizontal">
            <div class="form-group">
                <label id="login" class="col-sm-6 control-label">Enter your login:</label>
                <div class="col-md-4">
                    <input class="form-control"  type="text" name="login" id="login">
                </div>
            </div>
            <div class="form-group">
                <label id="password" class="col-sm-6 control-label">Enter your password:</label>
                <div class="col-md-4">
                    <input class="form-control"  type="password" name="password" id="password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-6 col-md-2">
                    <input type="checkbox" name="remember" id="remember" class="checkbox-inline"> Remember me
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-6 col-md-2">
                    <input class="form-control btn btn-info" type="submit" value="Login">
                </div>
            </div>
        </form>
        {{--<? if($msg != '') :?>--}}
        {{--<div class="col-sm-offset-2 alert alert-danger col-md-4">--}}
            {{--<?= $msg; ?>--}}
        {{--</div>--}}
        {{--<? endif; ?>--}}
    </section>
@endsection