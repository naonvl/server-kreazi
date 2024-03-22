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
			'tenant' => $request->uid,
		];

		$product = Product::where('tenant', $que['tenant'])->get();
		$response = response()->json([
			'product' => $product,
		]);
		return $response;
	}

	public function get_tipe(){
		$response = response()->json([
			'tipe' => Tipe::all(),
		]);
		return $response;
	}

	public function add_tipe(Request $request){
		$ada = 0;

		foreach(Tipe::all() as $key){
			if($key->name == $request->name){
				$ada = 1;
			}
		}

		if($ada == 0){
			Tipe::create([
				'name' => $request->name,
				'status' => $request->status,
			]);

			$success = 0;
			foreach(Tipe::all() as $val){
				if($val->name == $request->name && $val->status == $request->status){
					$success = 1;
				}
			}

			if($success == 1){
				$response = response()->json([
					'success' => '200',
					'message' => 'Tipe Berhasil Ditambahkan.',
					200
				]);
			}elseif($success == 0){
				$response = response()->json([
					'success' => '500',
					'message' => 'Tipe Gagal Ditambahkan.',
					500
				]);
			}else{
				$response = response()->json([
					'success' => '404',
					'message' => 'ERROR!.',
					404
				]);
			}
		}else{
			$response = response()->json([
				'success' => '0',
				'message' => 'Tipe sudah ada.',
			]);
		}
		return $response;
	}

	public function get_dropship(){
		$product = Product::where('is_dropship', 1)->get();
		$response = response()->json([
			'product' => $product,
		]);
		return $response;
	}

	public function add_dropship(Request $request){
		Product::create([
			'is_dropship' => 1,
			'name' => $request->nama,
			'tipe' => $request->tipe,
			'qty' => $request->qty,
			'ukuran' => $request->ukuran,
			'harga_beli' => $request->harga_beli,
			'discount_beli' => $request->discount_beli,
			'id_template' => $request->id_template,
			'status' => $request->status,
		]);

		if(Product::where('is_dropship', 1)->where('name', $request->nama)->get()){
			$response = response()->json([
				'success' => '200',
				'message' => 'Produk Dropship Berhasil ditambahkan.',
				200
			]);
		}else{
			$response = response()->json([
				'success' => '500',
				'message' => 'Produk Dropship Gagal ditambahkan.',
				500
			]);
		}
		return $response;
	}

	public function update_dropship(Request $request){
		$data = $request->json()->all();

		$que = [
			'name' => $request->nama,
			'tipe' => $request->tipe,
			'qty' => $request->qty,
			'ukuran' => $request->ukuran,
			'harga_beli' => $request->harga_beli,
			'discount_beli' => $request->discount_beli,
			'id_template' => $request->id_template,
			'status' => $request->status,
		];

		$product_id = $data['product_id'];
		$product = Product::findorfail($product_id);
        if($product->update($que)){

			$dropship_id = $data['product_id'];
			$product = Product::findorfail($dropship_id);
			if($product->update($que)){
				return response()->json([
					'success' => '200',
					'message' => 'Data Dropship Berhasil di Update',
					200
				]);
			}else{
				return response()->json([
					'success' => '500',
					'message' => 'Update data gagal!',
					500
				]);
			}
        }else{
            return response()->json([
                'success' => '500',
                'message' => 'Update data gagal!',
				500
            ]);
        }
	}

	public function get_template(){
		$response = response()->json([
			'template' => Template::all(),
		]);
		return $response;
	}

	public function add_template(Request $request){

		if (!$request->has('thumbnail')) {
            return response()->json(['message' => 'Missing file'], 422);
        }else{
			$nama = str_replace(' ', '-', $request->nama); 

			$file = $request->file('thumbnail');
			$nama_file = $nama."_".time().".".$file->extension();
			$file->move(public_path('uploads/template/'), $nama_file);
		}

		if(Template::create([
			'name' => $request->nama,
			'tipe' => $request->tipe,
			'template' => $request->template,
			'thumbnail' => url("uploads/template/".$nama_file),
			'user' => $request->user,
			'status' => $request->status,
		])){
			$response = response()->json([
				'success' => '200',
				'message' => 'Template Berhasil ditambahkan.',
				200
			]);
		}else{
			$response = response()->json([
				'success' => '500',
				'message' => 'Template Gagal ditambahkan.',
				500
			]);
		}
		return $response;
	}

	public function update_template(Request $request){
		$data = $request->json()->all();

		if (!$request->has('thumbnail')) {
            return response()->json(['message' => 'Missing file'], 422);
        }else{
			$nama = str_replace(' ', '-', $request->nama); 

			$file = $request->file('thumbnail');
			$nama_file = $nama."_".time().".".$file->extension();
			$file->move(public_path('uploads/template/'), $nama_file);
		}
		
		$que = [
			'name' => $request->nama,
			'tipe' => $request->tipe,
			'template' => $request->template,
			'thumbnail' => url("uploads/template/".$nama_file),
			'user' => $request->user,
			'status' => $request->status,
		];

		$template_id = $data['template_id'];
		$template = Template::findorfail($template_id);
        if($template->update($que)){
            return response()->json([
                'success' => '200',
                'message' => 'Data Dropship Berhasil di Update'
            ]);
        }else{
            return response()->json([
                'success' => '500',
                'message' => 'Update data gagal!',
				500
            ]);
        }
	}

	public function produk(Request $request){
		$data = $request->json()->all();

		$response = response()->json([
			'product' => Product::all(),//($data['uid']),
		]);

		return $response;
	}

	public function produkMitra(Request $request){
		$response = response()->json([
			'product' => Product::where('mitra', $request->uid)->get(),
		]);
		return $response;
	}

	public function add_produk_mitra(Request $request){
		$id_dropship = $request->productDropship_id;

		foreach(Product::where('product_id', $id_dropship)->get() as $val){
			$name = $val->name;
			$tipe = $val->tipe;
			$ukuran = $val->ukuran;
			$id_template = $val->id_template;
		}

		if(Product::create([
			'mitra' => $request->uid,
			'description' => $request->description,
			'qty' => $request->qty,
			'name' => $name,
			'tipe' => $tipe,
			'ukuran' => $ukuran,
			'harga_jual' => $request->harga_jual,
			'discount_jual' => $request->discount_jual,
			'id_template' => $id_template,
			'status' => $request->status,
		])){
			$response = response()->json([
				'success' => '200',
				'message' => 'Produk Mitra Berhasil ditambahkan.',
				200
			]);
		}else{
			$response = response()->json([
				'success' => '500',
				'message' => 'Produk Mitra Gagal ditambahkan.',
				500
			]);
		}
		return $response;
	}

	public function edit_produk_mitra(Request $request){
		$data = $request->json()->all();

		$id_dropship = $request->productDropship_id;

		foreach(Product::where('product_id', $id_dropship)->get() as $val){
			$name = $val->name;
			$tipe = $val->tipe;
			$ukuran = $val->ukuran;
			$id_template = $val->id_template;
		}

		$que = [
			'description' => $request->description,
			'dropship_id' => $id_dropship,
			'qty' => $request->qty,
			'name' => $name,
			'tipe' => $tipe,
			'ukuran' => $ukuran,
			'harga_jual' => $request->harga_jual,
			'discount_jual' => $request->discount_jual,
			'id_template' => $id_template,
			'status' => $request->status,
		];

		$product_id = $data['product_id'];
		$product = Product::findorfail($product_id);
        if($product->update($que)){
            return response()->json([
                'success' => '200',
                'message' => 'Data Dropship Berhasil di Update'
            ]);
        }else{
            return response()->json([
                'success' => '500',
                'message' => 'Update data gagal!',
				500
            ]);
        }
	}

	public function add_produk_custom(Request $request){

	}

	public function update_produk_custom(Request $request){

	}

	//wajib ada template & produk
	// public function add_produk(Request $request){
	// 	// $data = $request->json()->all();

	// 	// $this->validate($request, [
	// 	// 	'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
	// 	// 	'name' => 'required',
	// 	// 	'tipe' => 'required|numeric',
	// 	// 	'price' => 'required|numeric',
	// 	// 	'discount' => 'required|numeric',
	// 	// 	'description' => 'required',
	// 	// 	'qty' => 'required|numeric',
	// 	// 	'status' => 'required|numeric',
	// 	// 	'tenant' => 'required|numeric',
	// 	// ]);

	// 	$file = $request->file('thumbnail');
	// 	$nama_file = time().".".$request->file->extension();
	// 	$request->file->move(public_path('uploads/product/'), $nama_file);
	// 	// $file->move('uploads/akun/', $new_logo);
		
	// 	Product::create([
	// 		'name' => $request->name,
	// 		'tipe' => $request->tipe,
	// 		'price' => $request->price,
	// 		'discount' => $request->discount,
	// 		'description' => $request->description,
	// 		'qty' => $request->qty,
	// 		'status' => $request->status,
	// 		'tenant' => $request->uid,
	// 		'customer' => '0',
	// 		'thumbnail' => url("uploads/product/".$nama_file),
	// 		'template' => $request->template
	// 	]);
	
	// 	$success = 0;
	// 	foreach (Product::all() as $val) {
	// 		if($val->name == $request->name && $val->tenant == $request->uid && $val->tipe == $request->tipe){
	// 			$success = 1;
	// 		}
	// 	}
	
	// 	if($success == 1){
	// 		$response = response()->json([
	// 			'Success' => '200',
	// 			'Message' => 'Produk Berhasil ditambahkan.',
	// 		]);
	// 	}elseif($success == 0){
	// 		$response = response()->json([
	// 			'Success' => '500',
	// 			'Message' => 'Produk Gagal ditambahkan.',
	// 		]);
	// 	}else{
	// 		$response = response()->json([
	// 			'Success' => '404',
	// 			'Message' => 'ERROR',
	// 		]);
	// 	}
	// 	return $response;
	// }

	// public function update_produk(Request $request){
	// 	$data = $request->json()->all();

	// 	$file = $request->file('thumbnail');
	// 	$nama_file = time()."_".$file->getClientOriginalName();
	// 	$file->move('uploads/akun/', $new_logo);
		
	// 	$que = [
	// 		'name' => $request->name,
	// 		'tipe' => $request->tipe,
	// 		'price' => $request->price,
	// 		'discount' => $request->discount,
	// 		'description' => $request->description,
	// 		'qty' => $request->qty,
	// 		'status' => $request->status,
	// 		'tenant' => $request->uid,
	// 		'customer' => '0',
	// 		'thumbnail' => url("uploads/product/".$nama_file),
	// 		'template' => $request->template
	// 	];

	// 	$product_id = $data['product_id'];
	// 	$product = Product::findorfail($product_id);
    //     if($product->update($que)){
    //         return response()->json([
    //             'Success' => '200',
    //             'Message' => 'Data Produk Berhasil di Update'
    //         ]);
    //     }else{
    //         return response()->json([
    //             'Success' => '500',
    //             'Message' => 'Update data gagal!'
    //         ]);
    //     }
	// }

	// //bisa tanpa produk, tapi template wajib
	// public function custom_produk(Request $request){
	// 	$data = $request->json()->all();

	// 	// $this->validate($request, [
	// 	// 	'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
	// 	// 	'name' => 'required',
	// 	// 	'tipe' => 'required|numeric',
	// 	// 	'price' => 'required|numeric',
	// 	// 	'discount' => 'required|numeric',
	// 	// 	'description' => 'required',
	// 	// 	'qty' => 'required|numeric',
	// 	// 	'status' => 'required|numeric',
	// 	// 	'tenant' => 'required|numeric',
	// 	// 	'customer' => 'required|numeric',
	// 	// ]);

	// 	$file = $request->file('thumbnail');
	// 	$nama_file = time()."_".$file->getClientOriginalName();
	// 	$file->move('uploads/akun/', $new_logo);
		
	// 	Product::create([
	// 		'name' => $request->name,
	// 		'tipe' => $request->tipe,
	// 		'price' => $request->price,
	// 		'discount' => $request->discount,
	// 		'description' => $request->description,
	// 		'qty' => $request->qty,
	// 		'status' => $request->status,
	// 		'tenant' => $request->uid,
	// 		'customer' => $request->customer,
	// 		'thumbnail' => url("uploads/product/".$nama_file),
	// 		'template' => $request->template
	// 	]);
	
	// 	$success = 0;
	// 	foreach (Product::all() as $val) {
	// 		if($val->name == $data['name'] && $val->user == $data['uid'] && $val->tipe == $data['tipe']){
	// 			$success = 1;
	// 		}
	// 	}
	
	// 	if($success == 1){
	// 		$response = response()->json([
	// 			'Success' => '200',
	// 			'Message' => 'Produk Berhasil ditambahkan.',
	// 		]);
	// 	}elseif($success == 0){
	// 		$response = response()->json([
	// 			'Success' => '500',
	// 			'Message' => 'Produk Gagal ditambahkan.',
	// 		]);
	// 	}else{
	// 		$response = response()->json([
	// 			'Success' => '404',
	// 			'Message' => 'ERROR',
	// 		]);
	// 	}
	// 	return $response;
	// }
}
?>