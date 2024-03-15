@extends('base')
@section('title')
    {{__('Редактирование комментария')}}
@endsection
@section('main')
    <x-forms.base :header="'Редактирование комментария'" :route="route('project.comment.update', compact('project','comment'))" :textSubmit="'Сохранить'">
        @method('PATCH')
        <x-forms.area :title="'Сообщение'" :param="'content'" :paramValue="old('content',$comment->content)"/>
    </x-forms.base>
@endsection
