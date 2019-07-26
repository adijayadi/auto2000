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
        <h2>Master Kendaraan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Master</a>
            </li>
            <li class="active">
                <strong>Master Kendaraan</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Master Kendaraan</h5>
                    <div class="ibox-tools">
                    <a href="{{route('tambah_kendaraan')}}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>
                            Tambah Data Kendaraan
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table_kendaraan">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th>No Plat Kendaraan</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Nama Pemilik</th>
                                    <th>No HP</th>
                                    <th>E-mail</th>
                                    <th width="24%">Alamat</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>W 1234 W</td>
                                    <td>Pajero</td>
                                    <td>Alpha</td>
                                    <td>+6285331219757</td>
                                    <td>alpha@alpha.com</td>
                                    <td>Jl. Alpha</td>
                                    <td align="center">
                                        
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
        $.fn.dataTable.ext.errMode = 'none';
        var table = $('#table_kendaraan').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            ajax : {
                url: "{{ route('table.kendaraan') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            columns : [
            {data: 'DT_RowIndex'},
            {data : 'v_plate' , name : 'v_plate'},
            {data : 'v_namecar' , name : 'v_namecar'},
            {data : 'v_owner' , name : 'v_owner'},
            {data : 'v_nphone' , name : 'v_nphone'},
            {data : 'v_email' , name : 'v_email'},
            {data : 'v_address' , name : 'v_address'},
            {data : 'action' , name : 'action'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });

        $(document).on('click','.delete',function(){
            swal({
                title: "Apa anda yakin?",
                text: "Data akan dihapus permanent!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak!",
                closeOnConfirm: true,
                closeOnCancel: true 
            },
            function (isConfirm) {
                if(isConfirm){
                deletee();
                }
            });

            var id = $(this).data('id');
             function deletee(){
                $.ajax({
                url : '{{route("delete.kendaraan")}}',
                type : 'POST',
                data : { '_token' : '{{csrf_token()}}' ,'id' : id},
                success:function(){
                    iziToast.success({
                        title:'Berhasil!',
                        message:'Menghapus!'
                    });

                    table.ajax.reload();
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.error({
                                title: 'Gagal!',
                                message: 'Menghapus',
                        });
                    },
                });
            }
        })

    });
</script>
@endsection
