<div class="comments-section" style="margin-top: 30px">
    @auth
        <form method="POST" action="{{ $routeCreate }}">
            @csrf
            <textarea name="content" placeholder="Напишите сообщение" rows="3"></textarea>
            <button type="submit">{{__('Отправить')}}</button>
        </form>
    @endauth

    <div class="comments-list">
        @foreach ($comments as $comment)
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
                                <a
                                    @if(isset($category))
                                        href="{{ route($routeUpdate,compact('project','category','comment')) }}"
                                    @else
                                        href="{{ route($routeUpdate,compact('project','comment')) }}"
                                    @endif

                                >{{__('Редактировать')}}</a>
                                <form method="POST"
                                      @if(isset($category))
                                          action="{{ route($routeDelete,compact('project','category','comment')) }}"
                                      @else
                                          action="{{ route($routeDelete,compact('project','comment')) }}"
                                    @endif>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        {{__('Удалить')}}
                                    </button>
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
        function toggleMenu(button) {
            var menu = button.nextElementSibling;
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }

    </script>
