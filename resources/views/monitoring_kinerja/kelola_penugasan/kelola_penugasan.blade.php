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
@include('monitoring_kinerja.kelola_penugasan.modal_kelola')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
             <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1"><i class="fa fa-tasks"></i> <span class="tab-title">Kelola Penugasan</span></a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-2"><i class="fa fa-edit"></i> <span class="tab-title">Ganti Service Advisor</span></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane animated fadeIn active">
                            <div class="ibox">

                                <div class="ibox-title">
                                    <div class="ibox-tools">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-kelola">
                                            <i class="fa fa-user-edit"></i>
                                            Buat Rencana
                                        </button>
                                    </div>
                                </div>

                            <form id="addservice">
                                @csrf
                                <input type="hidden" id="addcountservice" name="pcount">
                                <div class="ibox-content">

                                    <div class="text-right mb-3">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-primary" type="button" id="btn-checkall-1">Check All</button>
                                            <button class="btn btn-default" type="button" id="btn-uncheckall-1">Uncheck All</button>
                                            <button class="btn btn-info" type="button" id="btn-interval-1">Check Interval</button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="table_kelola" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th width="1%"></th>
                                                    <th width="10%">Tanggal Service</th>
                                                    <th>No. Rangka</th>
                                                    <th>No. Polisi</th>
                                                    <th>Type Kendaraan</th>
                                                    <th>Type Pekerjaan</th>
                                                    <th>Service Advisor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </form>
                                
                            </div>

                    </div>

                    <div id="tab-2" class="tab-pane animated fadeIn">

                        <div class="ibox">
                            <div class="ibox-title">
                                {{-- <h5>Kelola Penugasan</h5> --}}
                                <div class="ibox-tools">
                                    <button class="btn btn-warning btn-sm" title="Ganti Service Advisor yang sudah tidak aktif" data-toggle="modal" data-target="#modal-ganti-satu">
                                        <i class="fa fa-edit"></i>
                                        Ganti Service Advisor yang dicentang
                                    </button>
                                </div>
                            </div>
                            <form id="gantiservice">
                                @csrf
                                <input type="hidden" id="gantiservicelength" name="scount">
                                <div class="ibox-content">
                                    <fieldset>
                                        <div class="row">
                                            
                                            <div class="col-sm-4 col-xs-12">
                                                <label>Service Advisor</label>
                                            </div>

                                            <div class="col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">
                                                        <select class="form-control input-sm select2" id="selectservice" name="">
                                                            <option value="" hidden>~ Pilih Service Advisor ~</option>
                                                            @foreach($advisor as $row)
                                                            <option value="{{$row->u_name}}">{{$row->u_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-primary" id="seachservice" type="button" id="btn-cari"><i class="fa fa-search"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </fieldset>

                                    <div class="text-right mb-3">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-primary" type="button" id="btn-checkall-2">Check All</button>
                                            <button class="btn btn-default" type="button" id="btn-uncheckall-2">Uncheck All</button>
                                            <button class="btn btn-info" type="button" id="btn-interval-2">Check Interval</button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="table_kendaraan">
                                            <thead>
                                                <tr>
                                                    <th width="1%"></th>
                                                    <th width="10%">Tanggal Service</th>
                                                    <th>No. Rangka</th>
                                                    <th>No. Polisi</th>
                                                    <th>Type Kendaraan</th>
                                                    <th>Type Pekerjaan</th>
                                                    <th>Service Advisor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </form>
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
        $('#saveplan').on('click',function(){
            var form = $('#addservice').serialize();
            var form2 =  $('#kelola_form').serialize();
            $.ajax({
                url : '{{route("addplan.penugasan")}}',
                type : 'POST',
                data : form +'&'+form2,
                success:function(get){
                    if (get['error'] == 'Mohon Import Data') {
                        iziToast.error({
                                    title: 'Gagal!',
                                    message: 'Mohon Import Data',
                        });
                    }else{
                        iziToast.success({
                            title: 'Berhasil!',
                            message: 'Menyimpan Data',
                        });
                        window.location.reload();
                    } 
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.show({
                                color: '#DC143C',
                                titleColor: '#ffffff',
                                messageColor: '#ffffff',
                                title: 'Gagal!',
                                message: 'Menyimpan Data',
                    });
                }
            })
        })

        $('#seachservice').on('click',function(){
            var search = $('#selectservice').val();
            var table22 = $('#table_kendaraan').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            ajax : {
                url: "{{ route('filtertablec.penugasan') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'serviceadv' : search,
                }
            },
            columns : [
            {data : 'check' , name : 'check'},
            {data : 'c_dateservice' , name : 'c_dateservice'},
            {data : 'serial' , name : 'serial'},
            {data : 'c_plate' , name : 'c_plate'},
            {data : 'c_typecar' , name : 'c_typecar'},
            {data : 'c_jobdesc' , name : 'c_jobdesc'},
            {data : 'c_serviceadvisor' , name : 'c_serviceadvisor'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });
        })

        $('#gantib').on('click',function(){
            var form3 = $('#gantiservice').serialize();
            var form4 =  $('#modaladv').serialize();
            var up = $('.table-checked').length;

            $.ajax({
                url : '{{route("updateadv.penugasan")}}',
                type : 'POST',
                data : form3 +'&'+form4,
                success:function(get){
                    console.log(up);
                    if (get['error'] == 'Mohon Import Data') {
                        iziToast.error({
                                    title: 'Gagal!',
                                    message: 'Mohon Import Data',
                        });

                    }else{
                        iziToast.success({
                            title: 'Berhasil!',
                            message: 'Menyimpan Data',
                        });
                        window.location.reload();
                    } 
                    
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.show({
                                color: '#DC143C',
                                titleColor: '#ffffff',
                                messageColor: '#ffffff',
                                title: 'Gagal!',
                                message: 'Menyimpan Data',
                    });
                }
            })

        })

        var table = $('#table_kendaraan').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            ajax : {
                url: "{{ route('tablec.penugasan') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            columns : [
            {data : 'check' , name : 'check'},
            {data : 'c_dateservice' , name : 'c_dateservice'},
            {data : 'serial' , name : 'serial'},
            {data : 'c_plate' , name : 'c_plate'},
            {data : 'c_typecar' , name : 'c_typecar'},
            {data : 'c_jobdesc' , name : 'c_jobdesc'},
            {data : 'c_serviceadvisor' , name : 'c_serviceadvisor'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });

        var table2 = $('#table_kelola').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            ajax : {
                url: "{{ route('tablec.penugasan') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            columns : [
            {data : 'check' , name : 'check'},
            {data : 'c_dateservice' , name : 'c_dateservice'},
            {data : 'serial' , name : 'serial'},
            {data : 'c_plate' , name : 'c_plate'},
            {data : 'c_typecar' , name : 'c_typecar'},
            {data : 'c_jobdesc' , name : 'c_jobdesc'},
            {data : 'c_serviceadvisor' , name : 'c_serviceadvisor'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });


        $('#btn-checkall-2').click(function(){
            $('#table_kendaraan tbody [type="checkbox"]').prop('checked', true).parents('tr').addClass('table-checked');
            var upp = $('.table-checked').length;
             $('#gantiservicelength').val(upp);
        });

        $('#btn-uncheckall-2').click(function(){
            $('#table_kendaraan tbody [type="checkbox"]').prop('checked', false).parents('tr').removeClass('table-checked');
            var upp = $('.table-checked').length;
             $('#gantiservicelength').val(upp);
        });

        $('#btn-interval-2').click(function(){
            var table = $('#table_kendaraan tbody [type="checkbox"]');
            var count = table.length;
            var range = [];
            for(var i = 0; i<count;i++){
                if (table.eq(i).is(':checked')) {
                    range.push(i);
                }
            }
            console.log(range);
            var range_l = range.length - 1;
            var start = range[0];
            var end = range[range_l];
            console.log(range_l, start, end);
            for(var j = start; j<end;  j++){
                table.eq(j).prop('checked', true).parents('tr').addClass('table-checked');
            }
            var upp = $('.table-checked').length;
             $('#gantiservicelength').val(upp);
        })

        $('#table_kendaraan tbody').on('click', 'tr',function(e){
            // console.log(e);

            $(':checkbox' ,this).prop('checked', function(index, prop){

                return prop == true ? false : true;
            });

            if($(':checkbox', this).is(':checked')){
                $(this).addClass('table-checked');
                console.log('a');
                var up = $('.table-checked').length;
                $('#gantiservicelength').val(up);
            } else {
                $(this).removeClass('table-checked');
                console.log('b');
                var up = $('.table-checked').length;
                $('#gantiservicelength').val(up);
            }

        });

        $('#btn-checkall-1').click(function(){
            $('#table_kelola tbody [type="checkbox"]').prop('checked', true).parents('tr').addClass('table-checked');
             var upp = $('.table-checked').length;
                $('#addcountservice').val(upp);
        });
        $('#btn-uncheckall-1').click(function(){
            $('#table_kelola tbody [type="checkbox"]').prop('checked', false).parents('tr').removeClass('table-checked');
             var upp = $('.table-checked').length;
                $('#addcountservice').val(upp);
        });

        $('#btn-interval-1').click(function(){
            var table = $('#table_kelola tbody [type="checkbox"]');
            var count = table.length;
            var range = [];
            for(var i = 0; i<count;i++){
                if (table.eq(i).is(':checked')) {
                    range.push(i);
                }
            }
            console.log(range);
            var range_l = range.length - 1;
            var start = range[0];
            var end = range[range_l];
            console.log(range_l, start, end);
            for(var j = start; j<end;  j++){
                table.eq(j).prop('checked', true).parents('tr').addClass('table-checked');
            }
             var upp = $('.table-checked').length;
                $('#addcountservice').val(upp);
        })

        
    });
</script>
@endsection
