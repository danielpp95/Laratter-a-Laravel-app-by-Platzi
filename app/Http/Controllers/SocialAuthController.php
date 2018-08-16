<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;

use App\User;
use App\SocialProfile;

class SocialAuthController extends Controller
{
    public function facebook()
    {
    	return Socialite::driver('facebook')->redirect();
    }


    public function callback(Request $request) {
        $user = Socialite::driver('facebook')->user();

        $data = $request->session()->flash('facebookUser', $user);
        //  dd($user);
        return view('users.facebook', [
            'user' => $user
        ]);
    }

    public function register(Request $request) {
        $data = $request->session()->get('facebookUser');
        // dd($data);
        $username = $request->input('username');

        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'avatar' => $data->avatar,
            'username' => $username,
            'password' => str_random(16),
        ]);

        $profile = SocialProfile::create([
            'social_id' => $data->id,
            'user_id' => $user->id,
        ]);

        auth()->login($user);

        return redirect('/');
    }
}
