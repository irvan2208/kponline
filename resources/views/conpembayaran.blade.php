@extends('layouts.master')
@section('title','Konfirmasi')
@section('page-header','Konfirmasi Pembayaran Member Parkir UIB')
@section('page-description','Silahkan isi form berikut')
@section('breadcrumblv2')
<li class="active">Konfirmasi</li>
@endsection

@section('content')

<section class="content">
      <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            {{ Form::open(array('url' => 'pembayaran/'.$gettrans->noper.'/konfirmasi','enctype'=>'multipart/form-data')) }}
            <div class="box-body">
            <table class="table">
	            <tbody>
            		<tr>
            			<th>No Perpanjangan</th>
            			<td>{{ $gettrans->noper }}</td>
            		</tr>
            		<tr>
            			<th>Nama Mahasiswa</th>
            			<td>{{ $gettrans->nama }}</td>
            		</tr>
            		<tr>
            			<th>No Hp</th>
            			<td>{{ $gettrans->phone }}</td>
            		</tr>
            		<tr>
            			<th>No Polis</th>
            			<td>{{ $gettrans->no_polis }}</td>
            		</tr>
            		<tr>
            			<th>Jenis Kendaraan</th>
            			<td>{{ $gettrans->njenis }}</td>
            		</tr>
            		<tr>
            			<th>Jumlah Bulan</th>
            			<td>{{ $gettrans->bulan }}</td>
            		</tr>
                        <tr>
                              <th>Total Pembayaran</th>
                              <td>Rp. {{ number_format($gettrans->total) }}</td>
                        </tr>
                        <tr>
                              <th>Bank Tujuan</th>
                              <td>
                              @if($gettrans->paid == 1)
                                    {{$getbank->nama}} ({{$getbank->norek}})
                              @else
                              <select name="bank" class="form-control">
                                    @foreach($getbank as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->nama }} ({{ $bank->norek }})</option>
                                    @endforeach
                              </select>
                              @endif
                              </td>
                        </tr>
                        <tr>
                              <th>Transfer/Setor A.N</th>
                              <td>
                              @if($gettrans->paid == 1)
                                    {{$gettrans->atas_nama}}
                              @else
                              {{ Form::text('namatrans', '', array('class' => 'form-control')) }}
                              @endif
                              </td>
                        </tr>
                        <tr>
                              @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                          <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                          <ul>
                                                @foreach ($errors->all() as $error)
                                                      <li>{{ $error }}</li>
                                                @endforeach
                                          </ul>
                                    </div>
                              @endif

                              @if ($message = Session::get('success'))
                              <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                      <strong>{{ $message }}</strong>
                              </div>
                              @endif

                              <th>Bukti Pembayaran</th>
                              <td>
                              @if($gettrans->paid == 1)
                              <a data-toggle="modal"  data-target="#imgmodal" href="#"><img width="200" height="100" src="{{ url('/') }}/{{ $gettrans->image }}"></a>
                              @else
                              {{ Form::file('bukti', '', null, array('class' => 'form-control')) }}
                              @endif
                              </td>
                        </tr>
            		<tr>
                        @if($gettrans->paid == 0)
            		<th colspan="2">
                        {{Form::submit('Kirim',array('class'=>'btn btn-block btn-primary btn-clr'))}}</th>
                        @endif
            		</tr>
	            </tbody>
            </table>
            </div>
            {{ csrf_field() }}
            {{ Form::close() }}
          </div>
</section>

<div id="imgmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bukti Pembayaran {{ $gettrans->noper }}</h4>
      </div>
      <div class="modal-body">
        <img width="100%" height="450" src="{{ url('/') }}/{{ $gettrans->image }}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection