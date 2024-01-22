<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user = User::paginate(10);
    return view('admin.akun.index', compact('user'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.akun.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'username' => 'required|alpha_dash',
      'role' => 'required',
      'email' => 'required',
      'password' => 'required|min:6',
      'phone' => 'required|min:10',
    ]);

      User::create([
        'name' => $request->name,
        'role' => $request->role,
        'email' => $request->email,
        'phone' => $request->phone,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'subdomain' => $request->subdomain,
        'status' => '1',
        // 'create_date' => date('Y-m-d HH:mm:s'),
      ]);


    return redirect()->back()->with('success', 'User Baru Berhasil Disimpan');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = User::findorfail($id);
    return view('admin.akun.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $user_id)
  {
    $this->validate($request, [
        'name' => $request->name,
        'role' => $request->role,
        'email' => $request->email,
        'phone' => $request->phone,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'subdomain' => $request->subdomain,
    ]);

    $user = User::findorfail($user_id);

    if($request->password == true){
        $user_data = [
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'subdomain' => $request->subdomain,
            'modified_date' => date('Y-m-d HH:mm:s'),
        ];
    }else{
        $user_data = [
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'subdomain' => $request->subdomain,
            'modified_date' => date('Y-m-d HH:mm:s'),
        ];
    }
    $user->update($user_data);
    return redirect()->back()->with('success', 'User Berhasil Diupdate');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($user_id)
  {
    $user = User::findorfail($user_id);
    $user->delete();

    return redirect()->back()->with('success', 'User Berhasil Dihapus');
  }

  public function profil($user_id)
  {
    $user = User::findorfail($user_id);
    return view('user.profile', compact('user'));
  }

  public function edit_profil($user_id)
  {
    $user = User::findorfail($user_id);
    return view('user.edit', compact('user'));
  }
}