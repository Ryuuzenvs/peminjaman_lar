<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tool;
use App\Models\category;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan ini

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // var tool get by mod tool, with(cate)-las-get
    $tools = \App\Models\tool::with('category')->latest()->get();
//    $ cat get by model cat::all
$categories = \App\Models\category::all();
//    ret viw tool ind, compact route
    return view('admin.tools.index', compact('tools', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
$category = \App\Models\category::all();
    return view('admin.tools.create', compact('category') );
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //var req-valid array '[row tool]
$data = $request->validate([
    'name_tools' => 'required',
    'stock'=> 'required|numeric',
    'category_id' => 'required',
    ]);
//get app mod tool, create var
\App\Models\tool::create($data);
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
$category = \App\Models\category::all();
$tools = \App\Models\tool::findOrFail($id);
        return view('admin.tools.edit', compact('tools', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    $request->validate([
    'name_tools' => 'required',
    'stock'=> 'required|numeric',
    'category_id' => 'required',
    ]);
    $find = \App\Models\tool::findOrFail($id);
$updatedata = $request->all();
    $find->update($updatedata);
return back()->with('success', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    \App\Models\tool::find($id)->delete();
return back()->with('success', 'deleted');
    }
}
