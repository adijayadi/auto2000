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
        <h2>Master Alasan Tidak Lanjut</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Master</a>
            </li>
            <li class="active">
                <strong>Master Alasan Tidak Lanjut</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Master Alasan Tidak Lanjut</h5>
                    <div class="ibox-tools">
                    <a href="{{route('tambah_alasan')}}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive-x">
                        <table class="table table-striped table-bordered table-hover" id="table_alasan">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th>Alasan</th>
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
@endsection

@section('extra_script')
<script type="text/javascript">
    

    $(document).ready(function(){


        var table = $('#table_alasan').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            ajax : {
                url: "{{ route('alasan.table') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            columns : [
            {data: 'DT_RowIndex'},
            {data : 'r_reason' , name : 'r_reason'},
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
                url : '{{route("delete.alasan")}}',
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
