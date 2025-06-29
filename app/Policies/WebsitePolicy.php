<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Website;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsitePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Website $website)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->plan->features->websites == -1) {
            return true;
        } elseif($user->plan->features->websites > 0) {
            if ($user->websitesCount < $user->plan->features->websites) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Website $website)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Website $website)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Website $website)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Website $website)
    {
        //
    }
}
