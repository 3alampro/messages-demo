<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\newMessage;
use App\Http\Requests;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $data['chats'] = Message::all();

        return view('index', $data);
    }

    public function store(MessageRequest $request)
    {
        $message = Message::create($request->all());

        event(new newMessage($message));

        return response('', 200);
    }
}
