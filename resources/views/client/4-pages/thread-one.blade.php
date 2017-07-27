 <div class="row">
    <div class="col l8 offset-l2">
        <div class="card">
            <div class="card-content blue-grey darken-3 white-text">
                <span class="card-title">{{ $thread->title }}</span>
                <p class="body">{{ $thread->body }}</p>
            </div>
        </div>
    </div>
</div>
 <div class="row">
     <div class="col l8 offset-l2">
         @foreach($thread->replies as $reply)
         <div class="card">
             <div class="card-content blue-grey lighten-3">
                 <strong><a class="light-blue-text text-darken-4" href="#">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...</strong>
                 <p class="body">{{ $reply->body }}</p>
             </div>
         </div>
         @endforeach
     </div>
 </div>