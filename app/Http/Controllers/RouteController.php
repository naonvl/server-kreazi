<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index(Request $request){
        $data = $request->json()->all();

        $subdomain = $data['subdomain'];
        // $user = User::where('subdomain', $subdomain)->get();
        foreach(User::where('subdomain', $subdomain)->get() as $val){
            $main = 'false';
            if($val->main == 1){
                $main = 'true';
            }
            $que = [
                'id' => $val->id,
                'tenant_id' => $val->subdomain,
                'main' => $main,
                'email' => $val->email,
                'name' => $val->name,
                'logoURL' => $val->logoUrl,
            ];
        }
        return compact('que');
    }
}
?>