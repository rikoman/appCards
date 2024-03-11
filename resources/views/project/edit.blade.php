@extends('base')
@section('title', 'Правка проекта :: Мои проекты')
@section('main')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование проекта</div>
                <div class="card-body">
                    <form action="{{ route('project.update', ['project' => $project->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="txtTitle">Товар</label>
                            <input name="title" id="txtTitle" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $project->title) }}">
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
                                      row="3">{{ old('description', $project->description) }}</textarea>
                            @error('description')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="file" name="image" class="@error('image') is-invalid @enderror accept="image/png, image/jpeg"/>
                        @error('image')
                        <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="submit" class="btn btn-primary" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
