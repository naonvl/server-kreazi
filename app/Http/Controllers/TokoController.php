<?php
namespace App\Http\Controllers;

use App\User;
use App\Models\Product;
use App\Models\Tipe;
use App\Models\Template;
use Illuminate\Http\Request;
// use App\Http\Requests\MultipartFormRequest;

class TokoController extends Controller
{
	public function index(Request $request){
		$data = $request->json()->all();

		$que = [
			'tenant' => $data['uid'],
		];

		$product = Product::find($que['tenant']);
		$response = response()->json([
			'product' => $product,
		]);
		return $response;
	}

	public function get_tipe(Request $request){
		// $data = $request->json()->all();

		$response = response()->json([
			'tipe' => Tipe::all(),
		]);
		return $response;
	}

	public function buka_toko(Request $request){
		$data = $request->json()->all();

	}

	public function produk(Request $request){
		$data = $request->json()->all();

		$response = response()->json([
			'product' => Product::all(),//($data['uid']),
		]);

		return $response;
	}

	//wajib ada template & produk
	public function add_produk(Request $request){
		// $data = $request->json()->all();

		// $this->validate($request, [
		// 	'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
		// 	'name' => 'required',
		// 	'tipe' => 'required|numeric',
		// 	'price' => 'required|numeric',
		// 	'discount' => 'required|numeric',
		// 	'description' => 'required',
		// 	'qty' => 'required|numeric',
		// 	'status' => 'required|numeric',
		// 	'tenant' => 'required|numeric',
		// ]);

		$file = $request->file('thumbnail');
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
			'customer' => '0',
			'thumbnail' => url("uploads/product/".$nama_file),
			'template' => $request->template
		]);
	
		$success = 0;
		foreach (Product::all() as $val) {
			if($val->name == $request->name && $val->tenant == $request->uid && $val->tipe == $request->tipe){
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

		$file = $request->file('thumbnail');
		$nama_file = time()."_".$file->getClientOriginalName();
		$file->move('uploads/akun/', $new_logo);
		
		$que = [
			'name' => $request->name,
			'tipe' => $request->tipe,
			'price' => $request->price,
			'discount' => $request->discount,
			'description' => $request->description,
			'qty' => $request->qty,
			'status' => $request->status,
			'tenant' => $request->uid,
			'customer' => '0',
			'thumbnail' => url("uploads/product/".$nama_file),
			'template' => $request->template
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

	//bisa tanpa produk, tapi template wajib
	public function custom_produk(Request $request){
		$data = $request->json()->all();

		// $this->validate($request, [
		// 	'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
		// 	'name' => 'required',
		// 	'tipe' => 'required|numeric',
		// 	'price' => 'required|numeric',
		// 	'discount' => 'required|numeric',
		// 	'description' => 'required',
		// 	'qty' => 'required|numeric',
		// 	'status' => 'required|numeric',
		// 	'tenant' => 'required|numeric',
		// 	'customer' => 'required|numeric',
		// ]);

		$file = $request->file('thumbnail');
		$nama_file = time()."_".$file->getClientOriginalName();
		$file->move('uploads/akun/', $new_logo);
		
		Product::create([
			'name' => $request->name,
			'tipe' => $request->tipe,
			'price' => $request->price,
			'discount' => $request->discount,
			'description' => $request->description,
			'qty' => $request->qty,
			'status' => $request->status,
			'tenant' => $request->uid,
			'customer' => $request->customer,
			'thumbnail' => url("uploads/product/".$nama_file),
			'template' => $request->template
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