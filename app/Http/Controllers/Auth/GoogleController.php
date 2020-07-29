<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;

use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {

        $ouathUser = Socialite::driver('google')->stateless()->user();
        $finduser = User::where('google_id', $ouathUser->id)->first();

        if ($finduser) {
            Auth::login($finduser->id);
            return redirect('/home');
        } else {
            $newUser = User::create([
                'name' => $ouathUser->name,
                'email' => $ouathUser->email,
                'google_id' => $ouathUser->id,
                'password' => md5($ouathUser->token)
            ]);

            Auth::login($newUser);
            return redirect('/home');
        }
    }
}
