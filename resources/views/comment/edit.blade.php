@extends('base')
@section('main')
        <form action="{{ route('comment.update.cat', ['project' => $project->id, 'category' => $category->id,'comment'=>$comment->id]) }}"
              method="post">
            @csrf
            @method('PATCH')
            <textarea name="content" rows="4" cols="50"></textarea>
            <button type="submit">Add Comment</button>
        </form>
@endsection
