@extends('layouts.base')
@section('title', $category->title );
@section('main')
    <div>
        @vite('resources/css/card/main.css')
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

        @auth
            @if(Auth::user()->can(['update'], $project))
                <div class="mt-3">
                    <a style="width: 100%; margin-bottom: 10px" type="button"
                       href="{{route('card.create',compact('category','project'))}}"
                       class="btn btn-outline-success btn-lg btn-block">{{__('Создать карточку')}}</a>
                </div>
            @endif
        @endauth
        @if(count($cards) > 0)
            <div class="accordion mt-3 mb-3" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Набор карточек
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table">
                                <tbody>
                                @foreach ($cards as $card)
                                    <tr>
                                        <td><h4>{{ $card->term}}</h4></td>
                                        <td><h4>{{ $card->definition }}</h4></td>
                                        @auth
                                            @if(Auth::user()->can(['update','delete'], $card))
                                                <td>
                                                    <div class="d-flex justify-content-between align-items-center ">
                                                        <div>
                                                            <a class="btn btn-outline-success"
                                                               href="{{ route('card.edit', ['project' => $project->id, 'category' => $category->id, 'card' => $card->id]) }}">{{__('Редактировать')}}</a>
                                                        </div>
                                                        <div>
                                                            <form
                                                                action="{{ route('card.destroy', ['project' => $project->id, 'category' => $category->id, 'card' => $card->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="btn btn-outline-danger">{{__('Удалить')}}</button>
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
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        @auth
            <form action="{{route('card.export',compact('project','category'))}}" method="get">
                <button type="submit" class="btn btn-primary">{{__('скачать excel')}}</button>
            </form>

            @if(Auth::user()->can(['update'], $category))

                <form action="{{ route('card.import', compact('project','category')) }}" method="POST"
                      enctype="multipart/form-data">
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

    <x-projects.comment
        :comments="$category->comments()->get()"
        :routeCreate="route('category.comment.store', [$project , $category])"
        :routeUpdate="'category.comment.edit'"
        :routeDelete="'category.comment.destroy'"
        :project="$project"
        :category="$category"

    />
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
