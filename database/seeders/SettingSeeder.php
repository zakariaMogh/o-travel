<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $settings = [
        [
            'key' => 'site_name',
            'value' => 'HUMEATO',
        ],

        [
            'key'   =>  'video_duration',
            'value' =>  '01:45',
        ],

        [
            'key'   =>  'video_size',
            'value' =>  10240,
        ],

        [
            'key'   =>  'max_width',
            'value' =>  1920,
        ],

        [
            'key'   =>  'max_height',
            'value' =>  1080,
        ],
        [
            'key' => 'contact_email',
            'value' => 'contact@humeato.com',
        ],
        [
            'key' => 'phone',
            'value' => '+213 25458458558',
        ],
        [
            'key' => 'address',
            'value' => 'This is a dummy address, just for testing.',
        ],
        [
            'key' => 'fax',
            'value' => '+213 5224565552',
        ],
        [
            'key' => 'default_email_address',
            'value' => 'admin@admin.com',
        ],
        [
            'key' => 'currency_code',
            'value' => 'SAR',
        ],
        [
            'key' => 'currency_symbol',
            'value' => 'ر.س',
        ],
        [
            'key' => 'site_logo',
            'value' => '',
        ],
        [
            'key' => 'site_favicon',
            'value' => '',
        ],
        [
            'key' => 'footer_copyright_text',
            'value' => '',
        ],
        [
            'key' => 'seo_meta_title',
            'value' => '',
        ],
        [
            'key' => 'seo_meta_description',
            'value' => '',
        ],
        [
            'key' => 'social_facebook',
            'value' => '#',
        ],
        [
            'key' => 'social_twitter',
            'value' => '#',
        ],
        [
            'key' => 'social_instagram',
            'value' => '#',
        ],
        [
            'key' => 'social_snapchat',
            'value' => '#',
        ],
        [
            'key' => 'social_youtube',
            'value' => '#',
        ],
        [
            'key' => 'social_linkedin',
            'value' => '',
        ],
        [
            'key' => 'google_analytics',
            'value' => '',
        ],
        [
            'key' => 'facebook_pixels',
            'value' => '',
        ],
        [
            'key' => 'stripe_payment_method',
            'value' => '',
        ],
        [
            'key' => 'stripe_key',
            'value' => '',
        ],
        [
            'key' => 'stripe_secret_key',
            'value' => '',
        ],
        [
            'key' => 'paypal_payment_method',
            'value' => '',
        ],
        [
            'key' => 'paypal_client_id',
            'value' => '',
        ],
        [
            'key' => 'paypal_secret_id',
            'value' => '',
        ],
        [
            'key' => 'footer_copyright_link',
            'value' => '',
        ],
        [
            'key' => 'value_added_tax',
            'value' => 15,
        ],
        [
            'key' => 'site_tax',
            'value' => 5,
        ],
        [
            'key' => 'search_diameter',
            'value' => 100000,
        ],
        [
            'key' => 'min_withdrawal_amount',
            'value' => 10,
        ],
        [
            'key' => 'min_order_amount',
            'value' => 150,
        ],
        [
            'key' => 'privacy_policy',
            'value' => '',
        ],
        [
            'key' => 'terms_of_use',
            'value' => '',
        ],
        [
            'key' => 'user_terms_of_use',
            'value' => '',
        ],
        [
            'key' => 'seller_terms_of_use',
            'value' => '',
        ],
        [
            'key' => 'about_us',
            'value' => '',
        ],
        [
            'key' => 'delivery_price',
            'value' => 200,
        ],
        [
            'key' => 'seller_app_ios',
            'value' => '',
        ],
        [
            'key' => 'seller_app_android',
            'value' => '',
        ],
        [
            'key' => 'user_app_ios',
            'value' => '',
        ],
        [
            'key' => 'user_app_android',
            'value' => '',
        ],
        [
            'key' => 'seller_instruction',
            'value' => '',
        ],
        [
            'key' => 'user_instruction',
            'value' => '',
        ],
        [
            'key' => 'value_payed',
            'value' => 10,
        ],
        [
            'key' => 'number_of_invitation',
            'value' => 5,
        ],
        [
            'key' => 'pro_offer_price',
            'value' => 200,
        ],

        [
            'key' => 'offer_limits',
            'value' => 20,
        ],
        [
            'key' => 'auto_accept_offer_for_all',
            'value' => 2,
        ],
        [
            'key' => 'social_media_links_visibility',
            'value' => 2,
        ],
        [
            'key' => 'stories',
            'value' => 1,
        ],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Start inserting settings');
        foreach ($this->settings as $index => $setting) {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Admin permissions was inserted Successfully');
    }
}
