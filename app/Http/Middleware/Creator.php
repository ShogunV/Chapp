<?php

namespace App\Http\Middleware;

use App\Room;
use Closure;
use Response;

class Creator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $room = Room::find($request->id);
        $user = $request->user;
        if ($user && $room && $room->creator() === $user['id']) {
            return $next($request);
        } else {
            return Response::json(['error' => 'Not creator!!!']);
        }
    }
}
