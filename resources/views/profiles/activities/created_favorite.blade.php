@component('profiles.activities.activity')
    @slot('heading')
        <div class="activity-icon">
            <i class="fas fa-heart"></i>
        </div>
        <a href="{{ $activity->subject->favorited->path() }}">
            {{ $profileUser->name }} favorited a reply
        </a>
{{--        <a href="{{ $activity->subject->thread->path() }}">"{{ $activity->subject->thread->title }}"</a>--}}
    @endslot

    @slot('body')
        {{ $activity->subject->favorited->body }}
    @endslot
@endcomponent