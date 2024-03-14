<a href="{{ route('project.edit', $project) }}"
   type="button" class="btn btn-sm btn-outline-secondary">{{__('Редактировать')}}</a>
<form action="{{ route('project.destroy', $project) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-outline-secondary">{{__('Удалить')}}
    </button>
</form>
