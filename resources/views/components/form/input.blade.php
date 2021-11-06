<div id='form-container-{{$name}}'>
    <label for="{{$name}}" >{{__('labels.'.$name).$label}}
        @if($is_required)
            <span
                class="text-danger">*</span>
        @endif</label>
    <input type="{{$type}}"
           class="form-control @error($name) is-invalid @enderror"
           id="{{$name}}"
           name="{{$name}}"
           placeholder="{{__('labels.'.$name)}}"
           value="{{old($name, $value)}}"
           @if($is_disabled) disabled @endif
           @if($is_required) required @endif />
    @error($name)
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
