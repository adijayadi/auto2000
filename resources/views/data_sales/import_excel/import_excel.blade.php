@extends('main')
@section('extra_style')
<style type="text/css">
    
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Manajemen Import Data</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <span>Pengelolaan Data Sales Account</span>
            </li>
            <li class="active">
                <strong>Manajemen Import Data</strong>
            </li>
        </ol>
    </div>
</div>

@include('data_sales.import_excel.crosscheck')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manajemen Import Data</h5>
                    <div class="ibox-tools">
                        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-file-excel"></i> Contoh Format Excel</button>
                        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-file-excel"></i> Import Excel</button>

                    </div>
                </div>
                <div class="ibox-content">
                    <h2>Data dari Import Excel</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table_upload">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th>Tanggal</th>
                                    <th>No. Kendaraan</th>
                                    <th>Nama Pemilik</th>
                                    <th>Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <h2>Data dari Database</h2>
                    <hr>

                    <div class="row">
                        
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <label>Periode Bulan</label>
                                    </div>

                                    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">

                                        <div class="form-group">


                                            <div class="input-group input-daterange">
                                                <input type="text" class="form-control input-sm" name="">
                                                <span class="input-group-addon">-</span>
                                                <input type="text" class="form-control input-sm" name="">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-search"></i> Cari</button>
                                                </span>
                                            </div>
                                            
                                        </div>

                                    </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table_db">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th>Tanggal</th>
                                    <th>No. Kendaraan</th>
                                    <th>Nama Pemilik</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>11 Mei 2019</td>
                                    <td>W 1234 W</td>
                                    <td>Alpha</td>
                                    <td>Pernah Service</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="ibox-footer text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#crosscheck" type="button">Cross Check Data</button>
                </div>
            </div>          
        </div>
    </div>
</div>
@endsection

@section('extra_script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#table_db').DataTable();
        $('#table_upload').DataTable({
            "language": {
                "emptyTable": "Menunggu data dari import excel"
            }
        });

        $('.input-daterange').datepicker();
    });
</script>
@endsection
