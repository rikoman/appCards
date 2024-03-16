<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom bg-white mb-3">

    <div class="container-fluid">
        <img src="https://pngicon.ru/file/uploads/instagram.png" alt="" width="30" height="30" class="d-inline-block align-text-top">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a href="{{ route('project.index') }}" class="nav-link px-2 link-secondary">{{__('Главная')}}</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a href="{{ route('project.home') }}" class="nav-link px-2 link-secondary" aria-current="page">{{__('Мои проекты')}}</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('project.sub') }}" class="nav-link px-2 link-secondary" aria-current="page">{{__('Мои подписки')}}</a>
                    </li>
                @endauth


            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="{{ route('search') }}">
                <input type="search" class="form-control" name="query" placeholder="Search..." aria-label="Search">
            </form>

            @auth
                <div class="dropdown text-end">

                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" aria-expanded="false" data-bs-toggle="dropdown">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>

                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li>
                            <a class="dropdown-item" href="{{route('profile.edit')}}">{{__('Профиль')}}</a>
                        </li>

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

            @guest
                <div class="col-md-2 text-end">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">{{__('Вход')}}</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">{{__('Регистрация')}}</a>
                </div>
            @endguest

        </div>
    </div>
</nav>
