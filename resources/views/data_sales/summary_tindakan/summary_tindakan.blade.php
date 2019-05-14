@extends('main')
@section('extra_style')
<style type="text/css">
    .d-block{
        display: block;
    }
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Manajemen Summary Tindakan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <span>Pengelolaan Data Customer</span>
            </li>
            <li class="active">
                <strong>Manajemen Summary Tindakan</strong>
            </li>
        </ol>
    </div>
</div>

@include('data_sales.summary_tindakan.detail_status')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manajemen Summary Tindakan</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table_summary">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th>Status Follow Up</th>
                                    <th width="1%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="center">1</td>
                                    <td><a class="d-block" href="#detail_status" data-toggle="modal">Daftar Kendaraan Telah Melakukan Service</a></td>
                                    <td align="center">0</td>
                                </tr>
                                <tr>
                                    <td align="center">2</td>
                                    <td><a class="d-block" href="#detail_status" data-toggle="modal">Daftar Kendaraan Yang Harus Di Follow Up</a></td>
                                    <td align="center">0</td>
                                </tr>
                                <tr>
                                    <td align="center">3</td>
                                    <td><a class="d-block" href="#detail_status" data-toggle="modal">Daftar Kendaraan Yang Telah Di Follow Up Dan Tidak Bersedia</a></td>
                                    <td align="center">0</td>
                                </tr>
                                <tr>
                                    <td align="center">4</td>
                                    <td><a class="d-block" href="#detail_status" data-toggle="modal">Daftar Kendaraan Yang Telah Di Follow Up Dan Bersedia Service</a></td>
                                    <td align="center">0</td>
                                </tr>
                                <tr>
                                    <td align="center">5</td>
                                    <td><a class="d-block" href="#detail_status" data-toggle="modal">Daftar Kendaraan Yang Telah Di Follow Up Dan Bersedia Service dan Telah Melakukan Booking</a></td>
                                    <td align="center">0</td>
                                </tr>
                                <tr>
                                    <td align="center">6</td>
                                    <td><a class="d-block" href="#detail_status" data-toggle="modal">Daftar Kendaraan Yang Telah Di Follow Up Dan Bersedia Service dan Belum Melakukan Booking</a></td>
                                    <td align="center">0</td>
                                </tr>
                                <tr>
                                    <td align="center">7</td>
                                    <td><a class="d-block" href="#detail_status" data-toggle="modal">Daftar Kendaraan Yang Belum Di Follow Up</a></td>
                                    <td align="center">0</td>
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
        $('#table_summary').DataTable();


        $('.input-daterange').datepicker();
    });
</script>
@endsection
