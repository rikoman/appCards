@extends('layouts.base')
@section('title','allCards')
@section('main')
    <x-cards.slider :cards="$allCards" />
@endsection
