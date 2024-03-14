@extends('base')
@section('title')
    {{__('Редактирование комментария')}}
@endsection
@section('main')
        <form action="{{ route('project.comment.update', compact('project','comment')) }}"
              method="post">
            @csrf
            @method('PATCH')
            <textarea name="content" rows="4" cols="50"></textarea>
            <button type="submit">{{__('Add Comment')}}</button>
        </form>
@endsection
