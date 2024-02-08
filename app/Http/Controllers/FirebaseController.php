<?php

// namespace App\Services;
namespace App\Http\Controllers;

use UnexpectedValueException;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\FirebaseToken;

// use Config\Services;

class FirebaseController extends Controller
{
    public function auth(Request $request){
        // Retrieve Authorization header
        $token = $request->bearerToken();

        $payload = (new FirebaseToken($token))->verify(
            'glogin-auth'
        );

        $payload->user_id;
    }
}