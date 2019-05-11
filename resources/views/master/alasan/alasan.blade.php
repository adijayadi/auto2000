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

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table_alasan">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th>Alasan</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Pindah ke lain hati</td>
                                    <td align="center">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
                                            <button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></button>
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
        $('#table_alasan').DataTable();

    });
</script>
@endsection
