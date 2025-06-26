<?php

namespace App\Http\Requests;

use App\Rules\ValidateExtendedLicenseRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'license_key' => ['sometimes', 'required'],
            'index' => ['sometimes', 'nullable', 'url'],
            'logo' => ['sometimes', 'image', 'max:2000'],
            'favicon' => ['sometimes', 'image', 'max:2000'],
            'theme' => ['sometimes', 'integer', 'between:0,1'],
            'stripe' => ['sometimes', 'required', 'integer', 'between:0,1', new ValidateExtendedLicenseRule()],
            'stripe_key' => ['sometimes', 'required_if:stripe,1'],
            'stripe_secret' => ['sometimes', 'required_if:stripe,1'],
            'stripe_wh_secret' => ['sometimes', 'required_if:stripe,1'],
            'paypal' => ['sometimes', 'required', 'integer', 'between:0,1', new ValidateExtendedLicenseRule()],
            'paypal_mode' => ['sometimes', 'required_if:paypal,1'],
            'paypal_client_id' => ['sometimes', 'required_if:paypal,1'],
            'paypal_secret' => ['sometimes', 'required_if:paypal,1'],
            'paypal_webhook_id' => ['sometimes', 'required_if:paypal,1'],
            'coinbase' => ['sometimes', 'required', 'integer', 'between:0,1', new ValidateExtendedLicenseRule()],
            'coinbase_key' => ['sometimes', 'required_if:coinbase,1'],
            'coinbase_wh_secret' => ['sometimes', 'required_if:coinbase,1'],
            'bank' => ['sometimes', 'required', 'integer', 'between:0,1', new ValidateExtendedLicenseRule()],
            'storage_driver' => ['sometimes', 'in:public,s3'],
            'storage_key' => ['sometimes', 'required_if:storage_driver,s3'],
            'storage_secret' => ['sometimes', 'required_if:storage_driver,s3'],
            'storage_region' => ['sometimes', 'required_if:storage_driver,s3'],
            'storage_bucket' => ['sometimes', 'required_if:storage_driver,s3'],
            'storage_endpoint' => ['sometimes', 'required_if:storage_driver,s3'],
            'social_discord' => ['sometimes', 'nullable', 'url'],
            'social_facebook' => ['sometimes', 'nullable', 'url'],
            'social_github' => ['sometimes', 'nullable', 'url'],
            'social_instagram' => ['sometimes', 'nullable', 'url'],
            'social_linkedin' => ['sometimes', 'nullable', 'url'],
            'social_pinterest' => ['sometimes', 'nullable', 'url'],
            'social_reddit' => ['sometimes', 'nullable', 'url'],
            'social_threads' => ['sometimes', 'nullable', 'url'],
            'social_tiktok' => ['sometimes', 'nullable', 'url'],
            'social_tumblr' => ['sometimes', 'nullable', 'url'],
            'social_x' => ['sometimes', 'nullable', 'url'],
            'social_youtube' => ['sometimes', 'nullable', 'url'],
            'webhook_user_store_url' => ['sometimes', 'nullable', 'url'],
            'webhook_user_destroy_url' => ['sometimes', 'nullable', 'url'],
            'demo_url' => ['sometimes', 'nullable', 'url'],
            'cdn_url' => ['sometimes', 'nullable', 'url'],
            'contact_email' => ['sometimes', 'nullable', 'email', 'required_if:contact_form,1'],
        ];
    }
}
