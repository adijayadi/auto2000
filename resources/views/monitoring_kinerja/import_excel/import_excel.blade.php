@extends('main')
@section('extra_style')
<style type="text/css">
    
</style>
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Manajemen Import Data</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <span>Manajemen Data & Penugasan</span>
            </li>
            <li class="active">
                <strong>Manajemen Import Data</strong>
            </li>
        </ol>
    </div>
</div>

{{-- @include('monitoring_kinerja.import_excel.crosscheck') --}}
@include('monitoring_kinerja.import_excel.modal_import')
<form id="formexcel">
    @csrf
    <input type="hidden" value="{{$code}}"  name="code">
    <input type="hidden" name="data" id="data">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Manajemen Import Data</h5>
                    <div class="ibox-tools">
                        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-file-excel"></i> Contoh Format Excel</button>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-import" type="button"><i class="fa fa-file-excel"></i> Import Excel</button>

                    </div>
                </div>
                <div class="ibox-content">
                    <h2>Data dari Import Excel</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table_upload">
                            <thead>
                                <tr>
                                    <th>No. Rangka</th>
                                    <th>No. Polisi</th>
                                    <th>Type Kendaraan</th>
                                    <th>Type Pekerjaan</th>
                                    <th width="10%">Tanggal Service</th>
                                    <th>Service Advisor</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div id="my_file_output">
                        
                    </div>
                    <hr>
                    <h2>Rekap Import</h2>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="table_rekap">
                            <thead>
                                <tr>
                                    <th>Tanggal Import</th>
                                    <th>Jumlah Data</th>
                                    <th>Data Tersedia</th>
                                    <th>Data Ditambahkan</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="ibox-footer text-right">
                    <button class="btn btn-primary" id="excelstore" type="button">Simpan Data</button>
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

        $('#excelstore').on('click',function(){
            var form = $('#formexcel');
            $.ajax({
                url : '{{route("store.excel")}}',
                type : 'POST',
                data : form.serialize(),
                success:function(){
                    iziToast.show({
                        color: '#228B22',
                        titleColor: '#ffffff',
                        messageColor: '#ffffff',
                        title: 'Berhasil!',
                        message: 'Input '+ nama,
                    });
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.show({
                                color: '#DC143C',
                                titleColor: '#ffffff',
                                messageColor: '#ffffff',
                                title: 'Gagal!',
                                message: 'Menginput Customer',
                    });
                }
            })
        });


        $('#table_db').DataTable();
        var table = $('#table_upload').DataTable({
            "language": {
                "emptyTable": "Menunggu data dari import excel"
            }
        });

        $('#table_rekap').DataTable();

        $('.input-daterange').datepicker({
            format:'dd-mm-yyyy'
        });

var counter = 0;

function fileReader(oEvent) {
        var oFile = oEvent.target.files[0];
        var sFilename = oFile.name;

        var reader = new FileReader();
        var result = {};

        reader.onload = function (e) {
            var data = e.target.result;
            data = new Uint8Array(data);
            var workbook = XLSX.read(data, {type: 'array'});
            console.log(workbook);
            
            var result = {};
            Global_sheetname = [];
            workbook.SheetNames.forEach(function (sheetName) {
                var roa = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {header: 1});
                if (roa.length) result[sheetName] = roa;
                Global_sheetname.push(sheetName);
            });
            // see the result, caution: it works after reader event is done.
            console.log(result);
            console.log(Global_sheetname[0]);
            var single_sheetname = Global_sheetname[0].toString();

            var data = result;
            console.log(data.length);

            for(var i = 1; i <= data[single_sheetname].length;i++){
                data[single_sheetname][i].push('<button class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash"></i></button>');
                table.row.add(data[single_sheetname][i]).draw(false);
                counter++;
            }
        };
        reader.readAsArrayBuffer(oFile);
}

$('#data').val(counter);

// Add your id of "File Input" 
$('[name="excel"]').change(function(ev) {
        // Do something 
        fileReader(ev);
});
    });
</script>
@endsection
