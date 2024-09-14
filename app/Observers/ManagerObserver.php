<?php

namespace App\Observers;

use App\Models\Manager;

class ManagerObserver
{
    /**
     * Handle the Manager "created" event.
     *
     * @param  \App\Models\Manager  $manager
     * @return void
     */
    public function created(Manager $manager)
    {
    }

    /**
     * Handle the Manager "updated" event.
     *
     * @param  \App\Models\Manager  $manager
     * @return void
     */
    public function updated(Manager $manager)
    {
        
    }

    /**
     * Handle the Manager "deleted" event.
     *
     * @param  \App\Models\Manager  $manager
     * @return void
     */
    public function deleted(Manager $manager)
    {
        //
    }

    /**
     * Handle the Manager "restored" event.
     *
     * @param  \App\Models\Manager  $manager
     * @return void
     */
    public function restored(Manager $manager)
    {
        //
    }

    /**
     * Handle the Manager "force deleted" event.
     *
     * @param  \App\Models\Manager  $manager
     * @return void
     */
    public function forceDeleted(Manager $manager)
    {
        //
    }
}
