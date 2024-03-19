@extends('layouts.base')
@section('title')
    {{__('Мои подписки')}}
@endsection
@section('main')
    @auth()
        <h1>{{__('Мои подписки')}}</h1>
        <x-projects.project :projects="$subprojects"/>
    @endauth
@endsection
