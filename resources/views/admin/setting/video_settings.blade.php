
<div class="tile">
    <form action="{{ route('admin.setting.update') }}" method="POST" role="form">
        @csrf

        <hr>

        <h3>{{__('labels.video_settings')}}</h3>

        <hr>


        <div class="">

            <x-form.input
                name="video_size" {{-- required --}}
                label=" ( Ko )"
                type="text" {{-- optional default=text --}}
                :is_required="true" {{-- optional default=false --}}
                value="{{ config('settings.video_size') }}"></x-form.input>

            <x-form.input
                name="video_duration" {{-- required --}}
                label=" ( Min )"
                type="time" {{-- optional default=text --}}
                :is_required="true" {{-- optional default=false --}}
                value="{{ config('settings.video_duration') }}"></x-form.input>

            <x-form.input
                name="max_width" {{-- required --}}
                type="text" {{-- optional default=text --}}
                :is_required="true" {{-- optional default=false --}}
                value="{{ config('settings.max_width') }}"></x-form.input>

            <x-form.input
                name="max_height" {{-- required --}}
                type="text" {{-- optional default=text --}}
                :is_required="true" {{-- optional default=false --}}
                value="{{ config('settings.max_height') }}"></x-form.input>

        </div>

        <div class="tile-footer">

            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>{{__('labels.save')}}</button>
                </div>
            </div>

        </div>

    </form>

</div>
