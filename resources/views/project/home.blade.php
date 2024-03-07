@extends('base')
@section('title','Мои проекты')
@section('main')
    @auth()
        <h1>Мои проекты</h1>
        <div>
            <a style="width: 100%; margin-bottom: 10px" type="button" href="{{route('project.create')}}"
               class="btn btn-primary btn-lg btn-block">создать проект</a>
        </div>
        @if (count($projects) > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($projects as $project)
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
