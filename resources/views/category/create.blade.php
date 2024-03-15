@extends('base')
@section('title')
    {{__('Добавление категории')}}
@endsection
@section('main')
    <x-forms.base :header="'Создание категории'" :route="route('category.store', $project)" :textSubmit="'Создать'">
        <x-forms.input :title="'Название'" :param="'title'" :paramValue="old('title')"/>
        <x-forms.area :title="'Описание'" :param="'description'" :paramValue="old('description')"/>
    </x-forms.base>
@endsection
