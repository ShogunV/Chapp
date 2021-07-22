<?php

namespace App\Http\Middleware;

use App\Models\Room;
use Closure;
use Illuminate\Http\Request;

class Creator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $room = Room::find($request->id);
        $user = $request->user;
        if ($user && $room && $room->creator_id === $user['id']) {
            return $next($request);
        } else {
            return response()->json(['error' => 'Not creator!!!']);
        }
    }
}
