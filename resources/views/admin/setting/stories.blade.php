
<div class="tile">
    <form action="{{ route('admin.setting.update-stories') }}" method="POST" role="form">
        @csrf
        <hr>
        <h3>{{trans_choice('labels.story', 2)}}</h3>
        <hr>

        <div class="">

            <div class="form-group">

                <label for="stories">{{trans_choice('labels.story', 2)}}</label>
                <select name="stories" id="stories" class="form-control">
                    <option value="1" @if((int)settings('stories') === 1) selected @endif>{{__("labels.enable")}}</option>
                    <option value="2" @if((int)settings('stories') === 2) selected @endif>{{__("labels.disabled")}}</option>
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
