@extends('layouts.master-admin')
@section('title','Users')
@section('page-header','Edit User')
@section('page-description','Silahkan isi form berikut')
@section('breadcrumblv2')
<li class="active">Edit User</li>
@endsection

@section('content')

<section class="content">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {{ Form::open(array('url' => 'admin/users/'.$users->npm)) }}
            <div class="box-body">
            	<div class="form-group {{ $errors->has('npm') ? 'has-error' :'' }}">
            		{{Form::label('npm', 'Nomor Pokok Mahasiswa')}}
            		{{ Form::text('npm', $users->npm, array('class' => 'form-control', 'placeholder' => '1431059','disabled')) }}
                        @if($errors->has('npm'))
                              <span class="help-block">{{$errors->first('npm')}}</span>
                        @endif
            	</div>
            	<div class="form-group {{ $errors->has('nama') ? 'has-error' :'' }}">
            		{{Form::label('nama', 'Nama Mahasiswa')}}
            		{{ Form::text('nama', $users->nama, array('class' => 'form-control', 'placeholder' => 'Irvan Santoso')) }}
                        @if($errors->has('nama'))
                              <span class="help-block">{{$errors->first('nama')}}</span>
                        @endif
            	</div>
            	<div class="row">
            		<div class="col-md-6">
            			<div class="form-group">
            				{{Form::label('jk', 'Jenis Kelamin')}}
            				{{ Form::select('jk', ['m'=>'Pria','f'=>'Wanita'], $users->jk, array('class' => 'form-control')) }}
            			</div>
            		</div>
            		<div class="col-md-6">
            			<div class="form-group">
            				{{Form::label('pr', 'Prodi')}}<br>
	            			{{ Form::select('prodi', $prodi, $users->prodi, array('class' => 'form-control select2 select2-hidden-accessible','style' => 'width:100%')) }}
            			</div>
            		</div>
            	</div>
                  <div class="row">
                        <div class="col-md-6">
                              <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
                                    {{Form::label('email', 'Email Address')}}
                                    {{ Form::email('email', $users->email, ['class' => 'form-control']) }}
                                    @if($errors->has('email'))
                                          <span class="help-block">{{$errors->first('email')}}</span>
                                    @endif
                              </div>
                        </div>

                        <div class="col-md-6">
                              <div class="form-group {{ $errors->has('phone') ? 'has-error' :'' }}">
                                    {{Form::label('pr', 'No Hp')}}<br>
                                    {{ Form::text('phone', $users->phone, ['class' => 'form-control','placeholder'=>'No Hp Mahasiswa']) }}
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
</section>
@endsection