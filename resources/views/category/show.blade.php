@extends('base')
@section('title', $category->title );
@section('main')
    @vite('resources/css/card/main.css')
    <p><a href="{{route('project.show',compact('project'))}}">На перечень категорий надо будет удалить</a></p>

    @if(count($cards)>0)
        <div class="slideshow-container">
            @foreach($cards as $key => $card)
                <div class="mySlides">
                    <div class="numbertext">{{$key+1}} / {{count($cards)}}</div>
                    <div class="card-container " onclick="toggleCard(this)">
                        <div class="card-body card-content">
                            <h1 class="card-title" style="color: green">{{ $card->term }}</h1>
                            <h1 class="card-text" style="display: none; color: red">{{ $card->definition }}</h1>
                        </div>
                    </div>
                </div>
            @endforeach
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
        </div>
    @endif
    <br>

    @auth
        @if(Auth::user()->can(['update'], $project))
            <div>
                <p><a style="width: 100%; margin-bottom: 10px" type="button"
                      href="{{route('card.create',compact('category','project'))}}"
                      class="btn btn-outline-success btn-lg btn-block">Создать карточку</a></p>
            </div>
        @endif
    @endauth

    @if(count($cards) > 0)
        <table class="table">
            <tbody>
            @foreach ($cards as $card)
                <tr>
                    <td><h4>{{ $card->term }}</h4></td>
                    <td><h4>{{ $card->definition }}</h4></td>
                    @auth
                        @if(Auth::user()->can(['update'], $project))
                            <td>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <a class="btn btn-outline-success"
                                           href="{{ route('card.edit', ['project' => $project->id, 'category' => $category->id, 'card' => $card->id]) }}">Редактировать</a>
                                    </div>
                                    <div>
                                        <form
                                            action="{{ route('card.destroy', ['project' => $project->id, 'category' => $category->id, 'card' => $card->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Удалить</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        @endif
                    @endauth
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

        function toggleCard(card) {
            var cardText = card.querySelector('.card-text');
            var cardTitle = card.querySelector('.card-title');
            if (cardText.style.display === "none") {
                cardText.style.display = "block";
                cardTitle.style.display = "none";
            } else {
                cardText.style.display = "none";
                cardTitle.style.display = "block";
            }
        }
    </script>
@endsection


<!--
    Комментарии, потом надо будеть сделать норм стили
-->

{{--    <form action="{{ route('comment.storecat', ['project' => $project->id, 'category' => $category->id]) }}"--}}
{{--          method="post">--}}
{{--        @csrf--}}
{{--        <textarea name="content" rows="4" cols="50"></textarea>--}}
{{--        <button type="submit">Add Comment</button>--}}
{{--    </form>--}}

{{--    @foreach($category->comments()->get() as $comment)--}}
{{--        <p>{{$comment->content}} - {{$comment->user->name }} -- {{$comment->created_at}}</p>--}}
{{--        <form action="{{ route('comment.update.cat', compact('project','category','comment')) }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('PATCH')--}}
{{--            <textarea name="content" rows="4" cols="50"></textarea>--}}
{{--            <button type="submit">Update Comment</button>--}}
{{--        </form>--}}
{{--        <form action="{{ route('comment.destroy.cat', compact('project','category','comment')) }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('DELETE')--}}
{{--            <button type="submit" class="btn btn-danger btn-sm">Delete Comment</button>--}}
{{--        </form>--}}
{{--    @endforeach--}}
