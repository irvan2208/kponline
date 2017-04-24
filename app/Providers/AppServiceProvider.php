<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $perpanjangbaru = DB::table('transaction')
        ->leftJoin('admincfm','transaction.id','=','admincfm.transid')
        ->where('transaction.paid',1)
        ->where('admincfm.cfm',null)
        ->get();
        view()->share('perpanjangbaru', $perpanjangbaru->count());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
