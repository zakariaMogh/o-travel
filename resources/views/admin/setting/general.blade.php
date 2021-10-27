
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
                    name="value_payed" {{-- required --}}
                    label=" ( % )"
                    type="number" {{-- optional default=text --}}
                    :is_required="true" {{-- optional default=false --}}
                    value="{{ config('settings.value_payed') }}"></x-form.input>

            </div>

            <div class="form-group">

                <x-form.input
                    name="site_tax" {{-- required --}}
                    label=" ( % )"
                    type="number" {{-- optional default=text --}}
                    :is_required="true" {{-- optional default=false --}}
                    value="{{ config('settings.value_added_tax') }}"></x-form.input>

            </div>

            <div class="form-group">

                <x-form.input
                    name="value_added_tax" {{-- required --}}
                    label=" ( % )"
                    type="number" {{-- optional default=text --}}
                    :is_required="true" {{-- optional default=false --}}
                    value="{{ config('settings.site_tax') }}"></x-form.input>

            </div>

            <div class="form-group">

                <x-form.input
                    name="min_withdrawal_amount" {{-- required --}}
                    label=" ( {{ config('settings.currency_code') }} )"
                    type="number" {{-- optional default=text --}}
                    :is_required="true" {{-- optional default=false --}}
                    value="{{ config('settings.min_withdrawal_amount') }}"></x-form.input>

            </div>

            <div class="form-group">

                <x-form.input
                    name="delivery_price" {{-- required --}}
                    label=" ( {{ config('settings.currency_code') }} )"
                    type="number" {{-- optional default=text --}}
                    :is_required="true" {{-- optional default=false --}}
                    value="{{ config('settings.delivery_price') }}"></x-form.input>

            </div>

            <div class="form-group">

                <x-form.input
                    name="number_of_invitation" {{-- required --}}
                    type="number" {{-- optional default=text --}}
                    :is_required="true" {{-- optional default=false --}}
                    value="{{ config('settings.number_of_invitation') }}"></x-form.input>

            </div>

            <div class="form-group">

                <x-form.input
                    name="pro_offer_price" {{-- required --}}
                    label=" ( {{ config('settings.currency_code') }} )"
                    type="number" {{-- optional default=text --}}
                    :is_required="true" {{-- optional default=false --}}
                    value="{{ config('settings.pro_offer_price') }}"></x-form.input>

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
