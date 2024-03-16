@extends('layouts.base')
@section('title')
    {{__('Добавление карточки')}}
@endsection
@section('main')
    <x-forms.base :header="'Создание карточки'" :route="route('card.store',compact('project','category'))" :textSubmit="'Создать'">
        <x-forms.input :title="'Термин'" :param="'term'" :paramValue="old('term')"/>
        <x-forms.input :title="'Определение'" :param="'definition'" :paramValue="old('definition')"/>
    </x-forms.base>
@endsection
