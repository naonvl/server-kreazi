<?php
namespace App\Http\Controllers;

use App\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class TrasanctionController extends Controller
{
	public function index(Request $request){
		$data = $request->json()->all();

		$response = response()->json([
			'Order' => Order::find($data['uid']),
		]);

		return $response;
	}

	public function withdraw(Request $request){
		$data = $request->json()->all();

	}

	public function bayar_subscribe(Request $request){
		$data = $request->json()->all();

	}

}
?>