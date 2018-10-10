@component('profiles.activities.activity')
    @slot('heading')
        <div class="activity-icon">
            <i class="far fa-file"></i>
        </div>
        {{ $profileUser->name }} published
        <a href="{{ $activity->subject->path() }}">"{{ $activity->subject->title }}"</a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent