<?php

namespace App\Http\Controllers;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    static public function index()
    {
        $year = now()->format('Y');
        $month = now()->format('n');
        $array_bulan = [0,0,0,0,0,0,0,0,0,0,0,0];

        // pemasukan
        $pemasukan_pertahun = Pendapatan::whereYear('created_at', $year)
        ->groupBy(DB::raw("MONTH(created_at)"))->selectRaw('MONTH(created_at) as month, SUM(nilai) as sum')->get();
        $pemasukan_pertahun = $pemasukan_pertahun->mapWithKeys(function($item){
            return [$item->month - 1 => intval($item->sum)];
        });
        $pemasukan_pertahun = array_replace($array_bulan,json_decode(json_encode($pemasukan_pertahun), true));
        
        // pengeluaran
        $pengeluaran_pertahun = Pengeluaran::whereYear('created_at', $year)
        ->groupBy(DB::raw("MONTH(created_at)"))->selectRaw('MONTH(created_at) as month, SUM(nilai) as sum')->get();
        $pengeluaran_pertahun = $pengeluaran_pertahun->mapWithKeys(function($item){
            return [$item->month - 1 => intval($item->sum)];
        });
        $pengeluaran_pertahun = array_replace($array_bulan,json_decode(json_encode($pengeluaran_pertahun), true));
        return view('dashboard',[
            'pemasukan_perbulan' => $pemasukan_pertahun[$month - 1] ?? 0,
            'pemasukan_pertahun' => $pemasukan_pertahun,
            'pengeluaran_perbulan' => $pengeluaran_pertahun[$month - 1] ?? 0,
            'pengeluaran_pertahun' => $pengeluaran_pertahun
        ]);
    }
}