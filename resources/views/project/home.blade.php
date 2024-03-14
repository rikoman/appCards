@extends('base')
@section('title')
    {{__('Мои проекты')}}
@endsection
@section('main')
    @auth()
        <h1>{{__('Мои проекты')}}</h1>
        <div>
            <a style="width: 100%; margin-bottom: 10px" type="button" href="{{route('project.create')}}" class="btn btn-outline-success btn-lg btn-block">{{__('Cоздать проект')}}</a>
        </div>
        @if (count($projects) > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($projects as $project)
                    <x-projects.project :project="$project" />
                @endforeach
            </div>
            <div style="margin-top: 20px">
                {{ $projects->links() }}
            </div>
        @endif
    @endauth
@endsection
