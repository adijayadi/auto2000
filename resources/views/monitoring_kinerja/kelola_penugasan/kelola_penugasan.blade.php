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
                                        <button type="button" class="btn btn-primary btn-sm" id="btn-buatrencana">
                                            <i class="fa fa-user-edit"></i>
                                            Buat Rencana
                                        </button>
                                    </div>
                                </div>

                            <form id="addservice">
                                @csrf
                                <input type="hidden" id="addcountservice" name="pcount">
                                <div class="ibox-content">

                                    <div class="row">
                                        <label class="col-lg-2 col-md-4 col-sm-12 col-xs-12 mt-2">Tipe Pekerjaan</label>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <select class="form-control input-sm" id="type_pekerjaan">
                                                    <option value="">~ Semua ~</option>
                                                    <option>Service</option>
                                                    <option>Periodic Maintenance</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                                            <div class="text-right mb-3">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-primary" type="button" id="btn-checkall-1">Check All</button>
                                                    <button class="btn btn-default" type="button" id="btn-uncheckall-1">Uncheck All</button>
                                                    <button class="btn btn-info" type="button" id="btn-interval-1">Check Interval</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover table-sticky" id="table_kelola" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th width="1%"></th>
                                                    <th width="10%">Tanggal Service</th>
                                                    <th>No. Rangka</th>
                                                    <th>No. Polisi</th>
                                                    <th>Tipe Kendaraan</th>
                                                    <th>Tipe Pekerjaan</th>
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

                            <h1>Total per Tipe Pekerjaan</h1>

                            <div class="row">

                                @if(count($total) != 0)
                                    @for($i = 0;$i<count($total);$i++)
                                        @php
                                            $a=array(
                                                'purple-bg',
                                                'white-bg',
                                                'navy-bg',
                                                'blue-bg',
                                                'lazur-bg',
                                                'yellow-bg',
                                                'red-bg',
                                                'black-bg'
                                            );
                                            $b = range(0, 8);
                                            $random_keys=array_rand($a,8);
                                        @endphp
                                        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

                                            <div class="widget style1 {{$a[array_rand($a)]}}">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <i class="fa fa-cog fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-8 text-right">
                                                        <span> {{$total[$i]->c_jobdesc}} </span>
                                                        <h2 class="font-bold total_per_pekerjaan">{{$total[$i]->total}}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    <div class="col-xs-12">
                                        <div class="widget white-bg style1">
                                            <h2 class="text-center">Tidak Ada Data</h2>
                                        </div>
                                    </div>
                                @endif
                                
                            </div>
                                    

                    </div>

                    <div id="tab-2" class="tab-pane animated fadeIn">

                        <div class="ibox">
                            <div class="ibox-title">
                                {{-- <h5>Kelola Penugasan</h5> --}}
                                <div class="ibox-tools">
                                    <button class="btn btn-warning btn-sm" title="Ganti Service Advisor yang sudah tidak aktif" id="btn-gantiadvisor">
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
                                                            <option value="{{$row->u_code}}">{{$row->u_name}}</option>
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
                                                    <th>Tipe Kendaraan</th>
                                                    <th>Tipe Pekerjaan</th>
                                                    <th>Service Advisor</th>
                                                    <th>Status Follow up</th>
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
        $('#btn-buatrencana').click(function(){
            if ($('#table_kelola tbody tr [type="checkbox"]').is(':checked') == false ) {
                iziToast.warning({
                    title:'Peringatan!',
                    message:'Centang minimal satu data!'
                });
            } else {
                $('#modal-kelola').modal('show');
            }
        });
        $('#btn-gantiadvisor').click(function(){
            if ($('#table_kendaraan tbody tr [type="checkbox"]').is(':checked') == false ) {
                iziToast.warning({
                    title:'Peringatan!',
                    message:'Centang minimal satu data!'
                });
            } else {
                $('#modal-ganti-satu').modal('show');
            }
        });
        $.fn.dataTable.ext.errMode = 'none';
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
                        $('.close').click();
                        table.ajax.reload();
                        table2.ajax.reload();
                    } 
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.error({
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
                url: "{{ route('tableganti.penugasan') }}",
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
            {data : 'c_nameadvisor' , name : 'c_nameadvisor'},
            {data : 'fu_status' , name : 'fu_status'},

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
                        table.ajax.reload();
                        table2.ajax.reload();
                        $('modal-ganti-satu').modal('hide');
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
                            $('.close').click();
                }
            })

        })

        var table = $('#table_kendaraan').DataTable({
            responsive: true,
            serverSide: false,
            destroy: true,
            ajax : {
                url: "{{ route('tableganti.penugasan') }}",
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
            {data : 'c_nameadvisor' , name : 'c_nameadvisor'},
            {data : 'fu_status' , name : 'fu_status'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });

        $('#type_pekerjaan').on( 'change', function () {
            table2
                .columns( 5 )
                .search( this.value )
                .draw();
        } );

        var table2 = $('#table_kelola').DataTable({
            responsive: true,
            serverSide: false,
            destroy: true,
            ajax : {
                url: "{{ route('tablec.penugasan') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            order : [[1,'desc'],[5,'desc']],
            columns : [
            {data : 'check' , name : 'check'},
            {data : 'c_dateservice' , name : 'c_dateservice'},
            {data : 'serial' , name : 'serial'},
            {data : 'c_plate' , name : 'c_plate'},
            {data : 'c_typecar' , name : 'c_typecar'},
            {data : 'c_jobdesc' , name : 'c_jobdesc'},
            {data : 'c_nameadvisor' , name : 'c_nameadvisor'},

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

        $('#table_kelola tbody').on('click', 'tr',function(e){
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

        $('.widget').each(function(){
            var total =$(this).find('.total_per_pekerjaan');
            if (parseInt(total.text()) < 100) {
                counterNum(total,0,parseInt(total.text()), 1, parseInt(total.text()));
            } else if (parseInt(total.text()) > 100) {
                counterNum(total,0,parseInt(total.text()), 1, parseInt(total.text()) / 10);
            } else if (parseInt(total.text()) > 1000){
                counterNum(total,0,parseInt(total.text()), 1, parseInt(total.text()) / 100);
            } else {
                counterNum(total,0,parseInt(total.text()), 1, parseInt(total.text()) / 10000);
            }
        });

        function counterNum(obj, start, end, step, duration) {
            $(obj).html(start);
            setInterval(function(){
                var val = Number($(obj).html());
                if (val < end) {
                    $(obj).html(val+step);
                } else {
                    clearInterval();
                }
            },duration);
        }

        
    });
</script>
@endsection
