<div class="comments-section" style="margin-top: 30px">
    @auth
        <form method="POST" action="{{ route('project.comment.store', $project) }}">
            @csrf
            <textarea name="content" placeholder="Напишите сообщение" rows="3"></textarea>
            <button type="submit">{{__('Отправить')}}</button>
        </form>
    @endauth

    <div class="comments-list">
        @foreach ($project->comments()->get() as $comment)
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
                                <a href="{{ route('project.comment.edit',compact('project','comment')) }}">{{__('Редактировать')}}</a>
                                <form method="POST"
                                      action="{{ route('project.comment.destroy', compact('project','comment')) }}">
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
