<div class="mb-3">
    <label for="{{$param}}" class="form-label">{{__($title)}}</label>
    <input type="text" name="{{$param}}" id="{{$param}}" class="form-control @error($param) is-invalid @enderror" value="{{ $paramValue }}" required >

    @error($param)
    <span class="invalid-feedback">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
