@extends('layouts.master')
@section('title','Perpanjangan')
@section('page-header','Perpanjangan Member Parkir UIB')
@section('page-description','Silahkan isi form berikut')
@section('breadcrumblv2')
<li class="active">Perpanjangan</li>
@endsection

@section('content')

<section class="content">
@if($cek == 0)
  <div class="callout callout-warning">
    <h4>Kendaraan tidak ditemukan</h4>

    <p>Anda belum mendaftarkan kendaraan anda, silahkan klik {{ link_to('kendaraan', 'disini') }} untuk mendaftar.</p>
  </div>
@else
  @if (count($getkendaraan) < 1)
    <div class="callout callout-warning">
    <h4>Masih ada perpanjangan yang menunggu konfirmasi</h4>

    <p>Masih ada perpanjangan yang menunggu konfirmasi.</p>
  </div>
  @else
    <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->

          @if($getkendaraan->days > 0)
          {{ Form::open(array('url' => 'pembayaran/baru')) }}
          @endif
          <div class="box-body">
          <table class="table">
            <tbody>
          		<tr>
          			<th>NPM</th>
          			<td>{{ $getduser->npm }}</td>
          		</tr>
          		<tr>
          			<th>Nama Mahasiswa</th>
          			<td>{{ $getduser->nama }}</td>
          		</tr>
          		<tr>
          			<th>Prodi</th>
          			<td>{{ $getduser->np }}</td>
          		</tr>
          		<tr>
          			<th>Email</th>
          			<td>{{ $getduser->email }}</td>
          		</tr>
          		<tr>
          			<th>No Hp</th>
          			<td>{{ $getduser->phone }}</td>
          		</tr>
          		<tr>
          			<th>No Polis</th>
          			<td>
                  @if (count($getkendaraan) == 1)
                    {{ $getkendaraan->nopol }} ({{ $getkendaraan->njenis }}) 
                    <input type="hidden" name="nopol" value="{{ $getkendaraan->nopol }}">
                      @if($getkendaraan->days <= 0 or empty($getkendaraan->cfm))
                        <span class="text-red">
                        Sudah Habis
                        </span>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Perpanjang bulan ini atau bulan depan?</h4>
                              </div>
                              <div class="modal-body">
                              Nampaknya anda telat membayar, silahkan pilih
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                {{ Form::open(array('url' => 'pembayaran/baru')) }}
                                  <input type="hidden" name="nopol" value="{{ $getkendaraan->nopol }}">
                                  {{ Form::hidden('bulan', 1, array('class' => 'form-control bulan1','min'=>1, 'max' => 12)) }}
                                  {!! Form::submit( 'Bayar Bulan Ini', ['class' => 'btn btn-primary btn-clr', 'name' => 'submitbutton', 'value' => 'blnini'])!!}
                                  {!! Form::submit( 'Bayar Bulan Depan', ['class' => 'btn btn-primary btn-clr', 'name' => 'submitbutton', 'value' => 'blndpn'])!!}
                                {{ csrf_field() }}
                                {{ Form::close() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      @elseif($getkendaraan->days > 0)
                        {{$getkendaraan->days}} Hari Lagi
                      @endif
                    @else
                      <select name="nopol" class="form-control">
                      @foreach ($getkendaraan as $kend)
                        @if($kend->days < 1)
                          class="text-red"
                        @endif
                          <option class="{{ $kend->days <5 ? 'text-red' :'' }}" value="{{$kend->nopol}}">{{$kend->nopol}} ({{$kend->njenis}}) 
                          <span class="text-red">
                            @if($kend->days <= 0 or empty($kend->cfm))
                              Sudah Habis
                            @elseif($kend->days > 0)
                              {{$kend->days}} Hari Lagi
                            @endif
                          </span>
                          </option>
                      @endforeach
                      </select>
                    @endif
                  </td>
          		</tr>
          		<tr>
          			<th>Pilih Jumlah Bulan</th>
          			<td class="{{ $errors->has('bulan') ? 'has-error' :'' }}">
                    {{ Form::number('bulan', 1, array('class' => 'form-control bulan','min'=>1, 'max' => 12)) }}

                    @if($errors->has('bulan'))
                          <span class="help-block">{{$errors->first('bulan')}}</span>
                    @endif
          			</td>
          		</tr>
          		<tr>
          		<th colspan="2">
              @if($getkendaraan->days <= 0)
                <button class="btn btn-block btn-primary btn-clr" data-toggle="modal" data-target="#myModal">Simpan</button>
              @else
                {{Form::submit('Simpan',array('class'=>'btn btn-block btn-primary btn-clr'))}}
              @endif
                <!-- data-toggle="modal" data-target="#myModal" -->
                </th>
          		</tr>
            </tbody>
          </table>
          </div>
          @if($getkendaraan->days > 0)
          {{ csrf_field() }}
          {{ Form::close() }}
          @endif
        </div>
        @endif
        @endif
</section>

@endsection
@section('customjs')
<script type="text/javascript">
  $('.bulan').bind('keyup mouseup', function () {
      $('.bulan1').val($('.bulan').val())
  });

  $("[type='number']").keypress(function (evt) {
          evt.preventDefault();
  });
</script>
@endsection