<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    $users = \App\Models\User::all();
    return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
$data = $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required|min:6',
        'role' => 'required'
    ]);

    $data['password'] = bcrypt($request->password); 
    \App\Models\User::create($data);

    return back()->with('success', 'User berhasil ditambahkan');
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
    public function edit(string $id)
    {
        //
if ($id == auth()->id()) {
        return back()->with('error', 'cannot edit owner auth login.');
    }
    
    $user = \App\Models\User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
$user = \App\Models\User::findOrFail($id);
    
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email,'.$id,
        'role' => 'required'
    ]);


    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $user->update($data);
    return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
if ($id == auth()->id()) {
        return back()->with('error', 'cannot del ur acc');
    }
    
    \App\Models\User::destroy($id);
    return back()->with('success', 'User dihapus');
    }
}
