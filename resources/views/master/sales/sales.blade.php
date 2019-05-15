@extends('main')
@section('extra_style')
<style type="text/css">
    
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Master Sales Account</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a>Master</a>
            </li>
            <li class="active">
                <strong>Master Sales Account</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Master Sales Account</h5>
                    <div class="ibox-tools">
                        <a href="{{route('tambah_sales')}}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>
                            Tambah Data Sales Account
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table_sales">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th>Nama Sales Account</th>
                                    <th>E-mail</th>
                                    <th>Username</th>
                                    <th>No HP</th>
                                    <th>Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Alpha</td>
                                    <td>alpha@alpha.com</td>
                                    <td>alpha</td>
                                    <td>+6285331219757</td>
                                    <td align="center"><label class="label label-success">AKTIF</label></td>
                                    <td align="center">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
                                            <button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="Non Aktifkan"><i class="fa fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Bravo</td>
                                    <td>bravo@bravo.com</td>
                                    <td>bravo</td>
                                    <td>+6285331219757</td>
                                    <td align="center"><label class="label label-danger">TIDAK AKTIF</label></td>
                                    <td align="center">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
                                            <button class="btn btn-primary" type="button" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-check"></i></button>
                                        </div>
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
        $('#table_sales').DataTable();

    });
</script>
@endsection
