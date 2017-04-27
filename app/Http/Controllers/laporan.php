<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class laporan extends Controller
{
    public function pembayaran()
    {
    	$getpemb = DB::table('transaction')
    		->select(['transaction.*','transaction.updated_at as tglbyr','sys.*','jenis_kendaraan.nama as njenis','users.*','admincfm.cfm as cfm',DB::raw('transaction.bulan*jenis_kendaraan.harga AS total')])
    		->leftJoin('sys','sys.no_polis','=','transaction.no_polis')
    		->leftJoin('jenis_kendaraan','jenis_kendaraan.id','=','sys.jenis')
    		->leftJoin('users','users.npm','=','sys.npm')
    		->leftJoin('admincfm','admincfm.transid','=','transaction.id')
    		->get();
    		//dd($getpemb);

    	$date1 = date('Y-m-d');
        $date = strtotime(date("Y-m-1", strtotime($date1)) . " +1 month");
        $date = date("Y-m-d",$date);
        //dd($date);
        $lapbulanini = DB::table('transaction')
            ->select([DB::raw('count(transaction.id) as jmltrans'),DB::raw('sum(transaction.bulan*jenis_kendaraan.harga) AS total'),DB::raw('count(case when sys.jenis=1 then 1 end) as jmlmbil'),DB::raw('count(case when sys.jenis=2 then 1 end) as jmlmtor')])
            ->leftJoin('admincfm','admincfm.transid','=','transaction.id')
            ->leftJoin('sys','sys.no_polis','=','transaction.no_polis')
            ->leftJoin('jenis_kendaraan','jenis_kendaraan.id','=','sys.jenis')
            ->where('transaction.paid','=','1')
            ->where('admincfm.cfm','=','1')
            ->where('transaction.expired_at','>=',$date)
            ->first();
    	return view('4dm/laporan',['getpemb'=>$getpemb,'lapbulanini'=>$lapbulanini]);
    }

    public function perpanjangan()
    {
    	$getkendaraan = DB::table('transaction')
            ->select([DB::raw('count(transaction.id) as jmltrans'),DB::raw('sum(transaction.bulan*jenis_kendaraan.harga) AS total'),DB::raw('count(case when sys.jenis=1 then 1 end) as jmlmbil'),DB::raw('count(case when sys.jenis=2 then 1 end) as jmlmtor')])
            ->leftJoin('admincfm','admincfm.transid','=','transaction.id')
            ->leftJoin('sys','sys.no_polis','=','transaction.no_polis')
            ->leftJoin('jenis_kendaraan','jenis_kendaraan.id','=','sys.jenis')
            ->first();

            //dd($getkendaraan);
        $getperpanjanganpaid = DB::table('transaction')
            ->select([DB::raw('count(transaction.id) as jmltrans'),DB::raw('sum(transaction.bulan*jenis_kendaraan.harga) AS total'),DB::raw('count(case when sys.jenis=1 then 1 end) as jmlmbil'),DB::raw('count(case when sys.jenis=2 then 1 end) as jmlmtor')])
            ->leftJoin('admincfm','admincfm.transid','=','transaction.id')
            ->leftJoin('sys','sys.no_polis','=','transaction.no_polis')
            ->leftJoin('jenis_kendaraan','jenis_kendaraan.id','=','sys.jenis')
            ->where('transaction.paid','=','0')
            ->first();
        
        $getperpanjanganselesai = DB::table('transaction')
            ->select([DB::raw('count(transaction.id) as jmltrans'),DB::raw('sum(transaction.bulan*jenis_kendaraan.harga) AS total'),DB::raw('count(case when sys.jenis=1 then 1 end) as jmlmbil'),DB::raw('count(case when sys.jenis=2 then 1 end) as jmlmtor')])
            ->leftJoin('admincfm','admincfm.transid','=','transaction.id')
            ->leftJoin('sys','sys.no_polis','=','transaction.no_polis')
            ->leftJoin('jenis_kendaraan','jenis_kendaraan.id','=','sys.jenis')
            ->where('transaction.paid','=','1')
            ->where('admincfm.cfm','=','1')
            ->first();

        
           //dd($lapbulanini);
            return view('4dm/lapperpanjang',['getkendaraan'=>$getkendaraan,'getperpanjanganpaid'=>$getperpanjanganpaid,'getperpanjanganselesai'=>$getperpanjanganselesai]);
    }
}
