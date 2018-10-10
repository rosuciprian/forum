@component('profiles.activities.activity')
    @slot('heading')
        <div class="activity-icon">
            <i class="fas fa-reply"></i>
        </div>
        {{ $profileUser->name }} replied to
        <a href="{{ $activity->subject->thread->path() }}">"{{ $activity->subject->thread->title }}"</a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent