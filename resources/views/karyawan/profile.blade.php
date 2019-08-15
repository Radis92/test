@extends('layout.master')

@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@stop

@section('content')

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            @if (session('sukses'))
            <div class="alert alert-success" role="alert">
                {{session('sukses')}}
            </div>

            @endif
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')}}
            </div>
            @endif
            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img src="{{$karyawan->getAvatar()}}" class="img-circle" alt="Avatar" md-col-6>
                                <h3 class="name">{{$karyawan->nama_depan}}</h3>
                                <span class="online-status status-available">Available</span>
                            </div>
                            <div class="profile-stat">
                                <div class="row">
                                    <div class="col-md-4 stat-item">
                                        {{$karyawan->mapel->count()}} <span>mapel</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        15 <span>Awards</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        2174 <span>Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">Data Diri</h4>
                                <ul class="list-unstyled list-justify">
                                    <li>Jenis Kelamin <span>{{$karyawan->jenis_keklamin}}</span></li>
                                    <li>Agama <span>{{$karyawan->agama}}</span></li>
                                    <li>Alamat <span>{{$karyawan->alamat}}</span></li>
                                </ul>
                            </div>

                            <div class="text-center"><a href="/karyawan/{{$karyawan->id}}/edit" class="btn btn-warning">Edit Profile</a></div>
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                    <div class="profile-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Tambah
                        </button>
                        <h4 class="heading">{{$karyawan->nama_depan}} Data</h4>

                        <!-- TABBED CONTENT -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">KODE</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">SEMESTER</th>
                                    <th scope="col">NILAI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($karyawan->mapel as $mapel)
                                <tr>
                                    <th>{{$mapel->kode}}</th>
                                    <td>{{$mapel->nama}}</td>
                                    <td>{{$mapel->semester}}</td>
                                    <td><a href="#" class="nilai" data-type="text" data-pk="{{$mapel->id}}"
                                    data-url="/api/karyawan/{{$karyawan->id}}" data-title="Masukan Nilai">{{$mapel->pivot->nilai}}</a>
</td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- END TABBED CONTENT -->
                        <div class="panel">
                            <div id="chartNilai"></div>

                        </div>
                    </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <form action="/karyawan/{{$karyawan->id}}/addnilai" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="mapel">Ma APP</label>
                            <select class="form-control" id="mapel" name="mapel">
                                @foreach ($matapelajaran as $mp)
                                <option value="{{$mp->id}}">{{$mp->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group {{$errors->has('nilai') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">nilai</label>
                            <input name="nilai" type="text" class="form-control" id="exampleInputText" aria-describedby="emailHelp" placeholder="nilai" value="{{old('nama_depan')}}">
                            @if ($errors->has('nilai'))
                            <span class="help-block">{{$errors->first('nilai')}}</span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @stop

    @section('footer')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>

    Highcharts.chart('chartNilai', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan Nilai Karyawan'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: {!!json_encode($categories)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nilai (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Nilai',
        data: {!!json_encode($data)!!}

    }]
});
$(document).ready(function() {
    $('.nilai').editable();
});
    </script>

    @stop
