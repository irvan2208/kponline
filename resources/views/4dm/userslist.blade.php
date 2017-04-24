@extends('layouts.master-admin')
@section('title','Mahasiswa')
@section('page-header','Daftar Mahasiswa')
@section('page-description','Silahkan isi form berikut')
@section('breadcrumblv2')
<li class="active">Daftar Mahasiswa</li>
@endsection

@section('content')

<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <div class="row">
        <h3 class="box-title col-xs-6">Daftar Mahasiswa </h3>
        <div class="col-xs-6 right" style="text-align: right;">{{ link_to('admin/users/create', 'Tambah Mahasiswa Baru', array('class' => 'btn btn-sm btn-danger')) }}</div>
      </div>
    </div>

    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NPM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Prodi</th>
            <th>Tgl daftar</th>
            <th>OPSI</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{$user->npm}}</td>
            <td>{{$user->nama}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->np}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{ link_to('admin/users/'.$user->npm.'/edit', 'Edit', array('class' => 'btn btn-sm btn-warning')) }}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>NPM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Prodi</th>
            <th>Tgl daftar</th>
            <th>OPSI</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</section>
@endsection