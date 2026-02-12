<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
// lower ver func
    /*private function getModel($role)
{
    return match ($role) {
        'admin' => \App\Models\Admin::class,
        'officer' => \App\Models\Officer::class,
        'borrower' => \App\Models\Borrower::class,
        default => abort(404, "Role tidak valid"),
    };
}*/
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all comp user
    $users = User::where('role','!=' ,'admin')->get();
    return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //ret
return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
//valid 
   $data = $request->validate([
        'username' => 'required|unique:users,username', // duplikat
        'email' => 'required|email|unique:users,email', 
        'password' => 'required|min:6',
        'role' => 'required'
    ]);

//enc
    $data['password'] = Hash::make($request->password); 
    
//create data
    User::create($data);

    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // ... (index & create tetap sama)

public function edit($id, Request $request)
{

//lower ver var
    //$modelName = $this->getModel($role);
    $user = User::findOrFail($id);
    
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
//var 
    $role = $request->role; 
//    $modelName = $this->getModel($role);
    $user = User::findOrFail($id);
     if ($user->role === 'admin' && $request->role !== 'admin') {
        return back()->with('error', 'Role Admin tidak boleh diubah menjadi role lain!');
    }

    $data = $request->validate([
        'username' => 'required|unique:users,username,' . $id,
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required'
    ]);

    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $user->update($data);
    return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
}

public function destroy(Request $request, $id)
    {
    $role = $request->query('role'); 
//    $modelName = $this->getModel($role);
    $user = User::findOrFail($id);

    // simp protect fail
    if ($user->id === auth()->id()) {
    return back()->with('error', 'Tidak bisa menghapus akun sendiri');
}

    User::destroy($id);
    return back()->with('success', 'User berhasil dihapus');
    }
}
