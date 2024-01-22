<?php

namespace App\Http\Controllers;

use App\Model\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function index()
	{
		
	}

	public function create()
	{
		return view('order.create');
	}

	public function store(Request $request)
	{

	}

	public function edit($order_id)
	{
		$order = Order::find($order_id);
		return view('order.edit', compact('order'));
	}

	public function update(Request $request, $user_id)
	{

	}

	//delete order untuk yg belum bayar
	public function destroy($order_id)
	{
		$order = Order::find($order_id);
    $order->delete();
	}
}
