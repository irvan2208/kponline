@extends('layouts.master-admin')
@section('title','Users')
@section('page-header','Tambah User Baru')
@section('page-description','Silahkan isi form berikut')
@section('breadcrumblv2')
<li class="active">Tambah User</li>
@endsection

@section('content')

<section class="content">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {{ Form::open(array('url' => 'admin/users','id'=>'newU')) }}
            <div class="box-body">
                  <div class="row">
                        <div class="col-md-6">
                              <div class="form-group">
                                    {{Form::label('pr', 'Prodi')}}<br>
                                    {{ Form::select('prodi', $prodi, null, array('class' => 'form-control select2 select2-hidden-accessible','style' => 'width:100%')) }}
                              </div>
                        </div>
                        <div class="col-md-6">
                              <div class="form-group {{ $errors->has('npm') ? 'has-error' :'' }}">
                                    {{Form::label('npm', 'Nomor Pokok Mahasiswa')}}
                                    {{ Form::text('npm', '', array('class' => 'form-control', 'placeholder' => 'NPM Mahasiswa','data-inputmask'=>'\'mask\': [\'99-99-999\']','data-mask')) }}

                                    @if($errors->has('npm'))
                                          <span class="help-block">{{$errors->first('npm')}}</span>
                                    @endif
                              </div>
                        </div>
                  </div>
            	<div class="row">
            		<div class="col-md-6">
                              <div class="form-group has-feedback {{ $errors->has('nama') ? 'has-error' :'' }}">
                                    {{Form::label('nama', 'Nama Mahasiswa')}}
                                    {{ Form::text('nama', '', array('class' => 'form-control', 'placeholder' => 'Nama Mahasiswa')) }}
                                    @if($errors->has('nama'))
                                          <span class="help-block">{{$errors->first('nama')}}</span>
                                    @endif
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                              </div>
                        </div>
                        <div class="col-md-6">
            			<div class="form-group">
            				{{Form::label('jk', 'Jenis Kelamin')}}
            				{{ Form::select('jk', ['m'=>'Pria','f'=>'Wanita'], null, array('class' => 'form-control')) }}
            			</div>
            		</div>
            	</div>
                  <div class="row">
                        <div class="col-md-6">
                              <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' :'' }}">
                                    {{Form::label('email', 'Email Address')}}
                                    {{ Form::email('email', '', ['class' => 'form-control','placeholder' => 'Email Mahasiswa']) }}
                                    @if($errors->has('email'))
                                          <span class="help-block">{{$errors->first('email')}}</span>
                                    @endif
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                              </div>
                        </div>
                        <div class="col-md-6">
                              <div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' :'' }}">
                                    {{Form::label('phone', 'Nomor Hp Mahasiswa')}}
                                    {{ Form::text('phone', '', array('class' => 'form-control', 'placeholder' => 'No Hp Mahasiswa')) }}
                                    @if($errors->has('phone'))
                                          <span class="help-block">{{$errors->first('phone')}}</span>
                                    @endif
                                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                              </div>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-md-6">
                              {{Form::label('email', 'Password')}}
                              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                                    {{ Form::password('password', array('class' => 'password form-control','readonly'=>'readonly','placeholder'=>'Password')) }}

                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif

                                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                              {{ Form::checkbox('pstandart','standart',true, array('id'=>'checkpwd'))}} Gunakan Password Standar (user123)
                              </div>
                        </div>
                  </div>
            	<div class="form-group">
            		{{Form::submit('Simpan',array('class'=>'btn btn-block btn-primary btn-clr'))}}
            	</div>
            </div>
            {{ csrf_field() }}
            {{ Form::close() }}
          </div>
</section>
@endsection

@section('scripttbh')
<script type="text/javascript">
      $("[data-mask]").inputmask();
</script>
<script type="text/javascript">
      $(document.body).on("change",".select2",function(){
       //$('#npm').val(this.value);
       $("[data-mask]").val('00'+this.value).inputmask().toString();
       $("[data-mask]").val().replace(new RegExp('-', 'g'),"");
      });
</script>
<script type="text/javascript">
      $('.btn-clr').click(function( event ) {
        $("[data-mask]").val().replace(new RegExp('-', 'g'),"");
      });
</script>


<script type="text/javascript">
      $("[type=password]").val('user123');
</script>
<script type="text/javascript">
      $("#checkpwd").change(function() {
            $("[type=password]").val('user123');
            $("[type=password]").prop("readonly", true);
            var ischecked= $(this).is(':checked');
            if(!ischecked){
                  $("[type=password]").val('');
                  $("[type=password]").prop("readonly", false);
            }
      });
</script>
@endsection