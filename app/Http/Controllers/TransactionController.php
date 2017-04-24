<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\transaction;
use App\prodi;
use App\sys;
use App\users;
use App\admincfm;
use App\jenisk;
use Auth;
use DateTime;


class TransactionController extends Controller
{
    public function show()
    {
        $loguser = Auth::user();
        //$getd = DB::table('sys')
        //DB::enableQueryLog();

        $getduser = DB::table('sys')
            ->select(['prodi.*','transaction.*','admincfm.cfm as cfm','sys.*','users.*','prodi.nama as np','jenis_kendaraan.nama as njenis','sys.no_polis as nopol',DB::raw("IFNULL(datediff(MAX(transaction.expired_at), NOW()),0)as days")])
            ->leftJoin('users','users.npm','=','sys.npm')
            ->leftJoin('jenis_kendaraan','jenis_kendaraan.id','=','sys.jenis')
            ->leftJoin('prodi','prodi.id','=','users.prodi')
            ->leftJoin('transaction','transaction.no_polis','=','sys.no_polis')
            ->leftJoin('admincfm','admincfm.transid','=','transaction.id')
            ->where('users.npm', $loguser->npm)
            ->where(function ($getduser)
            {
                $getduser->where(function ($a) {
                    $a->where('transaction.paid', 1)
                    ->where('admincfm.cfm', 1);
                })
                ->orWhere(function ($a) {
                    $a->whereNull('transaction.id');
                });
            })
            ->orderBy('transaction.expired_at','desc')
            ->groupBy('nopol');
            //->get();
            //dd($getduser->get());
        //$queries = DB::getQueryLog();
        $getkendaraan = $getduser->get();
        //dd($loguser->npm);
        if ($getkendaraan->count() == 1){
            $getkendaraan = $getkendaraan->first();
        }
        // elseif ($getkendaraan->count() == 0) {
        //     $kosong = 1;
        // }
            $cek = 1;
        if(sys::where('npm', '=', $loguser->npm)->count() == 0){
            $cek = 0;
        }
        //dd($getkendaraan); //ini ngambil hasil dari query atas

        return view('pembayaran',[
            'loguser'=>$loguser,
            'getduser'=>$getduser->first(),
            'getkendaraan'=>$getkendaraan,
            'cek'=>$cek,
            //'kosong'=>$kosong,
        ]);
    }

    public function tambah(Request $request)
    {
        //dd($request);
        // $this->validate($request,[
        //     'nopolis' => 'required',
        //     'bulan' => 'required|max:12|min:0|numeric'
        // ]);
        $getlatest = DB::table('transaction')
            ->select('expired_at')
            ->join('admincfm','transaction.id','=','admincfm.transid')
            ->where('transaction.no_polis', $request->nopol)
            ->where(function ($getlatest)
            {
                $getlatest->where(function ($a) {
                    $a->where('transaction.paid', 1)
                    ->where('admincfm.cfm', 1);
                })
                ->orWhere(function ($a) {
                    $a->whereNull('transaction.id');
                });
            })
            ->orderBy('transaction.expired_at','desc')
            ->first();

            $bulan = $request->bulan+1;
            if ($request->submitbutton == "Bayar Bulan Ini") {
                $bulan = $request->bulan;
            }
            if ($getlatest == null or (date("Y-m-d") > date($getlatest->expired_at))) {
                $date1 = date("Y-m-d");
            }else if (date("Y-m-d") < date($getlatest->expired_at)){
                $date1 = date($getlatest->expired_at);
                $bulan = $request->bulan;
            }



        //dd($bulan. $date1);
        $date = strtotime(date("Y-m-1", strtotime($date1)) . " +$bulan month");
        $date = date("Y-m-d",$date);
        


        //DB::enableQueryLog();
        $transaction = new transaction;
        $transaction->no_polis = $request->nopol;
        $transaction->bulan = $request->bulan;
        $transaction->expired_at = $date;
        //$transaction->timestamps();
        $transaction->save();
        //$queries = DB::getQueryLog();
        //dd($queries);

        //dd('asdf');

        return redirect('pembayaran/konfirmasi')
        ->with('success','Perpanjangan diterima, harap lakukan pembayaran lalu konfirmasi.');
    }

