<div class="form-check">
    <input
        class="form-check-input @error($name) is_invalid @enderror"
        type="checkbox"
        id="{{$name}}"
        name="{{$name}}"
        @if($checked) checked @endif
        @if($is_required) required @endif>
    <label class="form-check-label" for="{{$name}}">
        {{__('labels.'.$name)}}
        @if($is_required)<span
            class="text-danger">*</span>
        @endif
    </label>
    @error($name)
    <span class="text-danger small">
        <i class="fas fa-info-circle mr-1"></i>{{$message}}
    </span>
    @enderror
</div>
