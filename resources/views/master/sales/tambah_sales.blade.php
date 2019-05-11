@extends('main')
@section('extra_style')
<style type="text/css">
    /*Ini Extra Style*/
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tambah Sales Account</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Master</a>
            </li>
            <li>
                <a href="{{route('sales')}}">Master Sales Account</a>
            </li>
            <li class="active">
                <strong>Tambah Sales Account</strong>
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
                    <h5>Tambah Sales Account</h5>
                    <div class="ibox-tools">
                        <a href="{{route('sales')}}" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                            <label>Nama sales</label>
                        </div>

                        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="">
                            </div>
                        </div>

                    </div>



                </div>

                <div class="ibox-footer text-right">
                    <button type="button" class="btn btn-primary">Simpan Data</button>
                    <a href="{{route('sales')}}" class="btn btn-default">Kembali</a>
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
