
<div class="tile">
    <form action="{{ route('admin.setting.update-social-media-links-visibility') }}" method="POST" role="form">
        @csrf
        <hr>
        <h3>{{__('labels.social_media_links_visibility')}}</h3>
        <hr>

        <div class="">

            <div class="form-group">

                <label for="social_media_links_visibility">{{__('labels.social_media_links_visibility')}}</label>
                <select name="social_media_links_visibility" id="social_media_links_visibility" class="form-control">
                    <option value="2" @if((int)settings('social_media_links_visibility') === 2) selected @endif>{{__("labels.enable")}}</option>
                    <option value="1" @if((int)settings('social_media_links_visibility') === 1) selected @endif>{{__("labels.disabled")}}</option>
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
