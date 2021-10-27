<div class="form-group">
    <label for="{{$name}}">{{__('labels.'.$name)}}
        @if($is_required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <select
        class="custom-select @error($name) is-invalid @enderror"
        id="{{$name}}"
        name="{{$name}}"
        @if($is_disabled) disabled @endif
        @if($is_required) required @endif>
        @if($default)
            <option selected value="">{{$default}}</option>
        @endif
            @foreach($options as $option_name => $option_value)
                <option value="{{$option_value}}" {{old($name, $value) == $option_value ? 'selected' : ''}}>{{$option_name}}</option>
            @endforeach
    </select>
    @error($name)
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
