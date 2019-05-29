@extends('main')
@section('extra_style')
<style type="text/css">
    
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Kelola Penugasan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Manajemen Data & Penugasan</a>
            </li>
            <li class="active">
                <strong>Kelola Penugasan</strong>
            </li>
        </ol>
    </div>
</div>

@include('monitoring_kinerja.kelola_penugasan.modal_gantiserviceadvisor')
@include('monitoring_kinerja.kelola_penugasan.modal_gantiserviceadvisor_semua')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Kelola Penugasan</h5>
                    <div class="ibox-tools">
                        <button class="btn btn-warning btn-sm" title="Ganti Service Advisor yang sudah tidak aktif" data-toggle="modal" data-target="#modal-ganti-semua">
                            <i class="fa fa-edit"></i>
                            Ganti Service Advisor
                        </button>
                    </div>
                </div>
                <div class="ibox-content">
                    <fieldset>
                        <div class="row">
                            
                            <div class="col-sm-4 col-xs-12">
                                <label>Service Advisor</label>
                            </div>

                            <div class="col-sm-8 col-xs-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                        <select class="form-control input-sm select2" name="">
                                            <option value="">~ Pilih Service Advisor ~</option>
                                        </select>
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary" type="button" id="btn-cari"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </fieldset>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table_kendaraan">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th width="10%">Tanggal Service</th>
                                    <th>No. Rangka</th>
                                    <th>No. Polisi</th>
                                    <th>Type Kendaraan</th>
                                    <th>Type Pekerjaan</th>
                                    <th>Service Advisor</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>2018-10-01</td>
                                    <td>MHFM1BA2JBK035948</td>
                                    <td>B1295PKO</td>
                                    <td>AVANZA</td>
                                    <td>Service 10.000 Kilometer</td>
                                    <td>Achmad Nur Taufik</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" title="Ganti Service Advisor per no. rangka" data-toggle="modal" data-target="#modal-ganti-satu">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>          
        </div>
    </div>
</div>
@endsection

@section('extra_script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#table_kendaraan').DataTable();


    });
</script>
@endsection
