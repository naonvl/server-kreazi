<?php
namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request){
        $data = $request->json()->all();

        $que = [
            'id' => $data['uid'],
        ];

        $user = User::findorfail($que['id']);
        return compact('user');
    }
}
?>