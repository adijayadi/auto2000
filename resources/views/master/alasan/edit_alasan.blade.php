@if(Auth::user()->u_user != 'A')
<script type="text/javascript">window.location.href="{{route('home')}}";</script>
@endif
@extends('main')
@section('extra_style')
<style type="text/css">
    /*Ini Extra Style*/
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tambah Alasan Tidak Lanjut</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Master</a>
            </li>
            <li>
                <a href="{{route('alasan')}}">Master Alasan Tidak Lanjut</a>
            </li>
            <li class="active">
                <strong>Edit Alasan Tidak Lanjut</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tambah Alasan Tidak Lanjut</h5>
                    <div class="ibox-tools">
                        <a href="{{route('alasan')}}" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        
                        
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Alasan</label>
                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="form-group">
                                @foreach($data as $row)
                                <input type="hidden" id="id" value="{{$row->r_id}}">
                                <input type="text" class="form-control input-sm" value="{{$row->r_reason}}" id="reason">
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>


                <div class="ibox-footer text-right">
                    <button type="button" id="input_alasan" class="btn btn-primary">Simpan Data</button>
                    <a href="{{route('alasan')}}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_script')
<script type="text/javascript">
    $(document).ready(function(){

        $('#input_alasan').on('click',function(){
            if ($('#reason').val() != '') {
                adddata();
            }else{
                iziToast.show({
                    title: 'Gagal!',
                    message: 'Ada Yang Kosong',
                });
            }
        })

        function adddata(){
            var alasan = $('#reason').val();
            var id = $('#id').val();
            $.ajax({
                url : '{{route("edit.alasan")}}',
                method : 'POST',
                data : { 'id' : id,'_token' : '{{csrf_token()}}','alasan' : alasan },
                success: function(get){
                    iziToast.success({
                        title: 'Berhasil!',
                        message: 'Menginput Alasan ',
                    });
                    setTimeout(function(){
                        window.location.href="{{route('alasan')}}";
                    },500)
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.error({
                                title: 'Gagal!',
                                message: 'Menginput Alasan',
                    });
                },
            })
        }
    })

</script>
@endsection
