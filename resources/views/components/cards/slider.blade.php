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
