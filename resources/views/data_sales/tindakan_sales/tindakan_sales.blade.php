@extends('main')
@section('extra_style')
<style type="text/css">
    
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Manajemen Tindakan Customer</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <span>Pengelolaan Data Customer</span>
            </li>
            <li class="active">
                <strong>Manajemen Tindakan Customer</strong>
            </li>
        </ol>
    </div>
</div>

@include('data_sales.tindakan_sales.modal_tindakan')
@include('data_sales.tindakan_sales.modal_tindakan_2')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1"><i class="fa fa-dice-one"></i> <span class="tab-title">Follow Up 1</span></a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-2"><i class="fa fa-dice-two"></i> <span class="tab-title">Follow Up 2</span></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane animated fadeIn active">
                        <div class="ibox float-e-margins">

                            <div class="ibox-title">
                                <h5>Manajemen Tindakan Customer</h5>
                            </div>
                            <div class="ibox-content">

                                <div class="table-responsive-x">
                                    <table class="table table-striped table-bordered table-hover" id="table_tindakan">
                                        <thead>
                                            <tr>
                                                <th width="1%">No.</th>
                                                <th>Tanggal Difollow Up</th>
                                                <th>Jam Difollow Up</th>
                                                <th>No. Kendaraan</th>
                                                <th>Nama Pemilik</th>
                                                <th>Status Service</th>
                                                <th>Status Follow Up</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>11 Mei 2019</td>
                                                <td>08:00</td>
                                                <td>W 1234 W</td>
                                                <td>Alpha</td>
                                                <td align="center">Pernah Service</td>
                                                <td align="center">No. Kendaraan Yang Belum Di Follow Up</td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detail_tindakan" title="Tindakan"><i class="fa fa-cog"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane animated fadeIn">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">

                                
                                <div class="table-responsive-x">
                                    <table class="table table-striped table-bordered table-hover" id="table_tindakan_2">
                                        <thead>
                                            <tr>
                                                <th width="1%">No.</th>
                                                <th>Tanggal Difollow Up</th>
                                                <th>No. Kendaraan</th>
                                                <th>Nama Pemilik</th>
                                                <th>Status Service</th>
                                                <th>Status Follow Up</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>11 Mei 2019 08:00</td>
                                                <td>W 4321 W</td>
                                                <td>Bravo</td>
                                                <td align="center">Pernah Service</td>
                                                <td align="center">No. Kendaraan Yang Harus Di Follow Up</td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detail_tindakan_2" title="Tindakan"><i class="fa fa-cog"></i></button>
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

        </div>
    </div>
</div>
@endsection

@section('extra_script')
<script type="text/javascript">
    $(document).ready(function(){
        $.fn.dataTable.ext.errMode = 'none';
        $('#table_tindakan').DataTable();
        $('#table_tindakan_2').DataTable();

        $('.input-daterange').datepicker();
    });

    $('select[name="tindakan-1"]').change(function(){
        if ($(this).val() === 'ya') {
            $('#tab-modal-1').show();
            $('#tab-modal-2').hide();
            $('#tab-modal-3').hide();
            // console.log('a');

        } else if ($(this).val() === 'ntar'){
            $('#tab-modal-2').show();
            $('#tab-modal-1').hide();
            $('#tab-modal-3').hide();
            // console.log('b');
        } else if ($(this).val() === 'tidak'){
            $('#tab-modal-3').show();
            $('#tab-modal-2').hide();
            $('#tab-modal-1').hide();
            // console.log('c');
        }
        
    })
</script>
@endsection
