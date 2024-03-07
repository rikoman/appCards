{{--@extends('base')--}}
{{--@section('title', $project->title );--}}
{{--@section('main')--}}
{{--    @auth--}}
{{--        @if (Auth::user()->can(['update','delete'], $project))--}}
{{--            <td>--}}
{{--                <a href="{{ route('project.edit', ['project' => $project->id]) }}">Изменить</a>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <form action="{{ route('project.destroy', $project->id) }}" method="post">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>--}}
{{--                </form>--}}
{{--            </td>--}}
{{--        @endif--}}
{{--    @endauth--}}
{{--    <img src="{{ asset('storage/projects/' . $project->image) }}" alt="Изображение проекта" width="400px">--}}
{{--    <h2>Наименование: {{ $project->title }}</h2>--}}
{{--    <p>Описание проекта: {{ $project->description }}</p>--}}
{{--    <p>Автор: {{ $project->user->name }}</p>--}}
{{--    <p>Дата создания: {{$project->created_at}}</p>--}}
{{--    @foreach($categories as $category)--}}
{{--        <a href="{{route('category.show',['project'=>$project->id,'category'=>$category->id])}}">--}}
{{--            <li>{{ $category->title }} - {{ $category->description }}</li>--}}
{{--        </a>--}}
{{--        <p>терминов - {{count($category->cards)}}</p>--}}
{{--        @auth--}}
{{--            @if (Auth::user()->can(['update','delete'], $project))--}}
{{--                <a href="{{ route('category.edit', ['project'=>$project->id,'category'=>$category->id]) }}">Изменить</a>--}}
{{--                <form action="{{ route('category.destroy',  ['project'=>$project->id,'category'=>$category->id]) }}"--}}
{{--                      method="post">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>--}}
{{--                </form>--}}
{{--            @endif--}}
{{--        @endauth--}}
{{--    @endforeach--}}
{{--    @auth--}}
{{--        @if (Auth::user()->can(['update'], $project))--}}
{{--            <p><a href="{{route('category.create',$project)}}">Создать категорию</a></p>--}}
{{--        @endif--}}
{{--    @endauth--}}
{{--    <p><a href="{{route('project.index')}}">На перечень проектов</a></p>--}}

{{--    <form action="{{ route('comment.store',  $project) }}" method="post">--}}
{{--        @csrf--}}
{{--        <textarea name="content" rows="4" cols="50"></textarea>--}}
{{--        <button type="submit">Add Comment</button>--}}
{{--    </form>--}}

{{--    @foreach($project->comments()->get() as $comment)--}}
{{--        <p>{{$comment->content}} - {{$comment->user->name }} -- {{$comment->created_at}}</p>--}}
{{--        <form action="{{ route('comment.update', compact('project','comment')) }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('PATCH')--}}
{{--            <textarea name="content" rows="4" cols="50"></textarea>--}}
{{--            <button type="submit">Update Comment</button>--}}
{{--        </form>--}}
{{--        <form action="{{ route('comment.destroy', compact('project','comment')) }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('DELETE')--}}
{{--            <button type="submit" class="btn btn-danger btn-sm">Delete Comment</button>--}}
{{--        </form>--}}
{{--    @endforeach--}}
{{--@endsection--}}

@extends('base')
@section('title', $project->title )
@section('main')
    @auth
        @if (Auth::user()->can(['update','delete'], $project))
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('project.edit', ['project' => $project->id]) }}" class="btn btn-primary">Изменить</a>
                <form action="{{ route('project.destroy', $project->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        @endif
    @endauth
    <img src="{{ asset('storage/projects/' . $project->image) }}" alt="Изображение проекта" class="img-fluid mb-3">
    <h2>{{ $project->title }}</h2>
    <p>{{ $project->description }}</p>
    <p>Автор: {{ $project->user->name }}</p>
    <p>Дата создания: {{$project->created_at}}</p>
    @foreach($categories as $category)
        <div class="card mb-3">
            <a href="{{route('category.show',['project'=>$project->id,'category'=>$category->id])}}">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->title }}</h5>
                    <p class="card-text">{{ $category->description }}</p>
                    <p>Терминов: {{ count($category->cards) }}</p>
                </div>
            </a>
            @auth
                @if (Auth::user()->can(['update','delete'], $project))
                    <div class="card-footer">
                        <a href="{{ route('category.edit', ['project'=>$project->id,'category'=>$category->id]) }}"
                           class="btn btn-primary">Изменить</a>
                        <form
                            action="{{ route('category.destroy',  ['project'=>$project->id,'category'=>$category->id]) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    @endforeach
    @auth
        @if (Auth::user()->can(['update'], $project))
            <p><a href="{{route('category.create',$project)}}" class="btn btn-success">Создать категорию</a></p>
        @endif
    @endauth
    <p><a href="{{route('project.index')}}" class="btn btn-secondary">На перечень проектов</a></p>

    <form action="{{ route('comment.store',  $project) }}" method="post" class="mb-3">
        @csrf
        <div class="form-group">
            <textarea name="content" rows="4" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Добавить комментарий</button>
    </form>

    @foreach($project->comments()->get() as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">{{ $comment->content }} - {{ $comment->user->name }}
                    -- {{ $comment->created_at }}</p>
            </div>
            <div class="card-footer">
                <form action="{{ route('comment.update', compact('project','comment')) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <textarea name="content" rows="4" class="form-control">{{ $comment->content }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Обновить комментарий</button>
                </form>
                <form action="{{ route('comment.destroy', compact('project','comment')) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить комментарий</button>
                </form>
            </div>
    @endforeach
@endsection
