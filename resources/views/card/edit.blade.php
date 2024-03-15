@extends('layouts.base')
@section('title')
    {{__( 'Редактирование карточки')}}
@endsection
@section('main')
    <x-forms.base :header="'Редактирование карточки'" :route="route('card.update', compact('project','category','card'))" :textSubmit="'Сохранить'">
        @method('PATCH')
        <x-forms.input :title="'Термин'" :param="'term'" :paramValue="old('term', $card->term)"/>
        <x-forms.input :title="'Определение'" :param="'definition'" :paramValue="old('definition', $card->definition)"/>
    </x-forms.base>
@endsection
