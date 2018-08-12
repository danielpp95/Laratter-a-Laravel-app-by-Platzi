<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function show ($username) {
        $user = $this->findByUserName($username);
        $userMessages = $user->messages()->paginate(10);
        return view('users.show', [
            'user' => $user,
            'userMessages' => $userMessages,
        ]);
    }

    public function follows($username) {
        $user = $this->findByUserName($username);

        return view('users.follows', [
            'user' => $user,
        ]);
    }

    public function follow($username, Request $request) {
        $user = $this->findByUserName($username);

        $me = $request->user();

        $me->follows()->attach($user);

        return redirect("/$username")->withSuccess('User followed');
    }

    private function findByUserName($username) {
        return $user = User::where('username', $username)->first();
    }
}
