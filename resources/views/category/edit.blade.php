@extends('layouts.base')
@section('title')
    {{__('Правка проекта')}}
@endsection
@section('main')
    <x-forms.base :header="'Редактирование категории'" :route="route('category.update',compact('project','category'))" :textSubmit="'Сохранить'">
        @method('PATCH')
        <x-forms.input :title="'Название'" :param="'title'" :paramValue="old('title', $category->title)"/>
        <x-forms.area :title="'Описание'" :param="'description'" :paramValue="old('description', $category->title)"/>
    </x-forms.base>
@endsection
