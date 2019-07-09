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
@include('data_sales.data_suspect.modal_followup')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Rencana Follow Up</h5>
                    <div class="ibox-tools">
                        <button class="btn btn-primary btn-sm" id="btn-modal" title="Follow Up yang dicentang" >
                            <i class="fa fa-calendar-alt"></i>
                            Follow Up yang dicentang
                        </button>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="text-right mb-3">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-primary" type="button" id="btn-checkall">Check All</button>
                            <button class="btn btn-default" type="button" id="btn-uncheckall">Uncheck All</button>
                            <button class="btn btn-info" type="button" id="btn-interval">Check Interval</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <form id="form_table">
                            @csrf
                            <input id="cout" type="hidden" name="cout">
                            <table class="table table-striped table-bordered table-hover" id="table_kendaraan">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="10%">Tanggal Service</th>
                                        <th>No. Rangka</th>
                                        <th>No. Polisi</th>
                                        <th>Type Kendaraan</th>
                                        <th>Type Pekerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </form>
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

        $('#btn-simpan').on('click',function(){
            var cout = $('.table-checked').length;
            $('#cout').val(cout);
            var form = $('#form_table').serialize() + '&' + $('#form_modal').serialize();
            $.ajax({
                url : '{{route("rencana.suspect")}}',
                type : 'POST',
                data : form,
                success:function(){
                    iziToast.success({
                        title:'Berhasil!',
                        message:'Rencana di Simpan!'
                    });

                    setTimeout(function(){
                        window.location.reload();
                    },500);
                }
            });
        });

        $('#table_kendaraan').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            ajax : {
                url: "{{ route('table.suspect') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            columns : [
            {data : 'check' , name : 'check'},
            {data : 'c_dateservice' , name : 'c_dateservice'},
            {data : 'c_serial' , name : 'c_serial'},
            {data : 'c_plate' , name : 'c_plate'},
            {data : 'c_typecar' , name : 'c_typecar'},
            {data : 'c_jobdesc' , name : 'c_jobdesc'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });


            

    });

    $('#btn-modal').click(function(){
        if ($('#table_kendaraan tbody tr [type="checkbox"]').is(':checked') == false ) {
            iziToast.warning({
                title:'Peringatan!',
                message:'Centang tidak boleh kosong!'
            });
        } else {
            $('#modal-follow-up').modal('show');
        }
    })

    $('#btn-checkall').click(function(){
        $('#table_kendaraan tbody [type="checkbox"]').prop('checked', true).parents('tr').addClass('table-checked');
    });
    $('#btn-uncheckall').click(function(){
        $('#table_kendaraan tbody [type="checkbox"]').prop('checked', false).parents('tr').removeClass('table-checked');
    });

    $('#table_kendaraan tbody').on('click','tr',function(e){
        // console.log(e);

        $(this).find('[type="checkbox"]').prop('checked', function(index, prop){

            return prop == true ? false : true;
        });

            if($(':checkbox', this).is(':checked')){
                $(this).addClass('table-checked');
                console.log('a');
            } else {
                $(this).removeClass('table-checked');
                console.log('b');

            }
    });

        $('#btn-interval').click(function(){
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
        })
</script>
@endsection
