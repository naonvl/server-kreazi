<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function index(Request $request){
		$id = 1;
		foreach(Order::all() as $val){
			$id = $val->order_id + 1;
		}

		OrderDetail::create([
			'order_id' => $id,
			'product_id' => $request->product_id,
			'mitra_id' => $request->mitra_id,
			'qty' => $request->qty,
			'price' => $request->price,
			'discount' => $request->discount,
			'total' => $request->total,
			'note' => $request->note,
			'status' => $request->status,
		]);

		Order::create([
			'order_id' => $id,
			'cust_id' => $request->uid,
			'price' => $request->price,
			'discount' => $request->discount,
			'qty' => $request->qty,
			'total' => $request->total,
			'ongkir' => $request->ongkir,
			'status' => $request->status,
		]);

		$success = 0;
		foreach(Order::all() as $val){
			if($val->order_id == $id){
				foreach(OrderDetail::all() as $key){
					if($key->order_id == $id){
						$success = 1;
					}
				}
			}
		}

		if($success == 1){
			$response = response()->json([
				'Success' => '200',
				'Message' => 'Order Berhasil dibuat.',
				200
			]);
		}elseif($success == 0){
			$response = response()->json([
				'Success' => '500',
				'Message' => 'Order Gagal dibuat!',
				500
			]);
		}else{
			$response = response()->json([
				'Success' => '404',
				'Message' => 'Error!',
				404
			]);
		}
		return $response;
	}

	public function add_cart(Request $request){
		
		$order_id = 0;
		foreach(Order::all() as $key){
			if($key->cust_id == $request->uid && $key->status == 'Cart'){
				$order_id = $key->order_id;
				$qty = $key->qty;
				$price = $key->price;
				$discount = $key->discount;
				$total = $key->total;
			}
		}

		if($order_id != 0){
			if(OrderDetail::create([
				'order_id' => $order_id,
				'product_id' => $request->product_id,
				'mitra_id' => $request->mitra_id,
				'qty' => $request->qty,
				'price' => $request->price,
				'discount' => $request->discount,
				'total' => $request->total,
				'note' => $request->note,
				'status' => $request->status,
			])){
				$qty = $qty + $request->qty;
				$price = $price + $request->price;
				$discount = $discount + $request->discount;
				$total = $total + ($request->price - $request->discount);

				$que = [
					'qty' => $qty,
					'price' => $price,
					'discount' => $discount,
					'total' => $total,
				];

				$order = Order::findorfail($order_id);
				if($order->update($que)){
					return response()->json([
						'Success' => '200',
						'Message' => 'Cart berhasil di tambahkan',
						200
					]);
				}else{
					return response()->json([
						'Success' => '500',
						'Message' => 'Data Order gagal diperbarui',
						500
					]);
				}
			}else{
				return response()->json([
					'Success' => '500',
					'Message' => 'Cart gagal ditambahkan',
					500
				]);
			}

		}else{
			$response = response()->json([
				'Success' => '500',
				'Message' => 'Cart Order tidak ditemukan!',
				500
			]);
		}
		return $response;
	}

	public function get_order(Request $request){
		$id_order = 0;
		foreach(Order::where('cust_id', $request->cust_id)->get() as $val){
			$id_order = $val->order_id;
		}

		if($id_order != 0){
			return response()->json([
				'order' => Order::where('cust_id', $request->cust_id)->get(),
				'order_detail' => OrderDetail::where('order_id', $id_order)->get()
			]);
		}else{
			return response()->json([
				'Success' => '500',
				'Message' => 'Order tidak ditemukan!',
				500
			]);
		}
		
	}

	public function delete_cart(Request $request){
		$orderDetail_id = $request->detail_id;

		if(OrderDetail::where('detail_id', $orderDetail_id)->get()){
			foreach(OrderDetail::where('detail_id', $orderDetail_id)->get() as $val){
				$qty = $val->qty;
				$price_old = $val->price;
				$discount = $val->discount;
				$order_id = $val->order_id;
			}

			foreach(Order::where('order_id', $order_id)->get() as $key){
				$qty_order = $key->qty;
				$price_order = $key->price;
				$discount_order = $key->discount;
				$total = $key->total;
			}

			$qty = $qty_order - $qty;
			$price = $price_order - $price_old;
			$discount = $discount_order - $discount;
			$total = $total - $price_old;

			$que = [
				'qty' => $qty,
				'price' => $price,
				'discount' => $discount,
				'total' => $total
			];

			$order = Order::findorfail($order_id);
			if($order->update($que)){
				$order_detail = OrderDetail::findorfail($orderDetail_id);
				if($order_detail->delete()){
					return response()->json([
						'Success' => '200',
						'Message' => 'Cart berhasil di dihapus',
						200
					]);
				}else{
					return response()->json([
						'Success' => '500',
						'Message' => 'Cart gagal di dihapus',
						500
					]);
				}
			}else{
				return response()->json([
					'Success' => '500',
					'Message' => 'Order gagal di update dan Cart gagal di hapus',
					500
				]);
			}

		}else{
			return response()->json([
				'Success' => '500',
				'Message' => 'data cart tidak ada!',
				500
			]);
		}
	}

	public function delete_order(Request $request){
		foreach(OrderDetail::where('order_id', $request->order_id)->get() as $key){
			$order_detail = OrderDetail::find($key->detail_id);
			$order_detail->delete();
		}
		$order = Order::find($request->order_id);
		if($order->delete()){
			return response()->json([
				'Success' => '200',
				'Message' => 'Order berhasil di dihapus',
				200
			]);
		}else{
			return response()->json([
				'Success' => '500',
				'Message' => 'Order gagal di dihapus',
				500
			]);
		}
	}

	public function payment(Request $request){
		//pilih payment gateway & update status jadi On Payment
	}

	public function callback(Request $request){
		//callback api dari payment gateway & update status jadi Success
	}

	//delete order untuk yg belum bayar
	public function destroy($order_id)
	{
		$order = Order::find($order_id);
    	$order->delete();
	}
}
