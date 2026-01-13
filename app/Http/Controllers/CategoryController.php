<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$ categ = get by mod::all()
        //ret viw(ad.cat.ind, ret value categories)
        $categories = \App\Models\category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
    16        $categories = App\ */
    public function store(Request $request)
    {
        //
//var req-valid array '[row tool]
$data = $request->validate([
    'nama_kategori' => 'required',
    ]);
//get app mod tool, create var
\App\Models\category::create($data);
return back()->with('success', 'created');
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
$categories = \App\Models\category::findOrFail($id);
        return view('admin.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
$request->validate(['nama_kategori' => 'required']);
$category = \App\Models\category::findOrFail($id);
$updatedata = $request->all();
 //cat->upd($upd)
$category->update($updatedata);

return back()->with('success', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $category = \App\Models\category::findOrFail($id);

    // Cek tool where in loan
    // model tool row cat_id -> loans
    $hasActiveLoans = \App\Models\tool::where('category_id', $id)
                        ->whereHas('loans')
                        ->exists();

    if ($hasActiveLoans) {
        return back()->with('error', 'Kategori tidak bisa dihapus : alat mengambil category id .');
    }

    $category->delete();
    return back()->with('success', 'Kategori berhasil dihapus');
}
}
