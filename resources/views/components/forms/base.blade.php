<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">

            <div class="card-header">{{__($header)}}</div>

            <div class="card-body">
                <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{$slot}}

                    <input type="submit" class="btn btn-primary" value="{{__($textSubmit)}}">
                </form>
            </div>

        </div>
    </div>
</div>
