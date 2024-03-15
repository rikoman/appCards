<div class="mb-3">
    <label for="{{$param}}" class="form-label">{{__($title)}}</label>
    <textarea name="{{$param}}" id="{{$param}}" class="form-control @error($param) is-invalid @enderror" rows="3">{{ $paramValue }}</textarea>

    @error($param)
    <span class="invalid-feedback">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
