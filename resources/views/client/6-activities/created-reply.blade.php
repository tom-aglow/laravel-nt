@component('client.6-activities._activity')
    @slot('heading')
        <strong class="">{{ $profileUser->name }}</strong> replied to <a class="indigo-text text-darken-4 " href="{{ $activity->subject->thread->path() }}">"{{ $activity->subject->thread->title }}"</a><br><br>
    @endslot
    @slot('body')
        <p>{{ $activity->subject->body }}</p>
    @endslot
@endcomponent