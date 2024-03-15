@extends('layouts.base')
@section('title')
    {{__('Создание проекта')}}
@endsection
@section('main')
    <x-forms.base :header="'Создание проекта'" :route="route('project.store')" :textSubmit="'Создать'">
        <x-forms.input :title="'Название'" :param="'title'" :paramValue="old('title')"/>
        <x-forms.area :title="'Описание'" :param="'description'" :paramValue="old('description')"/>
        <x-forms.input_img :param="'image'"/>
    </x-forms.base>
@endsection

