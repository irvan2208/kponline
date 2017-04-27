@extends('layouts.master-admin')
@section('Laporan Pembayaran')
@section('page-header','Laporan Pembayaran')
@section('page-description','Laporan')
@section('breadcrumblv2')
<li class="active">Laporan Pembayaran</li>
@endsection

@section('content')

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
        <table id="lappemb1" class="table table-bordered table-striped dataTable">
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
                        <td>Sudah Membayar bulan ini atau bulan depan</td>
                        <td>{{ $lapbulanini->jmlmbil}}</td>
                        <td>{{ $lapbulanini->jmlmtor}}</td>
                        <td>{{ $lapbulanini->jmltrans}}</td>
                        <td>Rp. {{ number_format($lapbulanini->total)}}</td>
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
    <div class="box box-warning">
        <div class="box-body">
            <table id="lappemb" class="table table-bordered table-striped dataTable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Polis</th>
                    <th>Pemilik</th>
                    <th>Jenis</th>
                    <th>Jumlah Bulan</th>
                    <th>Total</th>
                    <th>Dibayar Atas nama</th>
                    <th>Diterima</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($getpemb as $pemb)
                    <tr>
                        <td>{{ $pemb->id}}</td>
                        <td>{{ $pemb->no_polis}}</td>
                        <td>{{ $pemb->nama}}</td>
                        <td>{{ $pemb->njenis}}</td>
                        <td>{{ $pemb->bulan}} Bulan</td>
                        <td>Rp. {{ number_format($pemb->total)}}</td>
                        <td>
                        @if($pemb->atas_nama == null)
                            Belum Di Bayar
                        @else
                            {{$pemb->atas_nama}} ({{ date('d-m-Y',strtotime(str_replace('-','/', $pemb->tglbyr))) }})
                        @endif
                        </td>
                        <td>
                        @if($pemb->cfm == 1)
                            Selesai
                        @else
                            Belum Dikonfirmasi admin
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Polis</th>
                    <th>Pemilik</th>
                    <th>Jenis</th>
                    <th>Jumlah Bulan</th>
                    <th>Total</th>
                    <th>Dibayar Atas nama</th>
                    <th>Diterima</th>
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
<script type="text/javascript">
	$('#lappemb1').dataTable( {
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