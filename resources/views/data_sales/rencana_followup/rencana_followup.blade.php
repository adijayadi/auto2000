@extends('main')
@section('extra_style')
<style type="text/css">
    #table_kendaraan > tbody > tr {
        cursor: pointer;
    }    
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Rencana Follow Up</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Manajemen Service Advisor</a>
            </li>
            <li class="active">
                <strong>Rencana Follow Up</strong>
            </li>
        </ol>
    </div>
</div>


@include('data_sales.rencana_followup.modal_tindakan')
@include('data_sales.rencana_followup.modal_tindakan_2')

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
                            {{-- 
                            <div class="ibox-title">
                                <h5>Manajemen Tindakan Customer</h5>
                            </div> --}}
                            <div class="ibox-content">

                                <div class="table-responsive">
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
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane animated fadeIn">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">

                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="table_tindakan_2" style="width: 100%">
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
        $(document).on('click','.ubah',function(){
            var id = $(this).data('id');
            $('#id').val('');
            $('#id2').val('');
            $('#id').val(id);

        })

        $(document).on('click','.ubah2',function(){
            var id = $(this).data('id');
            $('#id').val('');
            $('#id2').val('');
            $('#id2').val(id);

        })

        $('#fu1').on('click',function(){
            var form = $('#form_tindakan').serialize();
            $.ajax({
                url : '{{route("update.follow")}}',
                type : 'POST',
                data : form,
                success:function(){
                    iziToast.success({
                        title:'Berhasil!',
                        message:'Follow Up Selesai!'
                    });

                    setTimeout(function(){
                        $('#detail_tindakan').modal('hide');

                        table.ajax.reload();
                        table2.ajax.reload();
                    },500);
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.error({
                                title: 'Gagal!',
                                message: 'Ada yang Kosong',
                    });
                },
            })
        })

        $('#fu2').on('click',function(){
            var form2 = $('#form_tindakan2').serialize();
            $.ajax({
                url : '{{route("update.follow")}}',
                type : 'POST',
                data : form2,
                success:function(){
                    iziToast.success({
                        title:'Berhasil!',
                        message:'Follow Up di Selesai!'
                    });

                    setTimeout(function(){
                        $('#detail_tindakan_2').modal('hide');
                        table2.ajax.reload();
                        table.ajax.reload();
                    },500);
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.error({
                                title: 'Gagal!',
                                message: 'Ada yang Kosong',
                    });
                },
            })
        })

        var table2 = $('#table_tindakan_2').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            ajax : {
                url: "{{ route('tablere.follow') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            columns : [
            {data : 'DT_RowIndex'},
            {data : 'tanggal_rencana' , name : 'tanggal_rencana'},
            {data : 'c_plate' , name : 'c_plate'},
            {data : 'v_owner' , name : 'v_owner'},
            {data : 'status_service' , name : 'status_service'},
            {data : 'status' , name : 'status'},
            {data : 'action' , name : 'action'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });

        var table = $('#table_tindakan').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            ajax : {
                url: "{{ route('table.follow') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            columns : [
            {data : 'DT_RowIndex'},
            {data : 'tanggal_rencana' , name : 'tanggal_rencana'},
            {data : 'fu_plantime' , name : 'fu_plantime'},
            {data : 'c_plate' , name : 'c_plate'},
            {data : 'v_owner' , name : 'v_owner'},
            {data : 'status_service' , name : 'status_service'},
            {data : 'status' , name : 'status'},
            {data : 'action' , name : 'action'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });
        
        $('[name="tanggalrefollowup"]').datepicker({
            format:'dd-mm-yyyy',
            startDate:'0',
        });
        $('[name="tanggalbooking"]').datepicker({
            format:'dd-mm-yyyy',
            startDate:'0',
        });
        $('[name="tanggalbooking2"]').datepicker({
            format:'dd-mm-yyyy',
            startDate:'0',
        });
    });

    $('select[name="tindakan"]').change(function(){
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

        $('select[name="tindakan-2"]').change(function(){
        if ($(this).val() === 'ya') {
            $('#tab-modal-2-1').show();
            $('#tab-modal-2-2').hide();
            $('#tab-modal-2-3').hide();
            // console.log('a');

        } else if ($(this).val() === 'ntar'){
            $('#tab-modal-2-2').show();
            $('#tab-modal-2-1').hide();
            $('#tab-modal-2-3').hide();
            // console.log('b');
        } else if ($(this).val() === 'tidak'){
            $('#tab-modal-2-3').show();
            $('#tab-modal-2-2').hide();
            $('#tab-modal-2-1').hide();
            // console.log('c');
        }
        

    })
</script>
@endsection
