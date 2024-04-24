<?php

namespace App\Observers;

use App\Enums\User\UserStatus;
use App\Models\Employee;

class UserObserver
{
    /**
     * Handle the Job "creating" event.
     *
     * @param  \App\Models\Employee  $user
     * @return void
     */
    public function creating(Employee $user)
    {
        $user->code = 'U'.uniqid_real();
        $user->slug = str()->uuid().'-'.time();
        $user->avatar = config('custom.images.avatar');
        $user->status = UserStatus::Active;
    }
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\Employee  $user
     * @return void
     */
    public function created(Employee $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\Employee  $user
     * @return void
     */
    public function updated(Employee $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\Employee  $user
     * @return void
     */
    public function deleted(Employee $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\Employee  $user
     * @return void
     */
    public function restored(Employee $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\Employee  $user
     * @return void
     */
    public function forceDeleted(Employee $user)
    {
        //
    }
}
