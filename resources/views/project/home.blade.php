@extends('layouts.base')
@section('title')
    {{__('Мои проекты')}}
@endsection
@section('main')
    @auth()
        <h1>{{__('Мои проекты')}}</h1>
        <div>
            <a style="width: 100%; margin-bottom: 10px" type="button" href="{{route('project.create')}}" class="btn btn-outline-success btn-lg btn-block">
                {{__('Cоздать проект')}}
            </a>
        </div>
        <x-projects.project :projects="$projects"/>
    @endauth
@endsection
