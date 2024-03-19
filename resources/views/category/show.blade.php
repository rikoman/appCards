@extends('layouts.base')
@section('title', $category->title );
@section('main')
    <div>
        <x-cards.slider :cards="$cards"/>

        @auth
            @if(Auth::user()->can(['update'], $project))
                <div class="mt-3">
                    <a style="width: 100%; margin-bottom: 10px" type="button" href="{{route('card.create',compact('category','project'))}}" class="btn btn-outline-success btn-lg btn-block">
                        {{__('Создать карточку')}}
                    </a>
                </div>
            @endif
        @endauth

        <x-cards.accordion
            :cards="$cards"
            :project="$project"
            :category="$category"
        />
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <form action="{{route('card.export',compact('project','category'))}}" method="get">
            <button type="submit" class="btn btn-primary">
                {{__('скачать excel')}}
            </button>
        </form>

        @auth
            @if(Auth::user()->can(['update'], $category))

                <form action="{{ route('card.import', compact('project','category')) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="import_file">
                            {{__('Choose Excel File to Import')}}:
                        </label>
                        <input type="file" name="import_file" id="import_file" class="form-control-file">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{__('Import')}}
                    </button>
                </form>
            @endif
        @endauth

    </div>

    <x-projects.comment
        :comments="$category->comments()->get()"
        :routeCreate="route('category.comment.store', [$project , $category])"
        :routeUpdate="'category.comment.edit'"
        :routeDelete="'category.comment.destroy'"
        :project="$project"
        :category="$category"
    />
@endsection
