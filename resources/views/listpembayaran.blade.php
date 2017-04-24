@extends('layouts.master')
@section('title','Konfirmasi')
@section('page-header','List perpanjangan parkir')
@section('page-description','Silahkan konfirmasi')
@section('breadcrumblv2')
<li class="active">Konfirmasi</li>
@endsection

@section('content')

<section class="content">
  <div class="box box-primary">

    <div class="box-body">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
    </div>
    @endif
      <table id="pembayaran" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No Perpanjangan</th>
            <th>No Polis</th>
            <th>Bulan</th>
            <th>Jumlah</th>
            <th>Tgl Perpanjangan</th>
            <th>Jatuh Tempo</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        @foreach($getall as $getpemb)
          <tr align="center">
            <td>{{ $getpemb->id }}</td>
            <td>{{ $getpemb->no_polis }} ({{ $getpemb->njenis }})</td>
            <td>{{ $getpemb->bulan }}</td>
            <td>Rp. {{ number_format($getpemb->total) }}</td>
            <td>{{ date('d-m-Y H:i:s',strtotime(str_replace('-','/', $getpemb->tgltrans))) }}</td>
            <td>{{ date('d-m-Y',strtotime(str_replace('-','/', $getpemb->expired_at))) }}</td>
            <td>
            @if($getpemb->paid == 0)
            {{ link_to('pembayaran/'.$getpemb->id.'/konfirmasi', 'Konfirmasi', array('class' => 'btn btn-sm btn-success')) }}
            {{ Form::open(array('url' => 'pembayaran/'.$getpemb->id.'/konfirmasi/hapus')) }}
                {{ method_field('DELETE') }}
                {{ Form::hidden('nopol', $getpemb->no_polis) }}
                  {{Form::submit('Hapus',array('class'=>'btn btn-sm btn-danger'))}}
                {{ csrf_field() }}
            {{ Form::close() }}
            @elseif($getpemb->cfm == 0)
              Menunggu Konfirmasi admin
            @elseif($getpemb->cfm == 1)
              Selesai
            @endif
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>No Perpanjangan</th>
            <th>No Polis</th>
            <th>Bulan</th>
            <th>Jumlah</th>
            <th>Tgl perpanjangan</th>
            <th>Jatuh Tempo</th>
            <th>Status</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</section>
@endsection