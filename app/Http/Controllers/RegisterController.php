<?php
namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(Request $request){
        $data = $request->json()->all();

        $que = [
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'username' => $data['username'],
            'phone' => $data['phone'],
        ];

        $available = 1;
        foreach (User::all() as $val) {
            if($val->email == $que['email']){
                $available = 0;
            }
        }

        if($available == 1 && User::create($que) == true){
            // Auth::attempt($que);
            foreach (User::all() as $val) {
                if($val->email == $que['email']){
                    $main = 'false';
                    if($val->main == 1){
                        $main = 'true';
                    }

                    $response = response()->json([
                        'Success' => '200',
                        'Message' => 'Berhasil Didaftarkan',
                        'uid' => $val->id,
                        'username' => $val->username,
                        'name' => $val->name,
                        'phone' => $val->phone,
                        'email' => $val->email,
                        'subdomain' => $val->subdomain,
                        'logoUrl' => $val->logoUrl,
                        'main' => $main,
                    ]);
                }
            }
            return $response;
        }else{
            return response()->json([
                'Success' => '0',
                'Message' => 'Gagal Registrasi!'
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