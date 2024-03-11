@extends('base')
@section('title', $category->title );
@section('main')
    <div>
        @vite('resources/css/card/main.css')
{{--        <p><a href="{{route('project.show',compact('project'))}}">На перечень категорий надо будет удалить</a></p>--}}

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
    </div>

    <div class="comments-section" style="margin-top: 30px">
        <!-- Форма для добавления нового комментария -->
        <form method="POST"
              action="{{ route('comment.storecat', ['project' => $project->id, 'category' => $category->id]) }}"
        >
            @csrf
            <textarea name="content" placeholder="Напишите сообщение" rows="3"></textarea>
            <button type="submit">Отправить</button>
        </form>

        <!-- Список комментариев -->
        <div class="comments-list">
            @foreach ($category->comments()->get() as $comment)
                <div class="comment">
                    <div class="user-info">
                        <div>
                            <span>{{ $comment->user->name }}</span>
                            <small>{{ $comment->created_at->format('j M Y, g:i a') }}</small>
                        </div>
                        @if ($comment->user == auth()->user())
                            <div class="dropdown">
                                <button onclick="toggleMenu(this)">
                                    #
                                </button>
                                <div class="dropdown-menu hidden">
                                    <a href="{{ route('comment.edit.cat',compact('project','category','comment')) }}">Редактировать</a>
                                    <form method="POST" action="{{ route('comment.destroy.cat', compact('project','category','comment')) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <style>

        .comments-section form {
            margin-bottom: 20px;
        }

        .comments-section form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .comments-section form button {
            background-color: #3490dc;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comments-section form button:hover {
            background-color: #2779bd;
        }

        /*Стили для выпадающего списка*/
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown button {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .dropdown .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .dropdown .dropdown-menu a {
            color: #333;
            padding: 8px 12px;
            display: block;
            text-decoration: none;
        }

        .dropdown .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
        /*Стили для блока комментариев*/
        .comment {
            padding: 12px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .comment .user-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment .user-info small {
            color: #777;
            font-size: 0.8rem;
        }

        .comment .dropdown button {
            font-size: 1rem;
            color: #999;
        }

        .comment .content {
            margin-top: 10px;
        }
    </style>
    <script>
        function toggleMenu(button) {
            var menu = button.nextElementSibling;
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }
    </script>
@endsection
