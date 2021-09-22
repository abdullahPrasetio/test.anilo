<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class JwtCheck
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
        $tokenBearer = $request->header("authorization");
        if (!$tokenBearer) {
            return response()->json([
                'result'=>"FAILED",
                'message'=>"token provided is not valid"
            ]);
        }
        $token=explode(" ",$tokenBearer)[1];
        $secretKey  = env('JWT_SECRET');
        try{
            $decoded=JWT::decode($token, $secretKey, ['HS512']);
            $request->user=$decoded->user;
        }catch(\Exception $e){
            return response()->json([
                'result'=>"FAILED",
                'message'=>"token provided is not valid"
            ]);
        }
        return $next($request);
    }
}
