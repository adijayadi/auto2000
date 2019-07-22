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

    <input type="hidden" name="data" id="data">
<form id="formexcel">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Manajemen Import Data</h5>
                    <div class="ibox-tools">
                        <a href="{{asset('download_contoh_excel/contoh_import_excel.xlsx')}}" download="" class="btn btn-primary btn-sm"><i class="fa fa-file-excel"></i> Contoh Format Excel</a>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-import" type="button"><i class="fa fa-file-excel"></i> Import Excel</button>

                    </div>
                </div>
                <form id="import">
                    <input type="hidden" value="{{$code}}"  name="code" id="code">
                    <input type="hidden"  name="cout" id="cout">
                    <input type="hidden" id="seriallenght" name="serialc">
                    @csrf
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
                </form>
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
        $.fn.dataTable.ext.errMode = 'none';

        setInterval(function(){
            $('#seriallenght').val($('.serialc').length);
        },500);
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
            
            var result = {};
            Global_sheetname = [];
            workbook.SheetNames.forEach(function (sheetName) {
                var roa = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {header: 1, raw:false});
                if (roa.length) result[sheetName] = roa;
                Global_sheetname.push(sheetName);
            });
            // see the result, caution: it works after reader event is done.
            var single_sheetname = Global_sheetname[0].toString();

            var data = result;
            console.log(result);
            var alldata = data[single_sheetname].length;
            var count = alldata;
            $('#cout').val(count);
            console.log(count);
            
            $.ajax({

                url : '{{route("hstore.excel")}}',
                type : 'POST',
                data : {'_token' : '{{csrf_token()}}','result' : result ,'datacount' : count, 'sheet' : workbook},
                success:function(){
                    table.ajax.reload();
                },
                error:function(xhr,textStatus,errorThrowl){
                    table.ajax.reload();
                }
            });

        // $('#table_upload tbody').find('tr').on('click', '.hapus', function(){
        //   var row = $(this).find('td:first').text();
        //   alert('You clicked ' + row);
        // });


            // for(var i = 1; i <= data[single_sheetname].length;i++){
            //     data[single_sheetname][i].push('<button class="btn btn-danger btn-sm hapus" data-id="'+i+'" type="button"><i class="fa fa-trash"></i></button>');
            //     table.row.add(data[single_sheetname][i]).draw(false);
            //     counter++;
            // }


            
        };

        reader.readAsArrayBuffer(oFile);       
}

        $('#excelstore').on('click',function(){

            var formm = $('#formexcel');
            console.log(formm.serialize());
            console.log($('#code').val());
            $.ajax({
                url : '{{route("store.excel")}}',
                type : 'POST',
                data : formm.serialize(),
                success:function(get){
                    table.ajax.reload();
                    if (get['error'] == 'Mohon Import Data') {
                        iziToast.error({
                                    title: 'Gagal!',
                                    message: 'Mohon Import Data',
                        });
                    }else{
                        iziToast.success({
                            title: 'Berhasil!',
                            message: 'Menyimpan Data',
                        });
                    }


                        setTimeout(function(){
                            if ($('.serial').length == 0 || $('.serial').length == 'undefined') {
                                $.ajax({
                                    url : '{{route("rekap.excel")}}',
                                    type : 'POST',
                                    data : formm.serialize(),
                                    success:function(get){
                                    }
                                });
                                setTimeout(function(){
                                    window.location.reload();
                                },1000);
                            }
                        },1000);
                    

                    
                    
                },
                error:function(xhr,textStatus,errorThrowl){
                            iziToast.show({
                                color: '#DC143C',
                                titleColor: '#ffffff',
                                messageColor: '#ffffff',
                                title: 'Gagal!',
                                message: 'Menyimpan Data',
                    });
                }
            });
        })

        $(document).on('click', '.hapus' ,function(){
            var id = $(this).data('id');
            $.ajax({
                url : '{{route("delete.excel")}}',
                type : 'POST',
                data : {'_token' : '{{csrf_token()}}','id' : id },
                success:function(){
                    table.ajax.reload();
                    setTimeout(function(){
                        $.ajax({
                            url : '{{route("rekap.excel")}}',
                            type : 'POST',
                            data : formm.serialize(),
                            success:function(get){
                            }
                        });
                        setTimeout(function(){
                            window.location.reload();
                        },1000);
                    });
                },
            });
        });


  if (performance.navigation.type == 1) {
    $.ajax({
                url : '{{route("table.reset")}}',
                type : 'POST',
                data : {'_token' : '{{csrf_token()}}'},
                success:function(){
                    table.ajax.reload();
                },
            });
  } else {
    $.ajax({
                url : '{{route("table.reset")}}',
                type : 'POST',
                data : {'_token' : '{{csrf_token()}}'},
                success:function(){
                    table.ajax.reload();
                },
            });
  }

// Add your id of "File Input" 
$('#btn-upload').on('click',function(){
    $('[name="excel"]').change(function(ev) {
            fileReader(ev);
    });
    $('[name="excel"]').change();
    setTimeout(function(){
        $('#trigger').click();
    },500);
})

var table2 = $('#table_db').DataTable();
        var table = $('#table_upload').DataTable({
            responsive: true,
            serverSide: true,
            paging: false,
            destroy: true,
            fixedHeader: true,
            ajax : {
                url: "{{ route('table.excel') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            columns : [
            {data : 'rangka' , name : 'rangka'},
            {data : 'plate' , name : 'plate'},
            {data : 'type' , name : 'type'},
            {data : 'job' , name : 'job'},
            {data : 'date' , name : 'date'},
            {data : 'servicead' , name : 'servicead'},
            {data : 'action' , name : 'action'},

            ],

        });
        var table2 = $('#table_rekap').DataTable({
            responsive: true,
            serverSide: true,
            destroy: true,
            fixedHeader: true,
            ajax : {
                url: "{{ route('table.rekap') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            columns : [
            {data : 're_dateupload' , name : 're_dateupload'},
            {data : 're_totaldata' , name : 're_totaldata'},
            {data : 're_availabledata' , name : 're_availabledata'},
            {data : 're_dataadded' , name : 're_dataadded'},

            ],
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']]
        });
    });
</script>
@endsection
