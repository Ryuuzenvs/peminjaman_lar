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
//$ validt, if credentials auth attmp, regret sesio, =>
// $ role, role return
// else back

public function login(Request $request) {
    $credentials = $request->only('username', 'password');
    $role = $request->role; // 'admin', 'officer',  'borrower'

    // guard on $, att $
    //req ses genert
    if (Auth::guard($role)->attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::guard($role)->user();
		\App\Models\ActivityLog::create([
            'data' => "[AUTH] User [ id : " . $user->id . " ] dengan [ usn : ". $request->username. "] login sebagai [" . strtoupper($role) . "]"
        ]);
        
        // Redirect rel $ role
        return redirect()->intended($role . '/dashboard');
    }

    return back()->with('error', 'Login gagal, periksa email/password dan role.');
}
public function logout(Request $request) {
    Auth::guard('admin')->logout();
    Auth::guard('officer')->logout();
    Auth::guard('borrower')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

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
