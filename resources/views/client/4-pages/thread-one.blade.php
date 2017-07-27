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