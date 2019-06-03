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

                                <tr>
                                    <td>
                                        <input type="checkbox" name="centang-followup" value="1">
                                    </td>
                                    <td>2018-10-01</td>
                                    <td>MHFM1BA2JBK035948</td>
                                    <td>B1295PKO</td>
                                    <td>AVANZA</td>
                                    <td>Service 10.000 Kilometer</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="centang-followup" value="2">
                                    </td>
                                    <td>2018-10-01</td>
                                    <td>MR053AK50E4506151</td>
                                    <td>L3PY</td>
                                    <td>CAMRY</td>
                                    <td> Service 50.000 Kilometer </td>
                                </tr>

                                <tr>
                                    <td>
                                        <input type="checkbox" name="centang-followup" value="3">
                                    </td>
                                    <td>2018-10-01</td>
                                    <td>MHKM1BA2JDK041994</td>
                                    <td>B1182BYK</td>
                                    <td>AVANZA</td>
                                    <td> Service 90.000 kilometer </td>
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

    $('#table_kendaraan tbody > tr').click(function(e){
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
