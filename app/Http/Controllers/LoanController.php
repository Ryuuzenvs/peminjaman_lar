<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tool;
use App\Models\loan;
//use ilum.supp.fas.db n auth
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    //
    public function peminjamIndex(){
//    $ tools = tool:wher(stok,>,0)>get()
    $tools = tool::where('stock', '>' ,0)->get();
//    $ loan  = loan:wher(us_id, auth::id())>with('tool')>last()>get()
    $myloan = loan::where('user_id', Auth::id())->with('tool')->latest()->get();
// ret view (pem.ind, comp var)
    return view('peminjam.index', compact('tools', 'myloan'));
    }
    
    public function store(Request $request){
//    ceking
$request->validate(['tool_id' => 'required']);

//db begin trans. try n catch
DB::beginTransaction();
    try {
//        tol = tol finfil(req>toolid)
$tool  = tool::findOrFail($request->tool_id);

//if (tool->stock < 0){ eror }
if($tool->stock < 0){
return back()->with('error', 'stock sold');
}

// tool->decr(stock )
$tool->decrement('stock');

//create loan([loan row])
loan::create([
'user_id'=>Auth()->id(),
'tool_id'=> $tool->id,
'date_loan'=>now()
]);

//com all data
DB::commit();
return back()->with('success', 'Berhasil meminjam alat!');
        } catch (\Excaption $e){
//db rb
DB::roolback();
return back()->with('error',$e->getMessage());
        }
    }
}

