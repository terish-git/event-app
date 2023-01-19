<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CommonController extends Controller
{

    /** Check user email id is unique. */
    public function checkUniqueEmail (Request $request)
    {
        $count = User::where('email', $request->email)->count();
        echo ($count > 0 ? 'false' : 'true');
    }
}
