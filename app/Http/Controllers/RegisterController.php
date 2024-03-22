<?php
namespace App\Http\Controllers;

use Session;
use App\User;
use Carbon\Carbon;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(Request $request){
        $data = $request->json()->all();

        //add logic role

        $que = [
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->whatsapp,
            'kota' => $request->kota,
            'logoUrl' => "",
        ];

        $available = 1;
        foreach (User::all() as $val) {
            if($val->email == $que['email']){
                $available = 0;
            }
        }

        if($available == 0){
            return response()->json([
                'success' => '0',
                'message' => 'Email sudah terdaftar!'
            ]);
        }else{
            if($available == 1 && User::create($que) == true){
                // Auth::attempt($que);
                foreach (User::all() as $val) {
                    if($val->email == $que['email']){
                        $main = 'false';
                        if($val->main == 1){
                            $main = 'true';
                        }
                        foreach (AppSetting::all() as $app) {
                            $expired_trial = $app->expired_trial;
                        }

                        $today = Carbon::today()->locale('id');
                        $date_create = $val->created_at;
                        $expired = $date_create->addDays($expired_trial);
                        $expired_trial = 0;

                        $response = response()->json([
                            'success' => '200',
                            'message' => 'Berhasil Didaftarkan',
                            'data' => [
                                'expired_trial' => $expired_trial,
                                'uid' => $val->id,
                                'role' => $val->role,
                                'username' => $val->username,
                                'name' => $val->name,
                                'phone' => $val->phone,
                                'email' => $val->email,
                                'subdomain' => $val->subdomain,
                                'logoUrl' => $val->logoUrl,
                                'main' => $main,
                                'token' => Hash::make($val->email),
                                'date_create' => $val->created_at,
                                'expired' => $expired,
                                'datenow' => $today
                            ]
                        ]);
                    }
                }
                return $response;
            }else{
                return response()->json([
                    'success' => '0',
                    'message' => 'Gagal Registrasi!'
                ]);
            }
        }
    }

    public function login_page()
    {
        if(Auth::check()){
            return redirect('home');
        }else{
            return view('login');
        }
    }

    public function login_admin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|alpha_dash',
            'password' => 'required|min:6',
        ]);

        $que = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if(Auth::attempt($que) == true){
            return redirect('/home');
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
?>
