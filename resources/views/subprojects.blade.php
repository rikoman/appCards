@extends('base')
@section('title','Мои проекты')
@section('main')
    @auth()
        <h1>Мои подписки</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @if (count($subprojects) > 0)
                @foreach($subprojects as $project)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{ asset('storage/projects/' . $project->image) }}"
                                 class="bd-placeholder-img card-img-top" width="100%" height="225"
                                 xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Эскиз"
                                 preserveAspectRatio="xMidYMid slice" focusable="false">

                            <div class="card-body">
                                <h3 class="card-text">{{ $project->title }}</h3>
                                <p>{{$project->description}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{route('project.show',['project'=>$project->id])}}" type="button"
                                           class="btn btn-sm btn-outline-secondary">Смотреть</a>
                                        @if (Auth::user()->can(['update','delete'], $project))
                                            <a href="{{ route('project.edit', ['project' => $project->id]) }}"
                                               type="button" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                            <form
                                                action="{{ route('project.destroy', $project->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">Удалить
                                                </button>
                                            </form>
                                        @endif
                                        @if(Auth::user()->id != $project->user_id)
                                            <form action="{{ route('project.unsubscribed', $project) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                    Отписаться
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{$project->created_at->format('d-m-y')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    @endif
    @endauth
@endsection
{{--<form action="{{ route('project.unsubscribed', $project) }}" method="POST">--}}
{{--    @csrf--}}
{{--    <button type="submit">Unsubscribe to Project</button>--}}
{{--</form>--}}

{{--<td>{{count($project->categories)}}</td>--}}
{{--<td>{{$project->numberOfVisits}}</td>--}}
