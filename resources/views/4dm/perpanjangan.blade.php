@extends('layouts.master-admin')
@section('title','Perpanjangan')
@section('page-header','Daftar Perpanjangan')
@section('page-description','Menunggu konfirmasi')
@section('breadcrumblv2')
<li class="active">Daftar Perpanjangan</li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>No. Polis</th>
                  <th>TF A.Nama</th>
                  <th>Jatuh tempo</th>
                  <th>Jml Bln</th>
                  <th>Total</th>
                  <th>Bukti pembayaran</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($getall as $data)
                	<tr>
                    <td>{{$data->id}}</td>
                  	<td>{{$data->no_polis}}</td>
                    <td>{{$data->atas_nama}}</td>
                  	<td>{{$data->expired_at}}</td>
                  	<th>{{$data->bulan}} Bulan</th>
                  	<td>Rp. {{number_format($data->total)}}</td>
                  	<td><a data-toggle="modal"  data-target="#imgmodal" href="#"><img width="200" height="100" src="{{ url('/') }}/{{ $data->image }}"></a></td>
                    <td>
                      {{ Form::open(array('url' => 'admin/perpanjangan/'.$data->id.'/konfirmasi')) }}
                      {{ Form::hidden('cfm', 1) }}
                      {{Form::submit('Konfirmasi',array('class'=>'btn btn-sm btn-success'))}}
                      {{ csrf_field() }}
                      {{ Form::hidden('_method', 'PUT') }}
                      {{ Form::close() }}
                    </td>
                  </tr>
                  <div id="imgmodal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Bukti Pembayaran {{ $data->id }}</h4>
                        </div>
                        <div class="modal-body">
                          <img width="100%" height="450" src="{{ url('/') }}/{{ $data->image }}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>No. Polis</th>
                  <th>Nama</th>
                  <th>Jatuh tempo</th>
                  <th>Jml Bln</th>
                  <th>Total</th>
                  <th>Bukti pembayaran</th>
                  <th>Opsi</th>
                </tr>
                </tfoot>
              </table>
            </div>

          </div>
</section>

@endsection