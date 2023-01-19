<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:6', 'confirmed'],
            'date_of_birth' => ['required'],
          ],
          [
            'first_name.required' => 'First name is required',
            'date_of_birth.required' => 'Date of_birth  is required',
        ]);
        
        // $input  = $request->all();
        // $user   = $this->create($input);
        // auth()->login($user);
        // return redirect("home")->withSuccess('You are signed-in');
    }

    public function create(array $data)
    {
      
      return User::create([
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'] ?? '',
          'email' => $data['email'],
          'gender' => $data['gender'],
          'date_of_birth' => date('Y-m-d', strtotime($data['date_of_birth'])),
          'password' => Hash::make($data['password']) 
      ]);
    }

}
