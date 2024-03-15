<div class="mb-3">
    <input type="file" name="{{$param}}" class="@error($param) is-invalid @enderror" accept="image/png, image/jpeg"/>

    @error($param)
    <span class="invalid-feedback">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
