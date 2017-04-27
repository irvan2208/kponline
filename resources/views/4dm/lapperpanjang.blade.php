@extends('layouts.master-admin')
@section('Laporan Perpanjang')
@section('title','Laporan Perpanjangan')
@section('page-header','Laporan Perpanjang')
@section('page-description','Laporan')
@section('breadcrumblv2')
<li class="active">Laporan Perpanjang</li>
@endsection

@section('content')

<section class="content">
      <div class="box box-primary">

            <div class="box-body">
            <table id="lappemb" class="table table-bordered table-striped dataTable">
		        <thead>
		          <tr>
		            <th>No</th>
		            <th>Data</th>
		            <th>Mobil</th>
		            <th>Motor</th>
		            <th>jumlah</th>
		            <th>Jumlah Total</th>
		          </tr>
		        </thead>
            	<tbody>
            		<tr>
            			<td>1</td>
            			<td>Perpanjangan Belum Dibayar</td>
            			<td>{{ $getperpanjanganpaid->jmlmbil}}</td>
            			<td>{{ $getperpanjanganpaid->jmlmtor}}</td>
            			<td>{{ $getperpanjanganpaid->jmltrans}}</td>
            			<td>Rp. {{ number_format($getperpanjanganpaid->total)}}</td>
            		</tr>
            		<tr>
            			<td>2</td>
            			<td>Transaksi Perpanjangan selesai</td>
            			<td>{{ $getperpanjanganselesai->jmlmbil}}</td>
            			<td>{{ $getperpanjanganselesai->jmlmtor}}</td>
            			<td>{{ $getperpanjanganselesai->jmltrans}}</td>
            			<td>Rp. {{ number_format($getperpanjanganselesai->total)}}</td>
            		</tr>
            		<tr>
            			<td>3</td>
            			<td>Perpanjangan Total</td>
            			<td>{{ $getkendaraan->jmlmbil}}</td>
            			<td>{{ $getkendaraan->jmlmtor}}</td>
            			<td>{{ $getkendaraan->jmltrans}}</td>
            			<td>Rp. {{ number_format($getkendaraan->total)}}</td>
            		</tr>
            	</tbody>
            	<thead>
		          <tr>
		            <th>No</th>
		            <th>Data</th>
		            <th>Mobil</th>
		            <th>Motor</th>
		            <th>jumlah</th>
		            <th>Jumlah Total</th>
		          </tr>
		        </thead>
            </table>
            </div>

          </div>
</section>
@endsection
@section('customjs')
<script type="text/javascript">
	$('#lappemb').dataTable( {
	dom: 'Blfrtip',
    buttons: [
        {
            extend: 'print',
            text: 'Cetak Laporan Ini',
            autoPrint: true
        }
    ]
} );
</script>
@endsection