@extends('base')
@section('title', $category->title );
@section('main')
    <div>
        @vite('resources/css/card/main.css')
        @vite('resources/css/card/comment.css')
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
                          class="btn btn-outline-success btn-lg btn-block">{{__('Создать карточку')}}</a></p>
                </div>
            @endif
        @endauth

        @if(count($cards) > 0)
            <table class="table">
                <tbody>
                @foreach ($cards as $card)
                    <tr>
                        <td><h4>{{ $card->term}}</h4></td>
                        <td><h4>{{ $card->definition }}</h4></td>
                        @auth
                            @if(Auth::user()->can(['update'], $project))
                                <td>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <a class="btn btn-outline-success"
                                               href="{{ route('card.edit', ['project' => $project->id, 'category' => $category->id, 'card' => $card->id]) }}">{{__('Редактировать')}}</a>
                                        </div>
                                        <div>
                                            <form action="{{ route('card.destroy', ['project' => $project->id, 'category' => $category->id, 'card' => $card->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger">{{__('Удалить')}}</button>
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

    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        @auth
            <form action="{{route('card.export',compact('project','category'))}}" method="get">
                <button type="submit" class="btn btn-primary">{{__('скачать excel')}}</button>
            </form>

            @if(Auth::user()->can(['update'], $project))
                <form action="{{ route('card.import', compact('project','category')) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="import_file">{{__('Choose Excel File to Import')}}:</label>
                        <input type="file" name="import_file" id="import_file" class="form-control-file">
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Import')}}</button>
                </form>
            @endif
        @endauth
    </div>

    <div class="comments-section" style="margin-top: 30px">

        @auth
            <form method="POST" action="{{ route('category.comment.store', compact('project','category')) }}">
                @csrf
                <textarea name="content" placeholder="{{__('Напишите сообщение')}}" rows="3"></textarea>
                <button type="submit">{{__('Отправить')}}</button>
            </form>
        @endauth

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
                                <div class="dropdown-menu hidden" >
                                    <a href="{{ route('category.comment.edit',compact('project','category','comment')) }}">{{__('Редактировать')}}</a>
                                    <form method="POST" action="{{ route('category.comment.destroy', compact('project','category','comment')) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">{{__('Удалить')}}</button>
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
    <script>
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

            function toggleMenu(button) {
            var menu = button.nextElementSibling;
            if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
        }

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

    </script>
@endsection
