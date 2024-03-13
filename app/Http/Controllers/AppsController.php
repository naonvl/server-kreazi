<?php

namespace App\Http\Controllers;

use App\Models\ImageBanner;
use App\Models\Omnichanel;
use App\Models\PaymentMethod;
use App\Models\ProductHome;
use App\Models\Product;
use App\Models\Template;
use Illuminate\Http\Request;

class AppsController extends Controller
{
	public function index(){
		return response()->json([
			'Image_banner' => ImageBanner::all(),
			200
		]);
	}

	public function product(){
		$product_data = [];
		$product_array = array();

		foreach(ProductHome::all() as $val){
			foreach(Product::where('product_id', $val->id_product)->get() as $key){
				if($val->product_id == $key->id_product){
					foreach(Template::where('template_id', $key->id_template)->get() as $row){
						$product_data['id'] = $val->id;
						$product_data['image'] = $row->thumbnail;
						$product_data['name'] = $key->name;
						array_push($product_array, $product_data);
					}
				}
			}
		}
		return response()->json([
			// 'product_banner' => ProductHome::all(),
			'product_banner' => $product_array,
			200
		]);
	}
   
   	public function omichannel(){
		return response()->json([
			'omichannel' => Omnichanel::all(),
			200
		]);
   	}
   
	public function payment_method(){
		return response()->json([
			'payment_method' => PaymentMethod::all(),
			200
		]);
	}

	public function add_imageBanner(Request $request){
		$id = 1;
		foreach(ImageBanner::all() as $val){
			$id = $val->id_image + 1;
		}

		if (!$request->has('image')) {
            return response()->json(['message' => 'Missing file'], 422);
        }else{
			$file = $request->file('image');
			$nama_file = $id."-imageBanner_".time().".".$file->extension();
			$file->move(public_path('uploads/home/'), $nama_file);
		}

		if(ImageBanner::create([
			'url' => url("uploads/home/".$nama_file),
		])){
			$response = response()->json([
				'Success' => '200',
				'Message' => 'Image Banner Berhasil ditambahkan.',
				200
			]);
		}else{
			$response = response()->json([
				'Success' => '500',
				'Message' => 'Image Banner Gagal ditambahkan.',
				500
			]);
		}
		return $response;
	}

	public function add_product(Request $request){
		if(ProductHome::create([
			'id_product' => $request->id_product,
		])){
			$response = response()->json([
				'Success' => '200',
				'Message' => 'Product Berhasil ditambahkan ke homepage.',
				200
			]);
		}else{
			$response = response()->json([
				'Success' => '500',
				'Message' => 'Product Gagal ditambahkan.',
				500
			]);
		}
		return $response;
	}

	public function add_omichannel(Request $request){
		$id = 1;
		foreach(Omnichanel::all() as $val){
			$id = $val->id_omnichanel + 1;
		}

		if (!$request->has('image')) {
            return response()->json(['message' => 'Missing file'], 422);
        }else{
			$file = $request->file('image');
			$nama_file = $id."-omnichannel".time().".".$file->extension();
			$file->move(public_path('uploads/home/'), $nama_file);
		}

		if(Omnichanel::create([
			'logo' => url("uploads/home/".$nama_file),
		])){
			$response = response()->json([
				'Success' => '200',
				'Message' => 'Omnichanel Berhasil ditambahkan.',
				200
			]);
		}else{
			$response = response()->json([
				'Success' => '500',
				'Message' => 'Omnichanel Gagal ditambahkan.',
				500
			]);
		}
		return $response;
	}

	public function add_payment_method(Request $request){
		$id = 1;
		foreach(PaymentMethod::all() as $val){
			$id = $val->id_payment + 1;
		}

		if (!$request->has('image')) {
            return response()->json(['message' => 'Missing file'], 422);
        }else{
			$file = $request->file('image');
			$nama_file = $id."-paymentMethod".time().".".$file->extension();
			$file->move(public_path('uploads/home/'), $nama_file);
		}

		if(PaymentMethod::create([
			'logo' => url("uploads/home/".$nama_file),
		])){
			$response = response()->json([
				'Success' => '200',
				'Message' => 'Payment Method Berhasil ditambahkan.',
				200
			]);
		}else{
			$response = response()->json([
				'Success' => '500',
				'Message' => 'Payment Method Gagal ditambahkan.',
				500
			]);
		}
		return $response;
	}
	
	public function delete_imageBanner(Request $request){
		$delete = ImageBanner::find($request->id_image);
		if($delete->delete()){
			return response()->json([
				'Success' => '200',
				'Message' => 'Image Banner berhasil di dihapus',
				200
			]);
		}else{
			return response()->json([
				'Success' => '500',
				'Message' => 'Image Banner gagal di dihapus',
				500
			]);
		}
	}

	public function delete_product(Request $request){
		$delete = ProductHome::find($request->id);
		if($delete->delete()){
			return response()->json([
				'Success' => '200',
				'Message' => 'Product berhasil di dihapus dari home',
				200
			]);
		}else{
			return response()->json([
				'Success' => '500',
				'Message' => 'Product gagal di dihapus',
				500
			]);
		}
	}

	public function delete_omichannel(Request $request){
		$delete = Omnichanel::find($request->id_omnichanel);
		if($delete->delete()){
			return response()->json([
				'Success' => '200',
				'Message' => 'Omnichanel di dihapus dari home',
				200
			]);
		}else{
			return response()->json([
				'Success' => '500',
				'Message' => 'Omnichanel gagal di dihapus',
				500
			]);
		}
	}

	public function delete_payment_method(Request $request){
		$delete = PaymentMethod::find($request->id_payment);
		if($delete->delete()){
			return response()->json([
				'Success' => '200',
				'Message' => 'Payment Method di dihapus dari home',
				200
			]);
		}else{
			return response()->json([
				'Success' => '500',
				'Message' => 'Payment Method gagal di dihapus',
				500
			]);
		}
	}
}
