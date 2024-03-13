@extends('base')
@section('title', 'Правка проекта :: Мои проекты')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактирование категории</div>
                    <div class="card-body">
                        <form action="{{ route('category.update', ['project'=>$project->id,'category'=>$category->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="txtTitle">Название</label>
                                <input name="title" id="txtTitle"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $category->title) }}">
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
                                          row="3">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-primary" value="Сохранить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
