<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\conversation;
use App\privateMessage;

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

    // Get the lis of user follows
    public function follows($username) {
        $user = $this->findByUserName($username);

        return view('users.follows', [
            'user' => $user,
            'follows' => $user->follows,
            'action' => 'follows'
        ]);
    }

    // get the lis of user followers
    public function followers($username) {
        $user = $this->findByUserName($username);

        return view('users.follows', [
            'user' => $user,
            'follows' => $user->followers,
            'action' => 'followers'
        ]);
    }

    // follow a user
    public function follow($username, Request $request) {
        $user = $this->findByUserName($username);

        $me = $request->user();

        $me->follows()->attach($user);

        return redirect("/@$username")->withSuccess('User followed');
    }

    // unfollow a user
    public function unfollow($username, Request $request) {
        $user = $this->findByUserName($username);

        $me = $request->user();

        $me->follows()->detach($user);

        return redirect("/@$username")->withSuccess('User unfollowed');
    }

    // get the user by username
    private function findByUserName($username) {
        return $user = User::where('username', $username)->firstOrFail();
    }

    public function sendPrivateMessage($username, Request $request)
    {
        $user = $this->findByUsername($username);

        $me = $request->user();
        $message = $request->input('message');

        $conversation = Conversation::between($me, $user);

        $privateMessage = PrivateMessage::create([
            'conversation_id' => $conversation->id,
            'user_id' => $me->id,
            'message' => $message,
        ]);

        return redirect('/conversations/'.$conversation->id);
    }

    public function showConversation(Conversation $conversation)
    {
        $conversation->load('users', 'privateMessages');
        $validator = false;
        $me=auth()->user();	
        foreach($conversation->users as $user){
            if( ($user->id)==($me->id) ){
              $validator=true;
            }
        }

        if($validator==false){
            return redirect('/');
        }

        return view('users.conversation', [
            'conversation' => $conversation,
            'user' => auth()->user(),
        ]);
    }
}
