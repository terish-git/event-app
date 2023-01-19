<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class FunctionHelper
{
    /**
     * Create unique referral code on Method
     *
     * @return response()
     */
    public static function isValidEmail($emailID)
    {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $emailID)) ? FALSE : TRUE;
    }
}

