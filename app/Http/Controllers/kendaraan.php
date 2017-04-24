<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\jenisk;
use App\sys;
use App\users;

class kendaraan extends Controller
{
    public function showkendaraan()
    {
    	$loguser = Auth::user();
        $prodi = DB::table('prodi')->pluck('nama', 'id');
    	$getkendaraan = DB::table('sys')->select(['sys.*','jenis_kendaraan.nama as njenis'])->leftJoin('jenis_kendaraan','jenis_kendaraan.id','=','sys.jenis')->where('npm',$loguser->npm)->get();
    	$getjnskendaraan = DB::table('jenis_kendaraan')->pluck('nama', 'id');

        $getuser = DB::table('users')->select(['users.*','users.nama as unama','prodi.*','prodi.nama as pnama','users.created_at as tgldaftar'])->where('npm',$loguser->npm)->leftJoin('prodi','prodi.id','=','users.prodi')->first();
        //dd($getuser);

        $ckend = DB::table('sys')->where('npm',$loguser->npm)->count();
        //dd($getuser);

    	return view('daftarkendaraan',['prodi'=>$prodi,'getkendaraan'=>$getkendaraan,'getjnskendaraan'=>$getjnskendaraan,'getuser'=>$getuser,'ckend'=>$ckend]);
    }

    public function showadmin()
    {
        $getkendaraan = DB::table('sys')->select(['sys.*','users.*','jenis_kendaraan.nama as njenis'])->leftJoin('jenis_kendaraan','jenis_kendaraan.id','=','sys.jenis')->leftJoin('users','users.npm','=','sys.npm')->get();
        $getjnskendaraan = DB::table('jenis_kendaraan')->pluck('nama', 'id');
        $users = DB::table('users')->get();
        //dd($getkendaraan);
       return view('4dm/kendaraan',['getkendaraan'=>$getkendaraan,'users'=>$users,'getjnskendaraan'=>$getjnskendaraan]);
    }

    public function storetambah(Request $request)
    {
        $this->validate($request, [
            'no_polis' => 'required|max:9|unique:sys',
            'jenisk' => 'required|numeric',
        ]);
        //dd($request);

        $loguser = Auth::user();

        $newkendaraan = new sys;
        $newkendaraan->no_polis = $request->no_polis;
        $newkendaraan->npm = $loguser->npm;
        $newkendaraan->jenis = $request->jenisk;
        $newkendaraan->save();

        return redirect()->route('kendaraan');
    }

    public function admstoretambah(Request $request)
    {
    	$this->validate($request, [
            'no_polis' => 'required|max:9|unique:sys',
            'jenisk' => 'required|numeric',
        ]);

        $newkendaraan = new sys;
        $newkendaraan->no_polis = $request->no_polis;
        $newkendaraan->npm = $request->pemilik;
        $newkendaraan->jenis = $request->jenisk;
        $newkendaraan->save();

    	return redirect()->route('admin/kendaraan');
    }

    public function admhapus(Request $request, $nopol)
    {
        //dd($nopol);
        $kendaraanhps = DB::table('sys')->where('no_polis',$nopol);
        //dd($kendaraanhps);
        $kendaraanhps->delete();
        return back();
    }

    public function hapus(Request $request, $nopol)
    {
        $loguser = Auth::user();
    	$kendaraanhps = DB::table('sys')->where('no_polis',$nopol)->where('npm',$loguser->npm);
    	//dd($kendaraanhps);
    	$kendaraanhps->delete();
    	return back();
    }
}
