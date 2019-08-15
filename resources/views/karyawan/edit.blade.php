@extends('layout.master')

@section ('content')
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
                    <form action="/karyawan/{{$karyawan->id}}/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama depan</label>
                            <input name="nama_depan" type="text" class="form-control" id="exampleInputText" aria-describedby="emailHelp" placeholder="Nama Depan" value="{{$karyawan->nama_depan}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Belakang</label>
                            <input name="nama_belakang" type="text" class="form-control" id="exampleInputText" aria-describedby="emailHelp" placeholder="Nama Belkang" value="{{$karyawan->nama_belakang}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                            <select name="jenis_keklamin" class="form-control" id="exampleFormControlSelect1">
                                <option value="L" @if($karyawan->jenis_keklamin=='L')selected @endif>Laki-Laki</option>
                                <option value="P" @if($karyawan->jenis_keklamin=='P')selected @endif>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Agama</label>
                            <input name="agama" type="text" class="form-control" id="exampleInputText" aria-describedby="emailHelp" placeholder="Agama" value="{{$karyawan->agama}}" </div> <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat
                                <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$karyawan->alamat}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Avatar</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@stop