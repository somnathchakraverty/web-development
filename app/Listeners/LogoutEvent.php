<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogoutEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        if(auth()->check()){
            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            $userProfileInfoDetail = null;
            if(session()->has('auth_'.$token_id)){
                session()->forget('auth_'.$token_id);
            }
        }
    }
}
