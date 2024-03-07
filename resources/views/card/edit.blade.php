@extends('base')
@section('title', 'Правка проекта :: Мои проекты')
@section('main')
    <form action="{{ route('card.update', ['project'=>$project->id,'category'=>$category->id,'card'=>$card->id]) }}"
          method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="txtTerm">Товар</label>
            <input name="term" id="txtTerm" class="form-control @error('term') is-invalid @enderror"
                   value="{{ old('term', $card->term) }}">
            @error('term')
            <span class="invalid-feedback">
 <strong>{{ $message }}</strong>
 </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="txtDefinition">Товар</label>
            <input name="definition" id="txtDefinition" class="form-control @error('definition') is-invalid @enderror"
                   value="{{ old('definition', $card->definition) }}">
            @error('definition')
            <span class="invalid-feedback">
 <strong>{{ $message }}</strong>
 </span>
            @enderror
        </div>
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </form>
@endsection
