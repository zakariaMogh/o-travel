<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\UploadAble;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    use UploadAble;

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     * @throws AuthorizationException
     */
    public function index(): Renderable
    {
        $this->authorize('view-settings');
        return  view("admin.setting.index");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request): RedirectResponse
    {

        $this->authorize('edit-settings');
        if ($request->has('site_logo') && ($request->file('site_logo') instanceof UploadedFile)) {

            if (config('settings.site_logo') !== null) {
                $this->deleteOne(config('settings.site_logo'));
            }

            $logo = $this->uploadOne($request->file('site_logo'), 'img');
            Setting::set('site_logo', $logo);

        } elseif ($request->has('site_favicon') && ($request->file('site_favicon') instanceof UploadedFile)) {
            if (config('settings.site_favicon') !== null) {
                $this->deleteOne(config('settings.site_favicon'));
            }
            $favicon = $this->uploadOne($request->file('site_favicon'), 'img');
            Setting::set('site_favicon', $favicon);

        } else {
            $keys =  $this->getValidatedData($request);
//            $keys = $request->except(['_token', 'files']);
            foreach ($keys as $key => $value)
            {
                Setting::set($key, $value);
            }
        }

        session()->flash("success", __('messages.update'));
        return redirect()->back();
    }

    public function updateOfferAutoAccept(Request $request){
        $data = $request->validate(['auto_accept_offer_for_all' => 'required|integer|in:1,2|']);
        Setting::set('auto_accept_offer_for_all', $data['auto_accept_offer_for_all']);

        DB::table('companies')->update(['auto_accepted' => $data['auto_accept_offer_for_all']]);
        session()->flash("success", __('messages.update'));
        return redirect()->back();
    }

    public function updateSocielMediaLinksVisibility(Request $request){
        $data = $request->validate(['social_media_links_visibility' => 'required|integer|in:1,2|']);
        Setting::set('social_media_links_visibility', $data['social_media_links_visibility']);
        DB::table('companies')->update(['SML_visibility' => $data['social_media_links_visibility']]);
        session()->flash("success", __('messages.update'));
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getValidatedData(Request $request): array
    {
        return $request->validate([
            'min_order_amount' => 'nullable|sometimes|integer',
            'min_withdrawal_amount' => 'nullable|sometimes|integer',
            'delivery_price' => 'nullable|sometimes|integer',
            'site_tax' => 'nullable|sometimes|integer|min:0|max:100',
            'value_added_tax' => 'nullable|sometimes|integer|min:0|max:100',
            'contact_email' => 'nullable|sometimes|email',
            'default_email_address' => 'nullable|sometimes|email',
            'seller_terms_of_use' => 'nullable|sometimes',
            'user_terms_of_use' => 'nullable|sometimes',
            'privacy_policy' => 'nullable|sometimes',
            'address' => 'nullable|sometimes',
            'phone' => 'nullable|sometimes',
            'site_name' => 'nullable|sometimes',
            'fax' => 'nullable|sometimes',
            'social_facebook' => 'nullable|sometimes',
            'social_linkedin' => 'nullable|sometimes',
            'social_twitter' => 'nullable|sometimes',
            'social_instagram' => 'nullable|sometimes',
            'social_snapchat' => 'nullable|sometimes',
            'social_youtube' => 'nullable|sometimes',
            'about_us' => 'nullable|sometimes',
            'seller_app_ios' => 'nullable|sometimes',
            'seller_app_android' => 'nullable|sometimes',
            'user_app_ios' => 'nullable|sometimes',
            'user_app_android' => 'nullable|sometimes',
            'video_duration' => 'nullable|sometimes|string',
            'video_size' => 'nullable|sometimes|integer',
            'currency_code' => 'nullable|sometimes|string',
            'max_width' => 'nullable|sometimes|integer',
            'max_height' => 'nullable|sometimes|integer',
            'value_payed' => 'nullable|sometimes|integer',
            'number_of_invitation' => 'nullable|sometimes|integer',
            'pro_offer_price' => 'nullable|sometimes|integer',
            'offer_limits' => 'nullable|sometimes|integer',
        ]);
    }

}
