<?php

namespace App\Http\Controllers\Api;

use Firebase\JWT\JWT;
use DateTimeImmutable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user=[
            'username' => "waluyo",
            'password' => "test",
            'name'=>"Waluyo Ade Prasetio",
            'address'=>"Jalan Amil abas ujung no 75",
            'status'=>1
        ];
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'result'=>"FAILED",
                'message'=>"username or password not valid"
            ]);
        }
        
        if($user['username']!=$request->username || $user['password']!=$request->password) {
            return response()->json([
                'result'=>"FAILED",
                'message'=>"username or password not valid"
            ]);
        }
        $secretKey  = env('JWT_SECRET');
        $issuedAt   = new DateTimeImmutable();
        // $expire     = $issuedAt->modify('+30 minutes')->getTimestamp(); 
        $expire=time() + (1 * 60);
        $ttl=time() + (60 * 1);
        unset($user['password']);
        $data = [
            "iss" => env('APP_URL'),
            "aud" => env('APP_URL'),
            'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated                     // Issuer
            'nbf'  => $issuedAt->getTimestamp(),         // Not before
            'exp'  => $expire,                           // Expire
            'ttl'  => $ttl,                           // Expire
            'user' => $user,                     // User name
        ];
        $token=JWT::encode(
            $data,
            $secretKey,
            'HS512'
        );
        return response()->json([
            'result'=>"OK",
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expire_in'=>$expire,
            "refresh_ttl"=>$ttl
        ]);
    }

    public function profile(Request $request)
    {
        $user=$request->user;
        return response()->json([
            'result'=>"OK",
            'username'=>$user->username,
            'name'=>$user->name,
            'address'=>$user->address,
            "status"=>$user->status,
        ]);
    }
}
