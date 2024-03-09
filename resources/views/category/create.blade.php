@extends('base')
@section('title', 'Добавление категории :: Мои категории')
@section('main')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Создание категории</div>
                    <div class="card-body">
                        <form action="{{ route('category.store', $project) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" name="title" id="title"
                                       class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea name="description" id="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          rows="3"></textarea>
                                @error('description')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <br>
                            </div>
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
