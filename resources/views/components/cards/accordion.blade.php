@if(count($cards) > 0)
    <div class="accordion mt-3 mb-3" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    {{__('Набор карточек')}}
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table class="table">
                        <tbody>
                        @foreach ($cards as $card)
                            <tr>
                                <td><h4>{{ $card->term}}</h4></td>
                                <td><h4>{{ $card->definition }}</h4></td>
                                @auth
                                    @if(Auth::user()->can(['update','delete'], $card))
                                        <td>
                                            <div>
                                                <a class="btn btn-outline-success" href="{{ route('card.edit', compact('project','category','card')) }}">
                                                    {{__('Редактировать')}}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <form action="{{ route('card.destroy',compact('project','category','card')) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        {{__('Удалить')}}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                @endauth
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
