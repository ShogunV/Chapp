<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Message;
use Illuminate\Http\Request;
use App\Events\MessageCreated;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = request()->get('room');

        $messages = Message::where('room_id', $room)->with('user')->get();

        $room = Room::find($room);

        return compact('messages', 'room');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('name', request()->user['name'])->first();

        $message = $user->message()->create([
            'message' => request()->get('message'),
            'room_id' => request()->get('room')
        ]);

        $room = "room.". request()->get('room');

        broadcast(new MessageCreated($message, $user, $room))->toOthers();

        return ['status' => 'OK'];
    }
}
