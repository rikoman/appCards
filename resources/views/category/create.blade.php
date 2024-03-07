@extends('base')
@section('title', 'Добавление категории :: Мои категории')
@section('main')
    <h1>Create Category for Project: {{ $project->name }}</h1>

    <form action="{{ route('category.store', $project) }}" method="post">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <br>
        <button type="submit">Create Category</button>
    </form>
@endsection
