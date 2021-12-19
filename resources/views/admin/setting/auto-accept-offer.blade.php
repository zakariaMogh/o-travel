
<div class="tile">
    <form action="{{ route('admin.setting.update-auto-accept-offer') }}" method="POST" role="form">
        @csrf
        <hr>
        <h3>{{__('labels.auto_accept_offer_for_all')}}</h3>
        <hr>

        <div class="">

            <div class="form-group">

                <label for="auto_accept_offer_for_all">{{__('labels.auto_accept_offer_for_all')}}</label>
                <select name="auto_accept_offer_for_all" id="auto_accept_offer_for_all" class="form-control">
                    <option value="2" @if((int)settings('auto_accept_offer_for_all') === 2) selected @endif>{{__("labels.enable")}}</option>
                    <option value="1" @if((int)settings('auto_accept_offer_for_all') === 1) selected @endif>{{__("labels.disabled")}}</option>
                </select>

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
