<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(Pengeluaran::query())
                    ->addColumn('action', function($data){
                        $button = '<button class="btn btn-danger delete" data="'. $data->id .'" data-target=".deleteModal" data-toggle="modal">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pengeluaran');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'uang' => 'required|numeric|min:10000'
        ]);

        DB::beginTransaction();
        try{
            Pengeluaran::create([
                'nilai' => $request->uang
            ]);
            DB::commit();
            return redirect()->route('pengeluaran.index');
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        $pengeluaran = Pengeluaran::findOrfail($id);
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index');
    }

    public function deleteAll()
    {
        DB::table('pengeluarans')->delete();
        return redirect()->route('pengeluaran.index');
    }
}
