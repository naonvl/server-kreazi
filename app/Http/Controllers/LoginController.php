<?php
namespace App\Http\Controllers;

use Session;
use App\User;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class LoginController extends Controller
{
    public function index(Request $request){
        foreach (AppSetting::all() as $app) {
            $expired_trial = $app->expired_trial;
        }
        $today = Carbon::today()->locale('id');
        $data = $request->json()->all();

        $que = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if(Auth::attempt($que) == true){
            foreach (User::all() as $val) {
                if($val->email == $que['email']){
                    $main = 'false';
                    if($val->main == 1){
                        $main = 'true';
                    }

                    $date_create = $val->created_at;
                    $expired = $date_create->addDays($expired_trial);

                    if($val->role == 2){
                        if($expired < $today){
                            //expired
                            $message = 'Berhasil Login, Trial Expired';
                            $expired_trial = 1;
                        }else{
                            //login
                            $message = 'Berhasil Login';
                            $expired_trial = 0;
                        }
                    }else{
                        $message = 'Berhasil Login';
                        $expired_trial = 0;
                    }
                    $response = response()->json([
                        'Success' => '200',
                        'Message' => $message,
                        'data' =>[
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
                            'datenow' => $today]
                    ]);
                }
            }
            return $response;
        }else{
            return response()->json([
                'Success' => '0',
                'Message' => 'Password / Username Salah!'
            ]);
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
