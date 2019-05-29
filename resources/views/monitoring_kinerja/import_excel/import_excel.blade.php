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

@include('monitoring_kinerja.import_excel.crosscheck')
@include('monitoring_kinerja.import_excel.modal_import')

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
                    <h2>Data dari Database</h2>
                    <hr>

                    <div class="row">
                        
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <label>Periode Bulan</label>
                                    </div>

                                    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">

                                        <div class="form-group">


                                            <div class="input-group input-daterange">
                                                <input type="text" class="form-control input-sm" name="">
                                                <span class="input-group-addon">-</span>
                                                <input type="text" class="form-control input-sm" name="">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-search"></i> Cari</button>
                                                </span>
                                            </div>
                                            
                                        </div>

                                    </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table_db">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th width="10%">Tanggal Service</th>
                                    <th>No. Rangka</th>
                                    <th>No. Polisi</th>
                                    <th>Type Kendaraan</th>
                                    <th>Type Pekerjaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2018-10-01</td>
                                    <td>MHFM1BA2JBK035948</td>
                                    <td>B1295PKO</td>
                                    <td>AVANZA</td>
                                    <td>Service 10.000 Kilometer</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="ibox-footer text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#crosscheck" type="button">Cross Check Data</button>
                </div>
            </div>          
        </div>
    </div>
</div>
@endsection

@section('extra_script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#table_db').DataTable();
        var table = $('#table_upload').DataTable({
            "language": {
                "emptyTable": "Menunggu data dari import excel"
            }
        });

        $('.input-daterange').datepicker({
            format:'dd-mm-yyyy'
        });

// var counter = 0;

// function fileReader(oEvent) {
//         var oFile = oEvent.target.files[0];
//         var sFilename = oFile.name;

//         var reader = new FileReader();
//         var result = {};

//         reader.onload = function (e) {
//             var data = e.target.result;
//             data = new Uint8Array(data);
//             var workbook = XLSX.read(data, {type: 'array'});
//             console.log(workbook);
//             // Global_sheetname = workbook.SheetNames;
//             var result = {};
//             workbook.SheetNames.forEach(function (sheetName) {
//                 var roa = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {header: 1});
//                 if (roa.length) result[sheetName] = roa;
//             });
//             // see the result, caution: it works after reader event is done.
//             console.log(result);
//             // console.log(Global_sheetname);

//             var data = result;
//             console.log(data.length);
//             for(var i = 1; i <= data.length;i++){
//                 data[i].push('<button class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash"></i></button>');
//                 table.row.add(data[i]).draw(false);
//                 counter++;
//             }
//         };
//         reader.readAsArrayBuffer(oFile);
// }

// // Add your id of "File Input" 
// $('[name="excel"]').change(function(ev) {
//         // Do something 
//         fileReader(ev);
// });
    });
</script>
@endsection
