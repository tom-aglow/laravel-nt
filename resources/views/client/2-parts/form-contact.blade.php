<div class="row">
    <div class="col l10 offset-l1">
        <div class="contact">
            @if(session('wasMessageSent'))
                <h2>Message was sent</h2>
                <p>Thank you for your feedback!</p>
                <a href="{{ route('client.client.index') }}">Go back to home page</a>
            @else
                <h2>Contact Us</h2>
                <p class="contact__text">Ut ullamcorper, risus a rhoncus fringilla, dui nisl viverra nunc, quis consectetur massa purus a nulla. Quisque adipiscing, eros eget molestie feugiat, dui sem laoreet est, nec convallis dolor erat et tellus.</p>
                <form action="{{ route('client.contact.show') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-field col l12">
                        <input id="name" type="text" class="validate" name="name" placeholder="Your Name" value="{{ old('name') }}" required>
                        <label for="name" data-error="wrong" data-success="right">Name</label>
                    </div>
                    <div class="input-field col l12">
                        <input id="email" type="email" class="validate" name="email" placeholder="E-mail Address " value="{{ old('email') }}" required>
                        <label for="email" data-error="wrong" data-success="right">Email</label>
                    </div>
                    <div class="input-field col l12">
                        <textarea id="message" class="materialize-textarea" rows="6" name="message" class="validate" placeholder="Your Message" required>{{ old('message') }}</textarea>
                        <label for="message" data-error="wrong" data-success="right">Message</label>
                    </div>
                    <input type="submit" value="Send Message" class="btn">

                </form>
                @if ($errors->any())
                    <div class="alert alert-danger article_msg">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

