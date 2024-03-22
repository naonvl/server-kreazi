<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RouteController extends Controller
{
	public function index(Request $request){
		$data = $request->json()->all();
		$ada = 0;
		$user = User::where('subdomain', $request->subdomain)->get();
		foreach($user as $val){
			$main = 'false';
			if($val->main == 1){
				$main = 'true';
			}
			$ada = 1;
			$response = response()->json([
				'id' => $val->id,
				'tenant_id' => $val->subdomain,
				'main' => $main,
				'email' => $val->email,
				'name' => $val->name,
				'logoURL' => $val->logoUrl,
			]);
			return $response;
		}
		if($ada == 0){
			return $response = response()->json([
				'sessage'=> 'Not Found',
				'subdomain' => $request->subdomain,
				'request' => $request,
			]);
		}
	}
}
?>
