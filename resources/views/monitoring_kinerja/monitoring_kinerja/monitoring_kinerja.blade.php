@if(Auth::user()->u_user != 'A')
<script type="text/javascript">window.location.href="{{route('home')}}";</script>
@endif
@extends('main')
@section('extra_style')
<style type="text/css">
    
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Monitoring Tindakan Service Advisor</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <span>Pengelolaan Penugasan Service Advisor</span>
            </li>
            <li class="active">
                <strong>Monitoring Tindakan Service Advisor</strong>
            </li>
        </ol>
    </div>
</div>

@include('monitoring_kinerja.monitoring_kinerja.detail_monitoring')
@include('monitoring_kinerja.monitoring_kinerja.detail_tindakan')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1"><i class="fa fa-desktop"></i> <span class="tab-title">Monitoring Tindakan Service Advisor</span></a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-2"><i class="fa fa-history"></i> <span class="tab-title">Log Service Advisor</span></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane animated fadeIn active">
                        <div class="ibox">
                            <div class="ibox-content">

                                <div class="row">

                                     <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <label>Periode Bulan</label>
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

                                        <div class="form-group">
                                            <div class="input-group input-daterange">
                                                <input type="text" class="form-control input-sm" id="tanggal1" name="">
                                                <span class="input-group-addon">ke</span>
                                                <input type="text" class="form-control input-sm" id="tanggal2" name="">
                                            </div>
                                        </div>

                                    </div> 
                                    {{-- 
                                    <div class="col-lg-4 col-md-2 col-sm-12 col-xs-12">
                                        <div class="form-group text-center">
                                        </div>
                                    </div> --}}

                                </div>

                                <div class="table-responsive-x">
                                    <table style="width: 100%;" class="table table-striped table-bordered table-hover" id="table_pengguna">
                                        <thead>
                                            <tr>
                                                <th width="1%">No.</th>
                                                <th>Nama Service Advisor</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane animated fadeIn">
                        <div class="ibox">
                            <div class="ibox-content">

                                
                                    <table style="width: 100%;" class="table table-striped table-bordered table-hover" id="table_log">
                                        <thead>
                                            <tr>
                                                <th width="1%">No.</th>
                                                <th>Nama Service Advisor</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
@endsection

@section('extra_script')
<script type="text/javascript">
    $(document).ready(function(){
        $.fn.dataTable.ext.errMode = 'none';
        $(document).on('click','.list',function(){
            var serviceadv = $(this).data('serviceadv');
            var names = $(this).data('nama');
            console.log(names);
            $('#staff').html(names);
            $('#list').DataTable();
            $.ajax({
                url : '{{route("gdata.monitoring")}}',
                type : 'POST',
                dataType:'json',
                data: {
                    '_token' :'{{csrf_token()}}',
                    '_method' :'PUT',
                    'adv' : serviceadv,
                    'tanggal1' : $('#tanggal1').val(),
                    'tanggal2' : $('#tanggal2').val(),
                },
                success: function(get){
                        console.log(get);
                    $('#satu').html(' ');
                    $('#dua').html(' ');
                    $('#tiga').html(' ');
                    $('#empat').html(' ');
                    $('#lima').html(' ');
                    
                    setTimeout(function(){
                        $('#satu').html(get['satu']);
                        $('#dua').html(get['dua']);
                        $('#tiga').html(get['tiga']);
                        $('#empat').html(get['empat']);
                        $('#lima').html(get['lima']);
                    },300)
                }
            })
        })

        $(document).on('click','.listlog',function(){
            var serviceadv = $(this).data('serviceadv');
            var names = $(this).data('nama');
            $('#staff').html(names);
            var code = $(this).data('serviceadv');
                $('#log').DataTable({
                responsive: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    url: "{{ route('log.monitoring') }}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'code' : code,
                    }
                },
                order : [[1,'desc']],
                columns : [
                {data: 'DT_RowIndex'},
                {data : 'tanggal' , name : 'tanggal'},
                {data : 'kendaraan' , name : 'kendaraan'},
                {data : 'rf_reason' , name : 'rf_reason'},

                ],
                pageLength: 10,
                lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
            });
        })

        $('#table_pengguna').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            ajax : {
                url: "{{ route('table.monitoring') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                }
            },
            columns : [
            {data: 'DT_RowIndex'},
            {data : 'u_name' , name : 'u_name'},
            {data : 'action' , name : 'action'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });


        $('#table_log').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            ajax : {
                url: "{{ route('tablelog.monitoring') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                }
            },
            columns : [
            {data: 'DT_RowIndex'},
            {data : 'u_name' , name : 'u_name'},
            {data : 'action' , name : 'action'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });

        $('.input-daterange').datepicker();

    });
</script>
@endsection
