<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;

class MessagesController extends Controller
{
    public function show(Message $message) {

        return view('messages.show', [
            'message'=> $message
        ]);
    }

    public function create(Request $request) {
        dd($request->all() );
        return 'Created!';
    }
}
