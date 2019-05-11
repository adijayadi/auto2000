@extends('main')
@section('extra_style')
<style type="text/css">
    /*Ini Extra Style*/
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tambah Kendaraan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Master</a>
            </li>
            <li>
                <a href="{{route('kendaraan')}}">Master Kendaraan</a>
            </li>
            <li class="active">
                <strong>Tambah Kendaraan</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tambah Kendaraan</h5>
                    <div class="ibox-tools">
                        <a href="{{route('kendaraan')}}" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Nama Pemilik</label>
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-sm" name="">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>No HP</label>
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">+62</span>
                                            <input type="text" class="form-control input-sm" name="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>E-mail</label>
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-sm" name="">
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>No Kendaraan</label>
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-sm" name="">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Nama Kendaraan</label>
                                </div>

                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-sm" name="">
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>

                    <div class="row">
                        
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Alamat</label>
                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="form-group">
                                <textarea class="form-control" name=""></textarea>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="ibox-footer text-right">
                    <button type="button" class="btn btn-primary">Simpan Data</button>
                    <a href="{{route('kendaraan')}}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_script')
<script type="text/javascript">

</script>
@endsection
