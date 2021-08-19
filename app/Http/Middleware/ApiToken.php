<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;

class ApiToken
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
        // $token = env('APP_KEY');
        $response = Storage::disk('local')->get('data.json');
        $data = json_decode($response, true);
        $token = $data["token"];
        //dd($token);
        if ($request->api_token != $token) {
            return response()->json('Unauthorized', 401);
        } 
        return $next($request);
    }
}