    public function showlist()
    {
        $loguser = Auth::user();
        $getall = DB::table('transaction')
        ->select(['admincfm.*','transaction.*','sys.*','transaction.created_at as tgltrans','jenis_kendaraan.nama as njenis',DB::raw('transaction.bulan*jenis_kendaraan.harga AS total')])
        ->leftJoin('sys','transaction.no_polis','=','sys.no_polis')
        ->leftJoin('jenis_kendaraan','sys.jenis','=','jenis_kendaraan.id')
        ->leftJoin('admincfm','transaction.id','=','admincfm.transid')
        ->where('sys.npm',$loguser->npm)
        //->where('transaction.paid',0)
        ->orderBy('transaction.expired_at','DESC')
        ->get();

        //dd($getall);
        return view('listpembayaran',['getall'=>$getall,]);
    }

    public function createconf($id)
    {
        $gettrans = DB::table('transaction')
        ->select(['transaction.id as noper','transaction.*','sys.*','users.*','jenis_kendaraan.nama as njenis','transaction.bank as bankid',DB::raw('transaction.bulan*jenis_kendaraan.harga AS total')])
        ->leftJoin('sys','transaction.no_polis','=','sys.no_polis')
        ->leftJoin('users','sys.npm','=','users.npm')
        ->leftJoin('jenis_kendaraan','sys.jenis','=','jenis_kendaraan.id')
        ->where('transaction.id',$id)
        ->first();

        if ($gettrans->paid == 0) {
            $getbank = DB::table('bank')->get();
        }else{
           $getbank = DB::table('bank')->where('bank.id',$gettrans->bank)->first();
        }
        //dd($getbank);
        //dd($getbank);
        return view('conpembayaran',['gettrans'=>$gettrans,'getbank'=>$getbank]);
    }

    public function storeconf(request $request, $id)
    {
        $this->validate($request, [
            'namatrans' => 'required',
            'bank' => 'required|numeric',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
        //dd(public_path());
        $imageName = time().'.'.$request->bukti->getClientOriginalExtension();
        $request->bukti->move(public_path('images'), $imageName);

        $transaction = transaction::find($id);
        $transaction->paid = 1;
        $transaction->bank = $request->bank;
        $transaction->atas_nama = $request->namatrans;
        $transaction->image = "images/".$imageName;
        $transaction->save();

        return back()
            ->with('success','Konfirmasi diterima, dan akan di cek oleh admin.');
            //->with('path',$imageName);
    }

    public function perpanjanganlist()
    {
        $getall = DB::table('transaction')
        ->select(['admincfm.*','transaction.*','sys.*','users.*','jenis_kendaraan.nama as njenis',DB::raw('transaction.bulan*jenis_kendaraan.harga AS total','transaction.updated_at as konf')])
        ->leftJoin('sys','transaction.no_polis','=','sys.no_polis')
        ->leftJoin('users','sys.npm','=','users.npm')
        ->leftJoin('jenis_kendaraan','sys.jenis','=','jenis_kendaraan.id')
        ->leftJoin('admincfm','transaction.id','=','admincfm.transid')
        ->where('transaction.paid',1)
        ->where('admincfm.cfm',null)
        ->orderBy('transaction.expired_at','DESC')
        ->get();

        return view('4dm/perpanjangan',['getall'=>$getall,]);
    }

    public function confpaid(request $request, $id)
    {
        //dd($request);
        $admincfm = new admincfm;
        $admincfm->transid = $id;
        $admincfm->cfm = $request->cfm;
        $admincfm->save();

        return back()
            ->with('success','Konfirmasi diterima, Selesai.');
    }

    public function delconf(Request $request, $id)
    {
        //dd($request);
        $transhps = DB::table('transaction')->where('id',$id)->where('no_polis',$request->nopol);
        $transhps->delete();
        return back();
    }

    public function cekterlambat()
    {
        # code...
    }
}
