 <div class="row">
    <div class="col l8 offset-l2">
        <div class="card">
            <div class="card-content blue-grey darken-3 white-text">
                <a class="light-blue-text text-lighten-2" href="#">{{ $thread->creator->name }}</a> posted:<br><br>
                <span class="card-title">{{ $thread->title }}</span>
                <p class="body">{{ $thread->body }}</p>
            </div>
        </div>
    </div>
</div>
 <div class="row">
     <div class="col l8 offset-l2">
         @foreach($thread->replies as $reply)
            @include('client.5-widgets.reply')
         @endforeach
     </div>
 </div>
 <div class="row">
     <div class="col l8 offset-l2">
         @if(Auth::check())
             <form action="{{ $thread->path() . '/replies' }}" method="post">
                 {{ csrf_field() }}
                 <div class="input-field col l12">
                     <textarea id="reply" class="materialize-textarea" rows="6" name="body" class="validate" placeholder="Have something to say?" required></textarea>
                     <label for="reply" data-error="wrong" data-success="right">Reply</label>
                 </div>
                 <input type="submit" value="Leave a Reply" class="btn">

             </form>
             @if ($errors->any())
                 <div class="alert alert-danger article_msg">
                     @foreach($errors->all() as $error)
                         {{ $error }}<br>
                     @endforeach
                 </div>
             @endif
         @else
             <p>Please <a href="{{ route('client.auth.login') }}">sign in</a> to participate in this discussion </p>
         @endif
     </div>
 </div>