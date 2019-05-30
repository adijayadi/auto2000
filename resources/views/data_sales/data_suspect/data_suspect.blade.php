@extends('main')
@section('extra_style')
<style type="text/css">
    
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Data Suspect</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Manajemen Service Advisor</a>
            </li>
            <li class="active">
                <strong>Data Suspect</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Data Suspect</h5>
                    {{-- <div class="ibox-tools">
                        <button class="btn btn-warning btn-sm" title="Ganti Service Advisor yang sudah tidak aktif" data-toggle="modal" data-target="#modal-ganti-semua">
                            <i class="fa fa-edit"></i>
                            Ganti Service Advisor
                        </button>
                    </div> --}}
                </div>
                <div class="ibox-content">

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
