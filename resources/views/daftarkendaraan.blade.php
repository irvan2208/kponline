@extends('layouts.master')
@section('title','Kendaraan')
@section('page-header','Profil & Kendaraan')
@section('page-description','Silahkan isi form berikut')
@section('breadcrumblv2')
<li class="active">Profil & Kendaraan</li>
@endsection

@section('content')
<section class="content">
@if(app('request')->input('edit') == 1)
<div class="col-md-4">
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Edit</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  {{ Form::open(array('url' => 'users/'.$getuser->npm)) }}
  <div class="box-body">
    <div class="form-group {{ $errors->has('npm') ? 'has-error' :'' }}">
      {{Form::label('npm', 'Nomor Pokok Mahasiswa')}}
      {{ Form::text('npm', $getuser->npm, array('class' => 'form-control', 'placeholder' => '1431059','disabled')) }}
              @if($errors->has('npm'))
                    <span class="help-block">{{$errors->first('npm')}}</span>
              @endif
    </div>
    <div class="form-group {{ $errors->has('nama') ? 'has-error' :'' }}">
      {{Form::label('nama', 'Nama Mahasiswa')}}
      {{ Form::text('nama', $getuser->unama, array('class' => 'form-control', 'placeholder' => 'Irvan Santoso')) }}
              @if($errors->has('nama'))
                    <span class="help-block">{{$errors->first('nama')}}</span>
              @endif
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          {{Form::label('jk', 'Jenis Kelamin')}}
          {{ Form::select('jk', ['m'=>'Pria','f'=>'Wanita'], $getuser->jk, array('class' => 'form-control')) }}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          {{Form::label('pr', 'Prodi')}}<br>
          {{ Form::select('prodi', $prodi, $getuser->prodi, array('class' => 'form-control select2 select2-hidden-accessible','style' => 'width:100%')) }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
              {{Form::label('email', 'Email Address')}}
              {{ Form::email('email', $getuser->email, ['class' => 'form-control']) }}
              @if($errors->has('email'))
                    <span class="help-block">{{$errors->first('email')}}</span>
              @endif
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone') ? 'has-error' :'' }}">
          {{Form::label('pr', 'No Hp')}}<br>
          {{ Form::text('phone', $getuser->phone, ['class' => 'form-control','placeholder'=>'No Hp Mahasiswa']) }}
          @if($errors->has('phone'))
                <span class="help-block">{{$errors->first('phone')}}</span>
          @endif
        </div>
      </div>
      </div>
    <div class="form-group">
      {{Form::submit('Simpan',array('class'=>'btn btn-block btn-primary'))}}
    </div>
  </div>
  {{ csrf_field() }}
  {{ Form::hidden('_method', 'PUT') }}
  {{ Form::close() }}
</div>
</div>
@else
<div class="col-md-4">
	<div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{ url('/') }}/dist/img/user.jpg" alt="User profile picture">

          <h3 class="profile-username text-center">{{ $getuser->unama }}</h3>

          <p class="text-muted text-center">{{ $getuser->pnama }}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Jenis Kelamin</b> <a class="pull-right">
              @if(!empty($getuser->jk))
              	{{ $getuser->jk === "m" ? "Pria" : "Wanita" }}
              @else
              	No Data
              @endif
              </a>
            </li>
            <li class="list-group-item">
              <b>Email</b> <a class="pull-right">{{$getuser->email}}</a>
            </li>
            <li class="list-group-item">
              <b>Telephone</b> <a class="pull-right">
              @if(!empty($getuser->jk))
              {{$getuser->phone}}
              @else
              No Data
              @endif</a>
            </li>
            <li class="list-group-item">
              <b>Mendaftar pada</b> <a class="pull-right">
              {{ date('d-m-Y',strtotime(str_replace('-','/', $getuser->tgldaftar))) }}</a>
            </li>
          </ul>
          {{ link_to('kendaraan?edit=1', 'Edit', array('class' => 'btn btn-warning btn-block')) }}
        </div>
        <!-- /.box-body -->
      </div>
</div>
@endif
<div class="col-md-8">
	<div class="box box-primary">
	@if (count($errors) > 0)
        <div class="alert alert-danger">
              There were some problems with your input.<br><br>
              <ul>
                    @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                    @endforeach
              </ul>
        </div>
  @endif
		<div class="box-header with-border">
	      <div class="row">
	        <h3 class="box-title col-xs-6">Daftar Kendaraan </h3>
	      </div>
	    </div>
	    @if(count($getkendaraan) >= 1)
		<div class="box-body">
			<table id="tblpembayaran" class="table table-bordered table-striped">
		        <thead>
		          <tr>
		            <th>No Polis</th>
		            <th>Jenis</th>
		            <th>Option</th>
		          </tr>
		        </thead>
		        <tbody>
		        	@foreach($getkendaraan as $listkendaraan)
		        		<tr>
		        			<td>{{$listkendaraan->no_polis}}</td>
		        			<td>{{$listkendaraan->njenis}}</td>
		        			{{ Form::open(array('url' => 'kendaraan/'.$listkendaraan->no_polis.'/del','id'=>'delform')) }}
			        			{{ method_field('DELETE') }}
			        				<td>{{Form::submit('Hapus',array('class'=>'btn btn-primary btn-warning'))}}</td>
			        			{{ csrf_field() }}
	   						{{ Form::close() }}
		        		</tr>
		        	@endforeach
		        </tbody>
		        <thead>
		          <tr>
		            <th>No Polis</th>
		            <th>Jenis</th>
		            <th>Option</th>
		          </tr>
		        </thead>
		        </table>
		</div>		
		@endif
    @if($ckend == 0)
	<div class="box-footer">
	    <button data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-danger">Tambah Kendaraan Baru</button>
	  </div>
    @endif
	</div>

</div>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Kendaraan Baru</h4>
      </div>
        {{ Form::open(array('url' => 'kendaraan/tambah','id'=>'newKendaraan')) }}
      <div class="modal-body">
      <table class="table">
		<tr>
			<th>Jenis Kendaraan</th>
			<td>{{ Form::text('no_polis', '', array('class' => 'form-control', 'placeholder' => 'BP1234AA')) }}</td>
		</tr>
		<tr>
			<th>Jenis Kendaraan</th>
			<td>{{ Form::select('jenisk', $getjnskendaraan, null, array('class' => 'form-control','style' => 'width:100%')) }}</td>
		</tr>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {{Form::submit('Simpan',array('class'=>'btn btn-primary btn-clr'))}}
      </div>
	    {{ csrf_field() }}
	    {{ Form::close() }}
    </div>
  </div>
</div>
@endsection


@section('customjs')
<script type="text/javascript">
	$('#tblpembayaran').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false
    });
</script>

<script type="text/javascript">
	$('#delform').on("submit", function(){
        return confirm("Yakin akan menghapus kendaraan ini??");
    });
</script>
@endsection