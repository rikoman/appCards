@extends('base')
@section('title', $project->title )
@section('main')
{{--    <p><a href="{{route('project.index')}}" class="btn btn-secondary">На перечень проектов надо будет удалить</a></p>--}}
    <div style="width: 70%; margin: auto">

        <img src="{{ asset('storage/projects/' . $project->image) }}" alt="Изображение проекта" class="img-fluid mb-3"
             width="100%" style="margin: auto">

    </div>

    <h2>Категория: {{ $project->title }}</h2>
    <h3>Описание:{{ $project->description }}</h3>
    <h3>Автор: {{ $project->user->name }}</h3>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Дата создания: {{$project->created_at}}</h3>

        <div>
            @auth
                @if (Auth::user()->can(['update','delete'], $project))
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <a href="{{ route('project.edit', ['project' => $project->id]) }}"
                           class="btn btn-outline-success" style="margin-right: 5px">Редактировать</a>

                        <form action="{{ route('project.destroy', $project->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Удалить</button>
                        </form>

                    </div>
                @endif
            @endauth
        </div>
    </div>

    @auth
        @if (Auth::user()->can(['update'], $project))
            <a style="width: 100%; margin-bottom: 10px" type="button"
               href="{{route('category.create',compact('project'))}}" class="btn btn-outline-success btn-lg btn-block">Cоздать
                категорию</a>
        @endif
    @endauth

    @if (count($categories) > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($categories as $category)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="card-text">{{ $category->title }}</h3>
                            <p>{{$category->description}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">

                                    <a href="{{route('category.show',compact('project','category'))}}" type="button"
                                       class="btn btn-sm btn-outline-secondary">Смотреть</a>
                                    @auth
                                        @if (Auth::user()->can(['update','delete'], $project))

                                            <a href="{{ route('category.edit', compact('project','category')) }}"
                                               type="button" class="btn btn-sm btn-outline-secondary">Редактировать</a>

                                            <form action="{{ route('category.destroy',compact('project','category')) }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">Удалить
                                                </button>
                                            </form>

                                        @endif
                                    @endauth
                                </div>

                                <small class="text-muted">{{$category->created_at->format('d-m-y')}}</small>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="comments-section" style="margin-top: 30px">
        <!-- Форма для добавления нового комментария -->
        <form method="POST"
              action="{{ route('comment.store', ['project' => $project->id]) }}"
        >
            @csrf
            <textarea name="content" placeholder="Напишите сообщение" rows="3"></textarea>
            <button type="submit">Отправить</button>
        </form>

        <!-- Список комментариев -->
        <div class="comments-list">
            @foreach ($project->comments()->get() as $comment)
                <div class="comment">
                    <div class="user-info">
                        <div>
                            <span>{{ $comment->user->name }}</span>
                            <small>{{ $comment->created_at->format('j M Y, g:i a') }}</small>
                        </div>
                        @if ($comment->user == auth()->user())
                            <div class="dropdown">
                                <button onclick="toggleMenu(this)">
                                    #
                                </button>
                                <div class="dropdown-menu hidden">
                                    <a href="{{ route('comment.edit',compact('project','comment')) }}">Редактировать</a>
                                    <form method="POST" action="{{ route('comment.destroy', compact('project','comment')) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <style>

        .comments-section form {
            margin-bottom: 20px;
        }

        .comments-section form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .comments-section form button {
            background-color: #3490dc;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comments-section form button:hover {
            background-color: #2779bd;
        }

        /*Стили для выпадающего списка*/
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown button {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .dropdown .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .dropdown .dropdown-menu a {
            color: #333;
            padding: 8px 12px;
            display: block;
            text-decoration: none;
        }

        .dropdown .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
        /*Стили для блока комментариев*/
        .comment {
            padding: 12px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .comment .user-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment .user-info small {
            color: #777;
            font-size: 0.8rem;
        }

        .comment .dropdown button {
            font-size: 1rem;
            color: #999;
        }

        .comment .content {
            margin-top: 10px;
        }
    </style>
    <script>
        function toggleMenu(button) {
            var menu = button.nextElementSibling;
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }
    </script>
@endsection




<!--
    Комментарии, потом надо будеть сделать норм стили
-->

{{--    <div class="row" style="margin-top: 20px">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="panel panel-info">--}}
{{--                <div class="panel-heading">Комментарии</div>--}}

{{--                <div class="panel-body comments">--}}
{{--                    <form action="{{ route('comment.store',  $project) }}" method="post" class="mb-3">--}}
{{--                        @csrf--}}
{{--                            <textarea name="content" class="form-control" placeholder="Оставьте Ваш комментарий" rows="5"></textarea>--}}
{{--                        <br>--}}
{{--                        <button type="submit" class="btn btn-info pull-right">Отправить</button>--}}
{{--                    </form>--}}

{{--                    @foreach($project->comments()->get() as $comment)--}}
{{--                        <div class="clearfix"></div>--}}
{{--                        <hr>--}}
{{--                        <ul class="media-list">--}}
{{--                            <li class="media">--}}
{{--                                <div class="comment">--}}
{{--                                    <div>--}}
{{--                                        <a href="#" class="pull-left">--}}
{{--                                            <img src="https://bootstraptema.ru/snippets/element/2016/comments/com-1.jpg" alt="" class="img-circle">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <strong class="text-success">{{$comment->user->name }}</strong>--}}
{{--                                        <span class="text-muted">--}}
{{--                                                <small class="text-muted">{{ $comment->created_at }}</small>--}}
{{--                                        </span>--}}
{{--                                        <p>--}}
{{--                                            {{ $comment->content }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}

{{--                                    @if(Auth::user()->id == $comment->user_id)--}}
{{--                                        <form action="{{ route('comment.update', compact('project','comment')) }}" method="POST" class="dropdown-item">--}}
{{--                                            @csrf--}}
{{--                                            @method('PATCH')--}}
{{--                                            <div class="form-group">--}}
{{--                                                <textarea name="content" rows="4" class="form-control">{{ $comment->content }}</textarea>--}}
{{--                                            </div>--}}
{{--                                            <button type="submit" class="btn btn-primary">Обновить комментарий</button>--}}
{{--                                        </form>--}}

{{--                                        <form action="{{ route('comment.destroy', compact('project','comment')) }}" method="POST" class="dropdown-item">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="btn btn-danger">Удалить комментарий</button>--}}
{{--                                        </form>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
