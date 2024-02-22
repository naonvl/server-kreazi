<?php

namespace App\Http\Controllers;

use UnexpectedValueException;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\FirebaseToken;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Models\AppSetting;
use Carbon\Carbon;

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
                'role_user' => $role_user,
                'payload' => $payload,
            ]);
        }else{

            foreach (AppSetting::all() as $app) {
                $expired_trial = $app->expired_trial;
            }
            $today = Carbon::today()->locale('id');

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
                    $date_create = $val->created_at;
                    $create = $val->created_at;
                }
            }

            $expired = $date_create->addDays($expired_trial);

            if($expired < $today){
                //expired
                $response = response()->json([
                    'Success' => '200',
                    'Message' => 'Akun sudah terdaftar dan berhasil login, Trial Expired.',
                    'expired_trial' => 1,
                    'uid' => $uid,
                    'name' => $name,
                    'main' => $main,
                    'logoUrl' => $logoUrl,
                    'phone' => $phone,
                    'email' => $email,
                    'username' => $username,
                    'subdomain' => $subdomain,
                    'role' => $role,
                    'payload' => $payload,
                    'date_create' => $create,
                    'expired' => $expired,
                    'datenow' => $today
                ]);
            }else{
                //login
                $response = response()->json([
                    'Success' => '200',
                    'Message' => 'Akun sudah terdaftar dan berhasil login.',
                    'expired_trial' => 0,
                    'uid' => $uid,
                    'name' => $name,
                    'main' => $main,
                    'logoUrl' => $logoUrl,
                    'phone' => $phone,
                    'email' => $email,
                    'username' => $username,
                    'subdomain' => $subdomain,
                    'role' => $role,
                    'payload' => $payload,
                    'date_create' => $create,
                    'expired' => $expired,
                ]);
            } 

            // $response = response()->json([
            //     'Success' => '200',
            //     'Message' => 'Akun sudah terdaftar dan berhasil login.',
            //     'uid' => $uid,
            //     'name' => $name,
            //     'main' => $main,
            //     'logoUrl' => $logoUrl,
            //     'phone' => $phone,
            //     'email' => $email,
            //     'username' => $username,
            //     'subdomain' => $subdomain,
            //     'role' => $role,
            //     'payload' => $payload,
            // ]);
        }
        
        return $response;
    }
}