<?php

namespace App\Http\Controllers;

use UnexpectedValueException;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\FirebaseToken;

use App\User;

class FirebaseController extends Controller
{
    public function auth(Request $request){
        // Retrieve Authorization header
        $token = $request->bearerToken();

        $payload = (new FirebaseToken($token))->verify(
            // config('services.firebase.project_id')
            'glogin-auth' //projectId firebase
        );
        // return $payload;
        $terdaftar = 0;
        foreach (User::all() as $val) {
            if($val->email == $payload->email){
                $terdaftar = 1;
            }
        }

        $data = $request->json()->all();
        if($terdaftar == 0){
            // $role = $request->role();
            $role = $data['role'];
            if($role == '1'){ //admin
                $main = 1;
            }elseif($role == '2'){ //tenant
                $main = 0;
            }elseif($role == '3'){ //customer
                $main = 0;
            }

            User::create([
                'name' => $payload->name,
                'role' => $role,
                'main' => $main,
                'email' => $payload->email,
                'phone' => '0',
                'username' => '',
                'password' => '',
                'subdomain' => '',
                'logoUrl' => $payload->picture,
                'status' => '1',
                'create_at' => date('Y-m-d HH:mm:s'),
            ]);

            foreach (User::all() as $val) {
                if($val->email == $payload->email){
                    $uid = $val->id;
                    $name = $val->name;
                    $main = $val->main;
                    $role_user = $val->role;
                    $logoUrl = $val->logoUrl;
                    $phone = $val->phone;
                    $email = $val->email;
                    $username = $val->username;
                    $subdomain = $val->subdomain;
                }
            }

            $response = response()->json([
                'Success' => '200',
                'Message' => 'Berhasil didaftarkan.',
                'uid' => $uid,
                'name' => $name,
                'main' => $main,
                'logoUrl' => $logoUrl,
                'phone' => $phone,
                'email' => $email,
                'username' => $username,
                'subdomain' => $subdomain,
                'payload' => $payload,
                'role_user' => $role_user,
            ]);
        }else{
            foreach (User::all() as $val) {
                if($val->email == $payload->email){
                    $uid = $val->id;
                    $name = $val->name;
                    $main = $val->main;
                    $role = $val->role;
                    $logoUrl = $val->logoUrl;
                    $phone = $val->phone;
                    $email = $val->email;
                    $username = $val->username;
                    $subdomain = $val->subdomain;
                }
            }

            $response = response()->json([
                'Success' => '200',
                'Message' => 'Akun sudah terdaftar dan berhasil login.',
                'uid' => $uid,
                'name' => $name,
                'main' => $main,
                'logoUrl' => $logoUrl,
                'phone' => $phone,
                'email' => $email,
                'username' => $username,
                'subdomain' => $subdomain,
                'role' => $role,
            ]);
        }
        return $response;
    }
}