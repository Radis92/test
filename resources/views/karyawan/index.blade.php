@extends('layout.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
         @if (session('sukses'))
            <div class="alert alert-success" role="alert">
                {{session('sukses')}}
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Karyawan</h3>
                            <div class="right">
                                <!-- <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
                                    Tambah Karyawan -->
                                </button>
                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i></button>
                            </div>


                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Depan</th>
                                        <th>Nama Belakang</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Agama</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_karyawan as $karyawan)
                                    <tr class="table-danger">
                                        <td><a href="/karyawan/{{$karyawan->id}}/profile">{{$karyawan->nama_depan}}</a></td>
                                        <td><a href="/karyawan/{{$karyawan->id}}/profile">{{$karyawan->nama_belakang}}</a></td>
                                        <td>{{$karyawan->jenis_keklamin}}</td>
                                        <td>{{$karyawan->agama}}</td>
                                        <td>{{$karyawan->alamat}}</td>
                                        <td><a href="/karyawan/{{$karyawan->id}}/edit" class="btn btn-warning btn-sm"">Edit</a>
                <a href="/karyawan/ {{$karyawan->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan dihapus?')">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Baru <span class="typcn typcn-chart-bar-outline"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('karyawan')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Nama depan</label>
                            <input name="nama_depan" type="text" class="form-control" id="exampleInputText" aria-describedby="emailHelp" placeholder="Nama Depan" value="{{old('nama_depan')}}">
                            @if ($errors->has('nama_depan'))
                            <span class="help-block">{{$errors->first('nama_depan')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Belakang</label>
                            <input name="nama_belakang" type="text" class="form-control" id="exampleInputText" aria-describedby="emailHelp" placeholder="Nama Belakang" value="{{old('nama_belakang')}}">
                        </div>
                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Email</label>
                            <input name="email" type="email" class="form-control" id="exampleInputText" aria-describedby="emailHelp" placeholder="Email" value={{old('email')}}>
                            @if ($errors->has('email'))
                            <span class="help-block">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group {{$errors->has('jenis_keklamin') ? 'has-error' : ''}}">
                            <label for="exampleFormControlSelect1">Example select</label>
                            <select name="jenis_keklamin" class="form-control" id="exampleFormControlSelect1">
                                <option value="L" {{(old('jenis_keklamin')=='L') ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{(old('jenis_keklamin')=='L') ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @if ($errors->has('jenis_keklamin'))
                            <span class="help-block">{{$errors->first(jenis_keklamin)}}</span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Agama</label>
                            <input name="agama" type="text" class="form-control" id="exampleInputText" aria-describedby="emailHelp" placeholder="agama" value="{{old('agama')}}">
                            @if ($errors->has('agama'))
                            <span class="help-block">{{$errors->first('agama')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat
                                <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('alamat')}}</textarea>
                        </div>
                        <div class="form-group {{$errors->has('avatar') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Avatar</label>
                            <input type="file" name="avatar" class="form-control">
                            @if ($errors->has('avatar'))
                            <span class="help-block">{{$errors->first('avatar')}}</span>
                            @endif
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    @stop