<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(Pendapatan::query())
                    ->addColumn('action', function($data){
                        $button = '<button class="btn btn-danger delete" data="'. $data->id .'" data-target=".deleteModal" data-toggle="modal">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pemasukan');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'uang' => 'required|numeric|min:10000'
        ]);

        DB::beginTransaction();
        try{
            $pendapatan = Pendapatan::create([
                'nilai' => $request->uang
            ]);
            DB::commit();
            return redirect()->route('pemasukan.index');
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        $pendapatan = Pendapatan::findOrfail($id);
        $pendapatan->delete();
        return redirect()->route('pemasukan.index');
    }

    public function deleteAll()
    {
        DB::table('pendapatans')->delete();
        return redirect()->route('pemasukan.index');
    }
}
