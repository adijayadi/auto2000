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
        <h2>Tambah Kendaraan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Master</a>
            </li>
            <li>
                <a href="{{route('kendaraan')}}">Master Kendaraan</a>
            </li>
            <li class="active">
                <strong>Tambah Kendaraan</strong>
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
                    <h5>Tambah Kendaraan</h5>
                    <div class="ibox-tools">
                        <a href="{{route('kendaraan')}}" class="btn btn-default btn-sm">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                <form id="form_kendaraan">
                    @csrf
                    <div class="ibox-content">

                        <div class="row">
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                <div class="row">

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Nama Pemilik</label>
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control input-sm" name="name">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>No HP</label>
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">+62</span>
                                                <input type="text" class="form-control input-sm" name="nphone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>E-mail</label>
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control input-sm" name="email">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                <div class="row">

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>No Plat Kendaraan</label>
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control input-sm" name="nkendaraan">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Nama Kendaraan</label>
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control input-sm" name="namekendaraan">
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
                                    <textarea class="form-control" name="address"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>

                <div class="ibox-footer text-right">
                    <button type="button" id="save" class="btn btn-primary">Simpan Data</button>
                    <a href="{{route('kendaraan')}}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_script')
<script type="text/javascript">
     function check_text(variable,text_data)
    {
        var text = /[.*+?^${}();:'"|[\]\\]/g;

        if(text.test(text_data))
         {
            variable.val(text_data.replace(/[.*+?^${}();:'"|[\]\\]/g, ''));
         }
       else
         {
            variable.val(text_data.replace(/[.*+?^${}();:'"/|[\]\\]/g, ''));
         }
    }

    function check_number(variable,text_data)
    {
        var text = /[a-zA-Z.*+?^${}();:'"|[\]\\]/g;
        var number = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[\s\./0-9]*$/g;

        if(number.test(text_data))
         {
            variable.val(parseInt(text_data.replace(text, '')));
         }
       else
         {
            variable.val(parseInt(text_data.replace(text, '')));
         }
    }

    function validateEmail(variable,email) {
        var text = /[.*+?^${}();:'"|[\]\\]/g;
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if(re.test(String(email).toLowerCase()))
         {
            return true;
         }
       else
         {
            iziToast.warning({
                    title:'Peringatan!',
                    message:'Email Tidak Valid!'
                });
            variable.val(email.replace(/[*+?^${}();:'"/|[\]\\]/g, ''));
            return false;
         }

    }

    $(document).ready(function(){

        $('[name=name]').change(function(){
            check_text($(this),$(this).val());
        })

        $('[name=nphone]').change(function(){
            check_number($(this),$(this).val());
        })

        $('[name=email]').change(function(){
            validateEmail($(this),$(this).val());
        })

        $('[name=nkendaraan]').change(function(){
            check_text($(this),$(this).val());
        })

        $('[name=namekendaraan]').change(function(){
            check_text($(this),$(this).val());
        })

        





        $('#save').on('click',function(){
            var form = $('#form_kendaraan');
            $.ajax({
                url : '{{route("input.kendaraan")}}',
                method : 'POST',
                data : form.serialize(),
                success: function(get){
                    iziToast.success({
                        title: 'Berhasil!',
                        message: 'Menginput Data Kendaraan ',
                    });

                    setTimeout(function(){
                        window.location.href="{{route('kendaraan')}}";
                    },500)
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.error({   
                                title: 'Gagal!',
                                message: 'Menginput Data Kendaraan',
                    });
                },
            })
        })
    })
</script>
@endsection
