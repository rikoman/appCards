@extends('layouts.base')
@section('title', $project->title )
@section('main')

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
                        <x-projects.editAndDelete :project="$project"/>
                    </div>
                @endif

                @if(Auth::user()->id != $project->user_id)
                    @if(Auth::user()->subprojects->contains('id',$project->id))
                        <x-projects.unsubscribed :project="$project"/>
                    @else
                        <x-projects.subscribed :project="$project"/>
                    @endif
                @endif
            @endauth
        </div>
    </div>

    @auth
        @if (Auth::user()->can(['update'], $project))
            <a style="width: 100%; margin-bottom: 10px" type="button" href="{{route('category.create',compact('project'))}}" class="btn btn-outline-success btn-lg btn-block">
                {{__('Cоздать категорию')}}
            </a>
        @endif
    @endauth

    @auth
        <a style="width: 100%; margin-bottom: 10px" type="button" href="{{route('category.marathon',$project)}}" class="btn btn-outline-info btn-lg btn-block">
            {{__('Марафон')}}
        </a>
    @endauth

    <x-categories.category :categories="$categories" :project="$project"/>

    <x-projects.comment
        :comments="$project->comments()->get()"
        :routeCreate="route('project.comment.store', $project)"
        :routeUpdate="'project.comment.edit'"
        :routeDelete="'project.comment.destroy'"
        :project="$project"
    />
@endsection
