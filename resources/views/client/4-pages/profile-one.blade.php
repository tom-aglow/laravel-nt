<div class="row">
    <div class="col l8 offset-l2">
        <h1>{{ $profileUser->name }}</h1>
        <hr>
        <br><br>
        @foreach($activities as $date => $activity)
            <h4>{{ $date }}</h4>
            @foreach($activity as $record)
                @include("client.6-activities.{$record->type}", ['activity' => $record])
            @endforeach
            <br><br>
        @endforeach
    </div>
</div>