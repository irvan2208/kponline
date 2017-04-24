@extends('layouts.master-admin')
@section('title','Kendaraan')
@section('page-header','Daftar Kendaraan')
@section('page-description','')
@section('breadcrumblv2')
<li class="active">Daftar Perpanjangan</li>
@endsection

@section('content')

<section class="content">
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
	        <div class="col-xs-6 right" style="text-align: right;"><button data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-danger">Tambah Kendaraan Baru</button></div>
	      </div>
	    </div>
	    @if(count($getkendaraan) >= 1)
		<div class="box-body">
			<table id="example1" class="table table-bordered table-striped dataTable">
		        <thead>
		          <tr>
		            <th>No Polis</th>
		            <th>Pemilik</th>
		            <th>Jenis</th>
		            <th>Option</th>
		          </tr>
		        </thead>
		        <tbody>
		        	@foreach($getkendaraan as $listkendaraan)
		        		<tr>
		        			<td>{{$listkendaraan->no_polis}}</td>
		        			<td>{{$listkendaraan->nama}}</td>
		        			<td>{{$listkendaraan->njenis}}</td>
		        			{{ Form::open(array('url' => 'admin/kendaraan/'.$listkendaraan->no_polis.'/del','class'=>'delform')) }}
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
		            <th>Pemilik</th>
		            <th>Jenis</th>
		            <th>Option</th>
		          </tr>
		        </thead>
		        </table>
		</div>		
		@endif
	</div>
</section>

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Kendaraan Baru</h4>
      </div>
        {{ Form::open(array('url' => 'admin/kendaraan/tambah','id'=>'newKendaraan')) }}
      <div class="modal-body">
      <table class="table">
		<tr>
			<th>Pemilik</th>
			<td>
				<select style="width: 100%;" name="pemilik" class="form-control select2 select2-hidden-accessible">
					@foreach($users as $user)
						<option value="{{$user->npm}}">{{$user->nama}}</option>
					@endforeach
				</select>
			</td>
		</tr>
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
	$('.delform').on("submit", function(){
        return confirm("Yakin akan menghapus kendaraan ini??");
    });
</script>
<script type="text/javascript">
	$('#tblpembayaran').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false
    });
</script>

@endsection