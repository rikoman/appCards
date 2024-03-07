@extends('base')
@section('title', 'Добавление проекта :: Мои проекты')
@section('main')
    <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="txtTitle">Проект</label>
            <input name="title" id="txtTitle" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title') }}">
            @error('title')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="txtDescription">Описание</label>
            <textarea name="description" id="txtDescription"
                      class="form-control @error('description') is-invalid @enderror"
                      row="3">{{ old('description') }}</textarea>
            @error('description')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <input type="file" name="image" accept="image/png, image/jpeg"/>

        <input type="submit" class="btn btn-primary" value="Добавить">
    </form>
@endsection
