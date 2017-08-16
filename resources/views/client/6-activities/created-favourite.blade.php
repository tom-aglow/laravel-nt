@component('client.6-activities._activity')
    @slot('heading')
        <strong class="">{{ $profileUser->name }}</strong> favourited a
        <a class="indigo-text text-darken-4 " href="{{ $activity->subject->favourited->path() }}">reply</a>
        <br><br>
    @endslot
    @slot('body')
        <p>{{ $activity->subject->favourited->body }}</p>
    @endslot
@endcomponent