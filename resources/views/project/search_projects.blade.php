@extends('layouts.base')
@section('title')
    {{__('Поиск')}}
@endsection
@section('main')
    @if($results->count() > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($results as $project)
                <x-projects.project :project="$project" />
            @endforeach
            @else
                <p>{{__('Ничего не найдено.')}}</p>
        </div>
    @endif
@endsection
