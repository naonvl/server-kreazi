<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index(Request $request){
        $data = $request->json()->all();

        $subdomain = $data['subdomain'];
        foreach(User::all() as $val){
            if($val->subdomain == $subdomain){
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
        }

        return compact('que');
    }
}
?>