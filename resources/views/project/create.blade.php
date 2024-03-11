@extends('base')
@section('title', 'Добавление проекта :: Мои проекты')
@section('main')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создание проекта</div>
                <div class="card-body">
                    <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="txtTitle">Название</label>
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
                        <input type="file" name="image" class="@error('image') is-invalid @enderror" accept="image/png, image/jpeg"/>
                        @error('image')
                        <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="submit" class="btn btn-primary" value="Создать">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

