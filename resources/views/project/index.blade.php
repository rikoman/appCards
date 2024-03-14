@extends('base')
@section('title')
    {{__('Главная')}}
@endsection
@section('main')
    @if (count($projects) > 0)
        <h1>{{__('Популярные проекты')}}</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($projects as $project)
                <x-projects.project :project="$project" />
            @endforeach
        </div>
        <div style="margin-top: 20px">
            {{ $projects->links() }}
        </div>
    @endif
@endsection
