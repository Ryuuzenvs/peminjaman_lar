<?php

namespace App\Http\Controllers;
//use ilmuna/ http/ req, ilumna/supp/fasc/auth
use Illuminate\Support\Facades\Auth; // 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    //
public function showlogin()
    {
        //
    return view('auth.login');
    }

//req param
//$ validt, if lolos auth attmp, regret sesio, =>
// $ role, role return
// else back
public function login(Request $request)
    {
        //
        $lolos = $request->validate([
'name' => 'required',
'password' => 'required'
]);

if(Auth::attempt($lolos)){
        $request->session()->regenerate();
        
//       $ auth table name, role
        $role = Auth::user()->role;
//      ret red rout
        if($role == 'admin') return redirect()->route('admin.dashboard');
        if($role == 'petugas') return redirect()->route('petugas.dashboard');
        return redirect()->route('peminjam.dashboard');
        }
     return back()->with('error', 'wrong password or usn, try login');
    }

public function logout(){
//session()->destroy
Auth::logout();
return redirect()->route('login');

}


public function signup(){
    return view('auth.signup');
}

public function signupacc(Request $request)
    {
        //
        $lolos = $request->validate([
'name' => 'required',
'email' => 'required|email',
'password' => 'required'
]);

$data = [
'name' => $request->name,
'email' => $request->email,
'password'=>hash::make($request->password),
];

   \App\Models\User::create($data);
    return redirect()->route('login')->with('success', 'berhasil dibuat');
    }
}
