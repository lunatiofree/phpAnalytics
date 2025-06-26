<?php

namespace App\Rules;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Validation\Rule;

class ValidateS3StorageCredentialsRule implements Rule
{
    /**
     * The error message.
     *
     * @var
     */
    private $message;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        config(['filesystems.disks.' . $value . '.key' => request()->input('storage_key')]);
        config(['filesystems.disks.' . $value . '.secret' => request()->input('storage_secret')]);
        config(['filesystems.disks.' . $value . '.region' => request()->input('storage_region')]);
        config(['filesystems.disks.' . $value . '.bucket' => request()->input('storage_bucket')]);
        config(['filesystems.disks.' . $value . '.endpoint' => (str_starts_with(request()->input('storage_endpoint'), 'https://') ? request()->input('storage_endpoint') : 'https://' .  request()->input('storage_endpoint'))]);

        try {
            Storage::disk($value)->files();
        } catch (\Exception $e) {
            $this->message = $e->getMessage();

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
