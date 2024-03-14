@extends('base')
@section('title')
    {{__('Правка проекта')}}
@endsection
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Редактирование категории')}}</div>
                    <div class="card-body">
                        <form action="{{ route('category.update',compact('project','category')) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="txtTitle">{{__('Название')}}</label>
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
                                <label for="txtDescription">{{__('Описание')}}</label>
                                <textarea name="description" id="txtDescription"
                                          class="form-control @error('description') is-invalid @enderror"
                                          row="3">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-primary" value="{{__('Сохранить')}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
