<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($uid){
        $user = User::findorfail($uid);
        return compact('user');
    }
}
?>