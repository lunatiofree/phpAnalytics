<?php

namespace App\Observers;

use App\Models\User;
use App\Traits\WebhookTrait;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    use WebhookTrait;

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->callWebhook(config('settings.webhook_user_created'), [
            'id' => $user->id,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'name' => $user->name,
            'action' => 'created'
        ]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->callWebhook(config('settings.webhook_user_updated'), [
            'id' => $user->id,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'name' => $user->name,
            'action' => 'updated'
        ]);
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->callWebhook(config('settings.webhook_user_deleted'), [
            'id' => $user->id,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'name' => $user->name,
            'action' => 'deleted'
        ]);
    }

    /**
     * Handle the User "deleting" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        // If the user is being permanently deleted
        if ($user->isForceDeleting()) {
            // If the user previously had a subscription, attempt to cancel it
            if ($user->plan_subscription_id) {
                $user->planSubscriptionCancel();
            }

            Storage::disk(config('settings.storage_driver'))->delete('users/' . $user->id . '/' . $user->avatar);

            $user->stats()->delete();
            $user->recents()->delete();
            $user->websites()->delete();
        }
        // If the user is being suspended
        else {
            // If the user previously had a subscription, attempt to cancel it
            if ($user->plan_subscription_id) {
                $user->planSubscriptionCancel();
            }
        }
    }
}
