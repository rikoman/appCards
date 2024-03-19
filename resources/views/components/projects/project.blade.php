@if (count($projects) > 0)
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($projects as $project)
            <div class="col">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/projects/' . $project->image) }}" class="bd-placeholder-img card-img-top" width="100%" height="225">
                    <div class="card-body">
                        <h3 class="card-text">{{ $project->title }}</h3>
                        <p>{{$project->description}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{route('project.show',['project'=>$project->id])}}" type="button"
                                   class="btn btn-sm btn-outline-secondary">{{__('Смотреть')}}</a>
                                @auth
                                    @if (Auth::user()->can(['update','delete'], $project))
                                        <x-projects.editAndDelete :project="$project" />
                                    @endif
                                    @if(Auth::user()->id != $project->user_id)
                                        @if(Auth::user()->subprojects->contains('id',$project->id))
                                            <x-projects.unsubscribed :project="$project" />
                                        @else
                                            <x-projects.subscribed :project="$project" />
                                        @endif
                                    @endif
                                @endauth
                            </div>
                            <small class="text-muted">{{$project->created_at->format('d-m-y')}}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-3">
        {{ $projects->links() }}
    </div>
@endif


