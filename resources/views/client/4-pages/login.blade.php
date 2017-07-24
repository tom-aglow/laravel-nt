<div class="row">
    <div class="col l6 offset-l3">
        <div class="card">
            <div class="card-content">
                <h5>Login or create a new account</h5>
                <p>Ut ullamcorper, risus a rhoncus fringilla, dui nisl viverra nunc, quis consectetur massa purus a nulla.</p>
            </div>
            <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                    <li class="tab"><a class="active" href="#login">Log in</a></li>
                    <li class="tab"><a href="#signup">Sign up</a></li>
                </ul>
            </div>
            <div class="card-content grey lighten-4">
                <div id="login">
                    @include('client.5-widgets.form-login')
                </div>
                <div id="signup">
                    @include('client.5-widgets.form-signup')
                </div>
            </div>
        </div>
    </div>
</div>


