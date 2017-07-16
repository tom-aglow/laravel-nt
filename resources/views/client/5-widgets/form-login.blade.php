<div class="boxed  push-down-45">
    <div class="row">
        <div class="col-xs-10  col-xs-offset-1">
            <div class="contact">
                <h2>Login</h2>
                <p class="contact__text">Ut ullamcorper, risus a rhoncus fringilla, dui nisl viverra nunc, quis consectetur massa purus a nulla.</p>
                <form action="{{ route('client.auth.login') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <label for="login">Login / E-mail</label>
                            </div>
                            <div class="col-xs-8">
                                <input type="text" id="login" name="email" placeholder="Type in your login">
                            </div>
                            <div class="col-xs-4">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-xs-8">
                                <input type="password" id="password" name="password" placeholder="Type in your password">
                            </div>
                            <div class="col-xs-4">
                                <label for="remember">Remember me</label>
                            </div>
                            <div class="col-xs-8">
                                <input type="checkbox" name="remember" id="remember" >
                            </div>
                            <div class="col-xs-8 col-xs-offset-4">
                                <input type="submit" value="Login">
                                <span class="contact__obligatory">Fields marked with * are obligatory</span>
                            </div>
                            @if (session('authError'))
                                <p>{{ session('authError') }}</p>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

