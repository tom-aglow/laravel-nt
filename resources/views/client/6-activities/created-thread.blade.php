@component('client.6-activities._activity')
    @slot('heading')
        <strong class="">{{ $profileUser->name }}</strong> published <a class="indigo-text text-darken-4 " href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a><br><br>
    @endslot
    @slot('body')
        <p>{{ $activity->subject->body }}</p>
    @endslot
@endcomponent