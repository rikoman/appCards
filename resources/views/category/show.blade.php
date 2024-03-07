@extends('base')
@section('title', $category->title );
@section('main')
    <h2>категория - {{ $category->title }}</h2>
    <style>
        * {
            box-sizing: border-box
        }

        body {
            font-family: Verdana, sans-serif;
            margin: 0
        }

        .mySlides {
            display: none
        }

        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        .olo {
            width: 100%;
            height: 400px;
            background-color: indianred;
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .prev, .next, .text {
                font-size: 11px
            }
        }

        .oner {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>

    <div class="slideshow-container">
        @foreach($cards as $key => $card)
            <div class="mySlides">
                <div class="numbertext">1 / 3</div>
                <div class="olo " onclick="toggleCard(this)">
                    <div class="card-body oner">
                        <h3 class="card-title">{{ $card->term }}</h3>
                        <h3 class="card-text" style="display: none;">{{ $card->definition }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
    </div>
    <br>

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
    <p><a href="{{route('project.show',compact('project'))}}">На перечень категорий</a></p>

    <form action="{{ route('comment.storecat', ['project' => $project->id, 'category' => $category->id]) }}"
          method="post">
        @csrf
        <textarea name="content" rows="4" cols="50"></textarea>
        <button type="submit">Add Comment</button>
    </form>

    @foreach($category->comments()->get() as $comment)
        <p>{{$comment->content}} - {{$comment->user->name }} -- {{$comment->created_at}}</p>
        <form action="{{ route('comment.update.cat', compact('project','category','comment')) }}" method="POST">
            @csrf
            @method('PATCH')
            <textarea name="content" rows="4" cols="50"></textarea>
            <button type="submit">Update Comment</button>
        </form>
        <form action="{{ route('comment.destroy.cat', compact('project','category','comment')) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete Comment</button>
        </form>
    @endforeach
    @auth
        @if(Auth::user()->can(['update'], $project))
            <p><a href="{{route('card.create',compact('category','project'))}}">Создать карточку</a></p>
        @endif
    @endauth
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th>Определение</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cards as $card)
            <tr>
                <td><h3>{{ $card->term }}</h3></td>
                <td>{{ $card->definition }}</td>
                @auth
                    @if(Auth::user()->can(['update'], $project))
                        <td>
                            <a href="{{ route('card.edit', ['project' => $project->id, 'category' => $category->id, 'card' => $card->id]) }}">Изменить</a>
                        </td>
                        <td>
                            <form
                                action="{{ route('card.destroy', ['project' => $project->id, 'category' => $category->id, 'card' => $card->id]) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    @endif
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
