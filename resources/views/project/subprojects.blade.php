@extends('layouts.base')
@section('title')
    {{__('Мои подписки')}}
@endsection
@section('main')
    @auth()
        <h1>{{__('Мои подписки')}}</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @if (count($subprojects) > 0)
                @foreach($subprojects as $project)
                    <x-projects.project :project="$project"/>
                @endforeach
        </div>
        <div class="mt-3">
            {{ $subprojects->links() }}
        </div>
    @endif
    @endauth
@endsection
