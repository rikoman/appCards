@extends('layouts.base')
@section('title')
    {{__('Поиск')}}
@endsection
@section('main')
    @if($results->count() > 0)
        <x-projects.project :project="$results"/>
    @else
        <p>{{__('Ничего не найдено.')}}</p>
    @endif
@endsection
