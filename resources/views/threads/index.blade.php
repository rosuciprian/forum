@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            @forelse( $threads as $thread )
                <div class="card mb-3">
                    <div class="card-header">

                        <div class="level">
                            <h5 class="flex">
                                <a href="{{ $thread->path() }}">
                                    {{ $thread->title }}
                                </a>
                            </h5>
                            <a href="{{ $thread->path() }}">
                                {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                            </a>
                        </div><!-- /level -->

                    </div><!-- /card-header -->

                    <div class="card-body">

                            <div class="body">
                                {{ $thread->body }}
                            </div>
                    </div>
                </div><!-- /card -->
            @empty
                <p>There are no relevant results at this time</p>
            @endforelse
            </div>
        </div>
    </div>
@endsection
