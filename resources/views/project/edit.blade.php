@extends('layouts.base')
@section('title')
    {{__( 'Правка проекта')}}
@endsection
@section('main')
    <x-forms.base :header="'Редактирование проекта'" :route="route('project.update',compact('project'))" :textSubmit="'Сохранить'">
        @method('PATCH')
        <x-forms.input :title="'Название'" :param="'title'" :paramValue="old('title', $project->title)"/>
        <x-forms.area :title="'Описание'" :param="'description'" :paramValue="old('description', $project->description)"/>
        <x-forms.input_img :param="'image'"/>
    </x-forms.base>
@endsection
