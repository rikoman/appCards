@extends('layouts.base')
@section('title')
    {{__('Главная')}}
@endsection
@section('main')
    <x-projects.project :projects="$projects"/>
@endsection
