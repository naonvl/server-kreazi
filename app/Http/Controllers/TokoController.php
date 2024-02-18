<?php
namespace App\Http\Controllers;

use App\User;
use App\Models\Product;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokoController extends Controller
{
	public function index(Request $request){
		$data = $request->json()->all();

		$que = [
			'id' => $data['uid'],
		];

		$product = Product::findorfail($que['id']);
		$response = response()->json([
			'product' => $product,
		]);
		return $response;
	}

	public function buka_toko(Request $request){
		$data = $request->json()->all();

	}

	public function produk(Request $request){
		$data = $request->json()->all();

		$response = response()->json([
			'product' => Product::find($data['uid']),
		]);

		return $response;
	}

	public function add_produk(Request $request){
		$data = $request->json()->all();

		$this->validate($request, [
			'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
			'name' => 'required',
			'tipe' => 'required|numeric',
			'price' => 'required|numeric',
			'discount' => 'required|numeric',
			'description' => 'required',
			'qty' => 'required|numeric',
			'status' => 'required|numeric',
			'tenant' => 'required|numeric',
		]);

		$file = $request->file('gambar');
		$nama_file = time().".".$request->file->extension();
		$request->file->move(public_path('uploads/product/'), $nama_file);
		// $file->move('uploads/akun/', $new_logo);
		
		Product::create([
			'name' => $request->name,
			'tipe' => $request->tipe,
			'price' => $request->price,
			'discount' => $request->discount,
			'description' => $request->description,
			'qty' => $request->qty,
			'status' => $request->status,
			'tenant' => $request->uid,
			'gambarUrl' => url("uploads/product/".$nama_file),
		]);
	
		$success = 0;
		foreach (Product::all() as $val) {
			if($val->name == $data['name'] && $val->user == $data['uid'] && $val->tipe == $data['tipe']){
				$success = 1;
			}
		}
	
		if($success == 1){
			$response = response()->json([
				'Success' => '200',
				'Message' => 'Produk Berhasil ditambahkan.',
			]);
		}elseif($success == 0){
			$response = response()->json([
				'Success' => '500',
				'Message' => 'Produk Gagal ditambahkan.',
			]);
		}else{
			$response = response()->json([
				'Success' => '404',
				'Message' => 'ERROR',
			]);
		}
		return $response;
	}

	public function update_produk(Request $request){
		$data = $request->json()->all();

		$que = [
			'name' => $data['name'],
			'tipe' => $data['tipe'],
			'price' => $data['price'],
			'discount' => $data['discount'],
			'description' => $data['description'],
			'qty' => $data['qty'],
			'status' => $data['status'],
		];

		$product_id = $data['product_id'];
		$product = Product::findorfail($product_id);
        if($product->update($que)){
            return response()->json([
                'Success' => '200',
                'Message' => 'Data Produk Berhasil di Update'
            ]);
        }else{
            return response()->json([
                'Success' => '500',
                'Message' => 'Update data gagal!'
            ]);
        }
	}

	public function custom_produk(Request $request){
		$data = $request->json()->all();

		$this->validate($request, [
			'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
			'name' => 'required',
			'tipe' => 'required|numeric',
			'price' => 'required|numeric',
			'discount' => 'required|numeric',
			'description' => 'required',
			'qty' => 'required|numeric',
			'status' => 'required|numeric',
			'tenant' => 'required|numeric',
			'customer' => 'required|numeric',
		]);

		$file = $request->file('gambar');
		$nama_file = time()."_".$file->getClientOriginalName();
		$file->move('uploads/akun/', $new_logo);
		
		Product::create([
			'name' => $data['name'],
			'tipe' => $data['tipe'],
			'price' => $data['price'],
			'discount' => $data['discount'],
			'description' => $data['description'],
			'qty' => $data['qty'],
			'status' => $data['status'],
			'tenant' => $data['uid'],
			'customer' => $data['cust'],
			'gambarUrl' => url("uploads/product/".$nama_file),
		]);
	
		$success = 0;
		foreach (Product::all() as $val) {
			if($val->name == $data['name'] && $val->user == $data['uid'] && $val->tipe == $data['tipe']){
				$success = 1;
			}
		}
	
		if($success == 1){
			$response = response()->json([
				'Success' => '200',
				'Message' => 'Produk Berhasil ditambahkan.',
			]);
		}elseif($success == 0){
			$response = response()->json([
				'Success' => '500',
				'Message' => 'Produk Gagal ditambahkan.',
			]);
		}else{
			$response = response()->json([
				'Success' => '404',
				'Message' => 'ERROR',
			]);
		}
		return $response;
	}
}
?>