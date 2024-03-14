@extends('base')
@section('title', $project->title )
@section('main')
    @vite('resources/css/card/comment.css')
    <div style="width: 70%; margin: auto">
        <img src="{{ asset('storage/projects/' . $project->image) }}" alt="Изображение проекта" class="img-fluid mb-3" width="100%" style="margin: auto">
    </div>

    <h2>{{__('Категория')}}: {{ $project->title }}</h2>
    <h3>{{__('Описание')}}:{{ $project->description }}</h3>
    <h3>{{__('Автор')}}: {{ $project->user->name }}</h3>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>{{__('Дата создания')}}: {{$project->created_at}}</h3>

        <div>
            @auth
                @if (Auth::user()->can(['update','delete'], $project))
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <x-projects.editAndDelete :project="$project" />
                    </div>
                @endif
                @if(Auth::user()->id != $project->user_id)
                        @if(Auth::user()->id != $project->user_id)
                            @if(Auth::user()->subprojects->contains('id',$project->id))
                                <x-projects.unsubscribed :project="$project" />
                            @else
                                <x-projects.subscribed :project="$project" />
                            @endif
                        @endif
                @endif
            @endauth
        </div>
    </div>

    @auth
        @if (Auth::user()->can(['update'], $project))
            <a style="width: 100%; margin-bottom: 10px" type="button"
               href="{{route('category.create',compact('project'))}}" class="btn btn-outline-success btn-lg btn-block">{{__('Cоздать категорию')}}</a>
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
                                       class="btn btn-sm btn-outline-secondary">{{__('Смотреть')}}</a>
                                    @auth
                                        @if (Auth::user()->can(['update','delete'], $project))

                                            <a href="{{ route('category.edit', compact('project','category')) }}"
                                               type="button" class="btn btn-sm btn-outline-secondary">{{__('Редактировать')}}</a>

                                            <form action="{{ route('category.destroy',compact('project','category')) }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">{{__('Удалить')}}
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
        <div style="margin-top: 20px">
            {{ $categories->links() }}
        </div>
    @endif
    <x-projects.comment :project="$project"/>
@endsection
