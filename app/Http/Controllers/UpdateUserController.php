<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateUserController extends Controller
{
    public function index(Request $request){
        $data = $request->json()->all();

        $que = [
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ];

        $user_id = $data['uid'];
        $user = User::findorfail($user_id);
        if($user->update($que)){
            return response()->json([
                'Success' => '200',
                'Message' => 'Data User Berhasil di Update'
            ]);
        }else{
            return response()->json([
                'Success' => '0',
                'Message' => 'Update data gagal!'
            ]);
        }
    }
}
?>