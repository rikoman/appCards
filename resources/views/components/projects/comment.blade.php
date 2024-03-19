<div>
    @auth
        <div class="mb-3">
            <form method="POST" action="{{ $routeCreate }}">
                @csrf
                <textarea name="content" class="form-control" rows="3"
                          placeholder="{{__('Напишите сообщение')}}"></textarea>
                <button type="submit" class="btn btn-primary mt-2">{{__('Отправить')}}</button>
            </form>
        </div>
    @endauth

    <div>
        @foreach ($comments as $comment)

            <div class="border-bottom d-flex justify-content-between align-items-center">
                <div class="">
                    <div>
                        <span>{{ $comment->user->name }}</span>
                        <small>{{ $comment->created_at->format('j M Y, g:i a') }}</small>
                    </div>
                    <p>{{ $comment->content }}</p>
                </div>

                @auth
                    @if (Auth::user()->id=== $comment->user->id)
                        <div class="dropdown">
                            <img src="https://cdn-icons-png.flaticon.com/512/64/64576.png" alt="" width="20" height="20"
                                 class="d-inline-block align-text-top" data-bs-toggle="dropdown">

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item"
                                       @if(isset($category))
                                           href="{{ route($routeUpdate,compact('project','category','comment')) }}"
                                       @else
                                           href="{{ route($routeUpdate,compact('project','comment')) }}"
                                        @endif>
                                        {{__('Редактировать')}}
                                    </a>
                                </li>

                                <li>
                                    <form method="POST" class="dropdown-item"

                                          @if(isset($category))
                                              action="{{ route($routeDelete,compact('project','category','comment')) }}"
                                          @else
                                              action="{{ route($routeDelete,compact('project','comment')) }}"
                                        @endif>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-link text-dark p-0 text-decoration-none text-reset">
                                            {{__('Удалить')}}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                @endauth

            </div>

        @endforeach
    </div>
</div>
