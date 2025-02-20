<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Socialite;

class SocialiteController extends Controller
{

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        dd($user);
    }
}
