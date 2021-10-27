<div class="form-group">
    <label for="{{$name}}">{{__('labels.'.$name)}}
        @if($is_required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <textarea
        class="form-control @error($name) is-invalid @enderror"
        rows="{{$rows}}"
        cols="{{$cols}}"
        id="{{$name}}"
        name="{{$name}}"
        placeholder="{{__('labels.'.$name)}}"
        @if($is_disabled) disabled @endif
        @if($is_required) required @endif
    >{!! old($name, $value) !!}</textarea>

    @error($name)
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
