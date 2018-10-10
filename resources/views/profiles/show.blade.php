@extends ('layouts.app')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="page-header">
                    <h1>
                        {{ $profileUser->name }}
                    </h1>
                </div>

                @forelse($activities as $date => $activity)
                    <h4 class="page-header mt-5 mb-4">
                        {{ $date }}
                    </h4>

                    @foreach( $activity as $record )
                        @if(view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.{$record->type}", ['activity' => $record])
                        @endif
                    @endforeach

                @empty
                    <p>There is no activity for this user yet.</p>
                @endforelse

            </div><!-- /col-md-8 -->
        </div><!-- /row -->
    </div><!-- /container -->
@endsection