<?php

namespace App\Http\Middleware;

use App\Models\Subscriber;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoggedInMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subscriber = Subscriber::where('username',$request->username)->first();
        if (isset($subscriber) && Hash::check($request->password, $subscriber->password) && $subscriber->status == 'logged_in') {
            return response()->json([
                'message' =>'you can not log in twice.'
            ],403);
        }
        
        else
        return $next($request);

    }
}
