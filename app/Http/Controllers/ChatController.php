<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\newMessage;
use App\Http\Requests;
use App\Http\Requests\ChatRequest;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $data['chats'] = Chat::all();

        return view('welcome', $data);
    }

    public function store(ChatRequest $request)
    {
        $message = Chat::create($request->all());

        event(new newMessage($message));

        return $message;
    }
}
