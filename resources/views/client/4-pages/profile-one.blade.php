<div class="row">
    <div class="col l8 offset-l2">
        <h1>{{ $profileUser->name }}</h1>
        <hr>
        <br><br>
        @forelse($activities as $date => $activity)
            <h4>{{ $date }}</h4>
            @foreach($activity as $record)
                @if(view()->exists("client.6-activities.{$record->type}"))
                    @include("client.6-activities.{$record->type}", ['activity' => $record])
                @endif
            @endforeach
            <br><br>
        @empty
            <p>There is no activity for this user yet.</p>
        @endforelse
    </div>
</div>