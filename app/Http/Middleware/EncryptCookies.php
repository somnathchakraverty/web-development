<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'sLocation',
        'sLocationID',
        'selectTestId',
        'selectProfileId',
        'selectLinkrewrite',
        'isNewBooking',
        'selectedObj',
        'cust_mobile',
        'booking_id',
        'service_mobile',
        'service_booking_id',
        'subscription_id',
        'subscription_mobile',
        'landing_redirect',
        'guid'
    ];
}
