@extends('main')
@section('extra_style')
<style type="text/css">
    /*Ini Extra Style*/
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tambah Pengguna</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Master</a>
            </li>
            <li>
                <a href="{{route('pengguna')}}">Master Pengguna</a>
            </li>
            <li class="active">
                <strong>Tambah Pengguna</strong>
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
                    <h5>Tambah Pengguna</h5>
                    <div class="ibox-tools">
                        <a href="{{route('pengguna')}}" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                        

                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Nama Pengguna</label>
                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="">
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Username</label>
                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Password</label>
                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" class="form-control input-sm" name="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-primary" id="btn-show" type="button"><i class="icon fa fa-eye"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Hak Akses</label>
                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="form-group">
                                <select class="form-control input-sm" name="">
                                    <option value="1">Manajer</option>
                                    <option value="2">Service Advisor</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="ibox-footer text-right">
                    <button type="button" class="btn btn-primary">Simpan Data</button>
                    <a href="{{route('pengguna')}}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_script')
<script type="text/javascript">
    $('#btn-show').click(function(){
        var tuwek = $(this).parents('.input-group');
        var input = tuwek.find('input');

        input.attr('type', function(index, attr){
            var icon = $(this).find('i');

            attr == 'password' ? $('.icon').removeClass('fa-eye').addClass('fa-eye-slash') : $('.icon').removeClass('fa-eye-slash').addClass('fa-eye');

            return attr == 'password' ? 'text' : 'password';
        });

    })
</script>
@endsection
