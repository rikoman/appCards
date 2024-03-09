@extends('base')
@section('title', 'Добавление карточки :: Мои карточки')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Создание карточки</div>

                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('card.store', ['project' => $project, 'category' => $category]) }}">
                            @csrf

                            <div class="form-group">
                                <label for="term">Термин</label>
                                <input type="text" name="term" id="term" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="definition">Определение</label>
                                <input type="text" name="definition" id="definition" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
