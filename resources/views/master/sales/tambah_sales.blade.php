
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
                        <div class="ibox-content">

                            <div class="row">
                                
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                    <div class="row">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Nama Service Advisor</label>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" name="name">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Type Pekerja</label>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <select class="form-control input-sm select2" name="type">
                                                    <option value="THS">THS</option>
                                                    <option value="S">SA</option>
                                                </select>
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

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>No HP</label>
                                        </div>


                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">+62</span>
                                                    <input type="text" class="form-control input-sm" name="phone">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                    <div class="row">
                                                    @include('modal')

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                            <div class="form-group">
                                                <input type="hidden" class="gambarr" name="gambar[]">
                                                <button class="btn btn-primary btn-sm" data-gambar="" type="button" data-toggle="modal" data-target="#modal-foto"><i class="fa fa-images"></i> <span>Pilih Foto</span></button>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Username</label>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" name="username">
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
                                        <textarea class="form-control" name="address"></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
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

    var gambar = '';
    

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

        $('[name=name]').on('change',function(){
            check_text($(this),$(this).val());
        })

        $('[name=username]').on('change',function(){
            check_text($(this),$(this).val());
        })

        $('[name=email]').on('change',function(){
            validateEmail($(this),$(this).val());
        })

        $('[name=phone]').on('change',function(){
            check_number($(this),$(this).val());
        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(input).parents('tr').find('img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#storesales').on('click',function(){
            var form = $('#form_sales');
            if (validateEmail($('[name=email]'),$('[name=email]').val()) == false) {

            }else if ($('[name=name]').val() == '') {
                iziToast.warning({
                    title:'Peringatan!',
                    message:'Nama Masih Kosong!'
                });
            }else if ($('[name=email]').val() == '') {
                iziToast.warning({
                    title:'Peringatan!',
                    message:'Email Masih Kosong!'
                });
            }else if ($('[name=username]').val() == '') {
                iziToast.warning({
                    title:'Peringatan!',
                    message:'Username Masih Kosong!'
                });
            }else if ($('[name=password]').val() == '') {
                iziToast.warning({
                    title:'Peringatan!',
                    message:'password Masih Kosong!'
                });
            }else if ($('[name=address]').val() == '') {
                iziToast.warning({
                    title:'Peringatan!',
                    message:'alamat Masih Kosong!'
                });
            }else if ($('[name=phone]').val() == '') {
                iziToast.warning({
                    title:'Peringatan!',
                    message:'Nomor Hp Masih Kosong!'
                });
            }else{
                $.ajax({
                    url : '{{route("sales.input")}}',
                    type : 'POST',
                    data : form.serialize()+'&gambar='+gambar,
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
                                    message: 'Ada yang Kosong / Email, Username Sudah Ada',
                        });
                    },
                })
            }
        })

            var $image = $(".image-crop > img");
            $($image).cropper({
                aspectRatio: 1 / 1,
                preview: "#image-preview",
                autoCropArea: 0,
                strict: true,
                guides: true,
                highlight: true,
                dragCrop: true,
                cropBoxMovable: true,
                cropBoxResizable: true,
                done: function (data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#input-foto");
            if (window.FileReader) {
                $inputImage.change(function () {
                    var fileReader = new FileReader(),
                        files = this.files,
                        file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#zoomIn").click(function () {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function () {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function () {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function () {
                $image.cropper("rotate", -45);
            });

            $("#resetCrop").click(function () {
                $image.cropper("reset", true);
            });

            $('#update-foto').click(function () {

                var is = $image.cropper("getCroppedCanvas");

                // $('#foto-terpilih').html(is);

                var convert = $image.cropper('getCroppedCanvas').toDataURL();
                gambar = convert;
                gambarrrr = $(this).parents('tr').find('.gambarr').val(convert); 
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
