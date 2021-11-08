
<div class="tile">
    <form action="{{ route('admin.setting.update') }}" method="POST" role="form">
        @csrf
        <hr>
        <h3>{{__('labels.general_settings')}}</h3>
        <hr>

        <div class="">

            <div class="form-group">

                <x-form.input
                    name="currency_code" {{-- required --}}
                    type="text" {{-- optional default=text --}}
                    :is_required="true" {{-- optional default=false --}}
                    value="{{ config('settings.currency_code') }}"></x-form.input>

            </div>

            <div class="form-group">

                <x-form.input
                    name="offer_limits" {{-- required --}}
                    type="number" {{-- optional default=text --}}
                    :is_required="true" {{-- optional default=false --}}
                    value="{{ config('settings.offer_limits') }}"></x-form.input>

            </div>



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
