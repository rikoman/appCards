@extends('base')
@section('title')
    {{__('Добавление категории')}}
@endsection
@section('main')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Создание категории')}}</div>
                    <div class="card-body">
                        <form action="{{ route('category.store', $project) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">{{__('Название')}}</label>
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
                                <label for="description">{{__('Описание')}}</label>
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
                            <button type="submit" class="btn btn-primary">{{__('Создать')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
