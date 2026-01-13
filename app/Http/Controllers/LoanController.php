<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tool;
use App\Models\loan;
//use ilum.supp.fas.db n auth
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
//use carb/carb
use Carbon\Carbon;

class LoanController extends Controller
{
    //
    public function adminIndex() {
    // Tambahkan 'admin' ke dalam array with()
    $loans = loan::with(['user', 'tool', 'admin'])->latest()->get();
    return view('admin.loans.index', compact('loans'));
}

    public function petugasIndex(){
//    $ tools = tool:wher(stok,>,0)>get()
    $tools = tool::where('stock', '>' ,0)->get();
//    $ loan  = loan:wher(us_id, auth::id())>with('tool')>last()>get()
$loans = \App\Models\loan::with(['user', 'tool'])->latest()->get();
// ret view (pem.ind, comp var)
    return view('petugas.index', compact('tools', 'loans'));
    }

    public function peminjamIndex(){
//    $ tools = tool:wher(stok,>,0)>get()
    $tools = tool::where('stock', '>' ,0)->get();
//    $ loan  = loan:wher(us_id, auth::id())>with('tool')>last()>get()
    $myloan = loan::where('user_id', Auth::id())->with('tool')->latest()->get();
// ret view (pem.ind, comp var)
    return view('peminjam.index', compact('tools', 'myloan'));
    }

public function create() {
    // cek role whres user
    $users = \App\Models\User::where('role', 'peminjam')->get();
    
    // get tool whers stock
    $tools = tool::where('stock', '>', 0)->get();
    
    return view('admin.loans.create', compact('users', 'tools'));
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
//if thres no usr_id, get aut id
'user_id' => $request->user_id ?? Auth::id(),
'tool_id'=> $tool->id,
'date_loan'=>now()
]);

//com all data
DB::commit();
return back()->with('success', 'Berhasil meminjam alat!');
        } catch (\Exception $e){
//db rb
DB::rollback    ();
return back()->with('error',$e->getMessage());
        }
    }

public function approve($id){
//    loan = loan:finfil(id)
$loan = loan::findOrFail($id);
//loan > upd =([ status boro, admin id => auth() id()])
$loan->update([
'status' => 'borro',
'admin_id' => auth()->id(),
]);
return back()->with('success', 'Alat telah diserahkan ke peminjam.');
    }

public function returnTool($id) {
    DB::beginTransaction();
    try {
        $loan = loan::findOrFail($id);
        
       
        $tool = tool::findOrFail($loan->tool_id); 

        $loandate = Carbon::parse($loan->date_loan);
        $returndate = now();
        $selisih = $loandate->diffInDays($returndate);

        $denda = 0;
        if($selisih > 3) {
            $denda = ($selisih - 3) * 5000;
        }

        $loan->update([
            'return_date' => $returndate,
            'status' => 'return',
            'penalty' => $denda, 
            'admin_id' => auth()->id(),
        ]);

        $tool->increment('stock');

        DB::commit();
        return back()->with('success', 'Berhasil return alat!');
        
    } catch (\Exception $e) { 
        DB::rollback(); 
        return back()->with('error', $e->getMessage());
        }
    }

public function report(Request $request) {
    $query = loan::with(['user', 'tool']);

    //  filter simpel jika ada req
    if ($request->status) {
        $query->where('status', $request->status);
    }

    $reports = $query->latest()->get();
    return view('petugas.report', compact('reports'));
    }

public function edit($id) {
    $loan = loan::findOrFail($id);
    $users = \App\Models\User::all();
    $tools = tool::all();
    return view('admin.loans.edit', compact('loan', 'users', 'tools'));
}

public function update(Request $request, $id)
{
    $loan = loan::findOrFail($id);

    if ($request->has('action') && $request->action == 'return') {
        return $this->returnTool($id); // Kita panggil saja fungsi returnTool yang sudah kamu buat
    }

    $loan->update($request->all());
    return redirect()->route('admin.loans.index')->with('success', 'Data peminjaman diperbarui.');
    }
public function destroy($id)
{
    $loan = \App\Models\loan::findOrFail($id);


    $loan = \App\Models\loan::findOrFail($id);
    
    // condition - stock, stock++
    if ($loan->status != 'return') {
        \App\Models\tool::where('id', $loan->tool_id)->increment('stock');
    }

    $loan->delete();
    return back()->with('success', 'Data transaksi dihapus & stok disesuaikan.');
    }
}

