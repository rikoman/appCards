<form action="{{ route('project.subscribed', $project) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-sm btn-outline-secondary">
        {{__('Подписаться')}}
    </button>
</form>
