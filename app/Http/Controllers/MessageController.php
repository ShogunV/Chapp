<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

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

        $message = $user->messages()->create([
            'message' => request()->get('message'),
            'room_id' => request()->get('room')
        ]);

        $room = "room.". request()->get('room');

        broadcast(new MessageCreated($message, $user, $room))->toOthers();

        return ['status' => 'OK'];
    }
}
