<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tool;
use App\Models\loan;
use App\Models\User;
use \App\Models\ActivityLog;
//use App\Models\Borrower;

//use ilum.supp.fas.db n auth
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
//use carb/carb
use Carbon\Carbon;

class LoanController extends Controller
{
    //
    public function adminIndex() {
//   data by class bor, tool, lat get
    $loans = loan::with(['borrower', 'tool', 'approver'])->latest()->get();
    return view('admin.loans.index', compact('loans'));
}

    public function petugasIndex(){
//    $ tools = tool:wher(stok,>,0)>get()
//get req item
    $tools = tool::where('stock', '>' ,0)->get();
//    $ loan  = loan:wher(us_id, auth::id())>with('tool')>last()>get()
//   data by class bor, tool, lat get
$loans = loan::with(['borrower', 'tool'])->latest()->get();
// ret view (pem.ind, comp var)
    return view('petugas.index', compact('tools', 'loans'));
    }

    public function peminjamIndex(){
//    $ tools = tool:wher(stok,>,0)>get()
//get req item
    $tools = tool::where('stock', '>' ,0)->get();
//    $ loan  = loan:wher(us_id, auth::id())>with('tool')>last()>get()
$borrowerId = Auth::guard('borrower')->id();
    $myloan = loan::where('borrower_id', $borrowerId)->with('tool')->latest()->get();
// ret view (pem.ind, comp var)
    return view('peminjam.index', compact('tools', 'myloan'));
    }

public function create() {
    // cek role whres user
    $users = User::get();
    
    // get tool whers stock
    $tools = tool::where('stock', '>', 0)->get();
    
    return view('admin.loans.create', compact('users', 'tools'));
}
	

public function store(Request $request) {
    $request->validate(['tool_id' => 'required']);

    DB::beginTransaction();
    try {
        $tool = tool::findOrFail($request->tool_id);
        if($tool->stock <= 0) return back()->with('error', 'Stok habis!');

        // logic get ID n usn
        if ($request->has('user_id')) {
            //  admin input
            $borrower = User::findOrFail($request->user_id);
            $borrowerId = $borrower->id;
            $borrowerName = $borrower->username;
        } else {
            // borrower login 
            $user = auth()->guard('borrower')->user();
            $borrowerId = $user->id;
            $borrowerName = $user->username;
        }
        
// tool->decr(stock )
//$tool->decrement('stock');

	//create loan([loan row])
	$loan = loan::create([
	//if thres no usr_id, get aut id
	'borrower_id' => $borrowerId,
	'tool_id'=> $tool->id,
	'loan_date'=>now()
	]);

// LOGGING
/*
        ActivityLog::create([
            'data' => "[PINJAM] $borrowerName meminjam alat: $tool->name_tools (ID Pinjam: $loan->id)"
        ]);

			//com all data
			DB::commit();
			return back()->with('success', 'Berhasil meminjam alat!');
			
        } catch (\Exception $e){
*/

//db rb
DB::rollback    ();
//dd($e->getMessage());
return back()->with('error',$e->getMessage());
        }
    }

public function approve($id){
$user = Auth::user();
//    loan = loan:finfil(id)
$loan = loan::with('borrower', 'tool')->findOrFail($id);
//loan > upd =([ status boro, admin id => auth() id()])

// login, Cek guard
$approver = Auth::user();
    
$loan->update([
'status' => 'borrow',
'approved_by' => $approver->id,
]);

// LOGGING
   ActivityLog::create([
        'data' => "[APPROVE] 
        Alat $loan->tool->name_tools 
        (Data Pinjam ID: $id) 
        di-acc $approver->username 
        untuk $loan->borrower->username"
    ]);

return back()->with('success', 'Alat telah diserahkan ke peminjam.');
    }

public function returnTool($id) {
    DB::beginTransaction();
    try {
        $loan = loan::findOrFail($id);
        
        $user = Auth::user();
       
        $tool = tool::findOrFail($loan->tool_id); 

        $loandate = Carbon::parse($loan->loan_date);
        $returndate = Carbon::now();
        $selisih = $loandate->diffInDays($returndate);

        $denda = 0;
        if($selisih > 3) {
            $denda = ($selisih - 3) * 5000;
        }

        $loan->update([
            'return_date' => $returndate,
            'status' => 'return',
            'penalty' => $denda, 
            'approved_by' => $user->id,
        ]);

        $tool->increment('stock');

        DB::commit();
        return back()->with('success', 'Berhasil return alat!');
        
    } catch (\Exception $e) { 
        DB::rollback(); 
        dd($e->getMessage());
        return back()->with('error', $e->getMessage());
        }
    }

public function report(Request $request) {
    $query = loan::with(['borrower', 'tool']);

    //  simple filter  if there a req
    if ($request->status) {
        $query->where('status', $request->status);
    }
        
    $query->when($request->start_date && $request->end_date, function ($q) use ($request) {
        return $q->whereBetween('loan_date', [$request->start_date, $request->end_date]);
    });

    $reports = $query->latest()->get();
    return view('petugas.report', compact('reports'));
    }

public function edit($id) {
    $loan = loan::with(['borrower', 'tool'])->findOrFail($id);
    $users =  User::all();
    $tools = tool::all();
    return view('admin.loans.edit', compact('loan', 'users', 'tools'));
}

public function update(Request $request, $id)
{

    $loan = loan::findOrFail($id);
$user = Auth::user();
if (!$user) return redirect()->route('login')->with('error', 'Login!');

    if ($request->has('action') && $request->action == 'return') {
    return $this->returnTool($id, $user);
    }

$data = $request->all();

$data['approved_by'] = $user->id;
$loan->update($data);
    return redirect()->route('admin.loans.index')->with('success', 'Data peminjaman diperbarui.');
    }

public function destroy($id)
{
    $loan = loan::findOrFail($id);    
    // condition - stock, stock++
    if ($loan->status != 'return') {
        tool::where('id', $loan->tool_id)->increment('stock');
    }

    $loan->delete();
    return back()->with('success', 'Data transaksi dihapus & stok disesuaikan.');
    }
}






