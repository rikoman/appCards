<div class="col">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-text">{{ $category->title }}</h3>
            <p>{{$category->description}}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{route('category.show',compact('project','category'))}}" type="button" class="btn btn-sm btn-outline-secondary">{{__('Смотреть')}}</a>
                    @auth
                        @if (Auth::user()->can(['update','delete'], $category))
                            <a href="{{ route('category.edit', compact('project','category')) }}" type="button" class="btn btn-sm btn-outline-secondary">{{__('Редактировать')}}</a>
                            <form action="{{ route('category.destroy',compact('project','category')) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-secondary">{{__('Удалить')}}
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
                <small class="text-muted">{{$category->created_at->format('d-m-y')}}</small>
            </div>
        </div>
    </div>
</div>
