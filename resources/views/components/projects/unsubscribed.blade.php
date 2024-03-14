<form action="{{ route('project.unsubscribed', $project) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-sm btn-outline-secondary">
        {{__('Отписаться')}}
    </button>
</form>
