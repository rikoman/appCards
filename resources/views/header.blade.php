<header class="p-3 mb-3 border-bottom">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{ route('project.index') }}" class="nav-link px-2 link-secondary">{{__('Главная')}}</a></li>
            @auth
                <li><a href="{{ route('project.home') }}" class="nav-link px-2 link-dark">{{__('Мои проекты')}}</a></li>
                <li><a href="{{ route('project.sub') }}" class="nav-link px-2 link-dark">{{__('Мои подписки')}}</a></li>
            @endauth
        </ul>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="{{ route('search') }}">
            <input type="search" class="form-control" name="query" placeholder="Search..." aria-label="Search">
        </form>
        @guest
            <div class="col-md-2 text-end">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">{{__('Вход')}}</a>
                <a href="{{ route('register') }}" class="btn btn-primary">{{__('Регистрация')}}</a>
            </div>
        @endguest
        @auth
            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" onclick="toggleDropdown()">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="display: none;" id="dropdownMenu">
                    <li><a class="dropdown-item" href="{{route('profile.edit')}}">{{__('Профиль')}}</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">{{__('Выход')}}</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</header>
<script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdownMenu");
        if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
            dropdownMenu.style.display = "block";
        } else {
            dropdownMenu.style.display = "none";
        }
    }
</script>

