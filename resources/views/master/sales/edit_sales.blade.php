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
        <h2>Tambah Service Advisor</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Master</a>
            </li>
            <li>
                <a href="{{route('sales')}}">Master Service Advisor</a>
            </li>
            <li class="active">
                <strong>Tambah Service Advisor</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<form id="form_sales">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tambah Service Advisor</h5>
                        <div class="ibox-tools">
                            <a href="{{route('sales')}}" class="btn btn-default btn-sm">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                    <form id="form_sales">
                        @foreach($data as $row)
                        <input type="hidden" value="{{$row->s_id}}" name="id">
                        <div class="ibox-content">

                            <div class="row">
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                    <div class="row">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Nama Service Advisor</label>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" value="{{$row->s_name}}" name="name">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>E-mail</label>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" value="{{$row->s_email}}" name="email">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>No HP</label>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">+62</span>
                                                    <input type="text" class="form-control input-sm" value="{{$row->s_nphone}}" name="phone">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                    <div class="row">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Username</label>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" value="{{$row->s_username}}" name="username">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Password</label>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="password" class="form-control input-sm" name="password">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary" id="btn-show" type="button"><i class="icon fa fa-eye"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                
                                
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Alamat</label>
                                </div>

                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="address">{{$row->s_address}}</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                        @endforeach
                    </form>

                    <div class="ibox-footer text-right">
                        <button type="button" id="storesales" class="btn btn-primary">Simpan Data</button>
                        <a href="{{route('sales')}}" class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('extra_script')
<script type="text/javascript">
    $(document).ready(function(){
        
        $('#storesales').on('click',function(){
            var form = $('#form_sales');
            $.ajax({
                url : '{{route("sales.edit")}}',
                type : 'POST',
                data : form.serialize(),
                success:function(){
                    iziToast.success({
                        title:'Berhasil!',
                        message:'Menginput Service Advisor!'
                    });

                    setTimeout(function(){
                        window.location.href="{{route('sales')}}";
                    },500);
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.error({
                                title: 'Gagal!',
                                message: 'Ada yang Kosong / username sudah ada',
                    });
                },
            })
        })

        $('#btn-show').click(function(){
        var tuwek = $(this).parents('.input-group');
        var input = tuwek.find('input');

        input.attr('type', function(index, attr){
            var icon = $(this).find('i');

            attr == 'password' ? $('.icon').removeClass('fa-eye').addClass('fa-eye-slash') : $('.icon').removeClass('fa-eye-slash').addClass('fa-eye');

            return attr == 'password' ? 'text' : 'password';
        });

    })

    });
</script>
@endsection
