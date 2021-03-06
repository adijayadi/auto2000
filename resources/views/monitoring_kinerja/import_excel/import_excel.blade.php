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
                        <button class="btn btn-primary btn-sm" id="reset" type="button"><i class="fa fa-file-excel"></i> Data Baru</button>
                        <button class="btn btn-primary btn-sm" id="trigger_upload" data-toggle="modal" data-target="#modal-import" type="button"><i class="fa fa-file-excel"></i> Import Excel</button>

                    </div>
                </div>
                <form id="import">
                    <input type="hidden" value="{{$code}}"  name="code" id="code">
                    <input type="hidden"  name="cout" id="cout">
                    <input type="hidden" id="seriallenght" name="serialc">
                    @csrf
                        <div class="ibox-content">
                            <div class="text-center">
                                <input type="text" name="" id="progress_upload" data readonly="" value="0">
                            </div>
                            <h2>Data dari Import Excel</h2>
                            <hr>
                            <div class="table-responsive-x">
                                    <table class="table table-striped table-bordered table-hover table-sticky" id="table_upload">
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

                            <div class="table-responsive-x">
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

        $('#reset').click(function(){
            $.ajax({
                url : '{{route("table.reset")}}',
                type : 'post',
                data : {'_token' : '{{csrf_token()}}'},
                success : function(get){
                    iziToast.success({
                            title: 'Berhasil!',
                            message: 'Mereset data, Silahkan Masukan Data Pertama lalu Data kedua',
                        });
                },
            })
        })

        var a = 0;
        var loop , progress;


        $('#progress_upload').knob({
            step:1,
            'change' : function (v) { console.log(v); },
            min:0,
            max:100,
            readOnly:true,

            // format:'%',
        });

        $.fn.dataTable.ext.errMode = 'none';

        setInterval(function(){
            $('#seriallenght').val($('.serialc').length);
        },500);
var counter = 0;
        var result;
        var count;
function fileReader(oEvent) {

        var oFile = oEvent.target.files[0];
        var sFilename = oFile.name;

        var reader = new FileReader();
        var result = {};
        var ini ;
        reader.onload = function (e) {
            var data = e.target.result;
            data = new Uint8Array(data);
            var workbook = XLSX.read(data, {type: 'array'});
            
            var result = {};
            Global_sheetname = [];
            ini = workbook.SheetNames;
            workbook.SheetNames.forEach(function (sheetName) {
                var roa = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {header: 1, raw:false});
                if (roa.length) result[sheetName] = roa;
                Global_sheetname.push(sheetName);
            });
            // see the result, caution: it works after reader event is done.
            var single_sheetname = Global_sheetname[0].toString();

            var data = result;
            var alldata = data[single_sheetname].length;
            count = alldata;
            console.log(count);
            $('#cout').val(count);
            

        // $('#table_upload tbody').find('tr').on('click', '.hapus', function(){
        //   var row = $(this).find('td:first').text();
        //   alert('You clicked ' + row);
        // });


            // for(var i = 1; i <= data[single_sheetname].length;i++){
            //     data[single_sheetname][i].push('<button class="btn btn-danger btn-sm hapus" data-id="'+i+'" type="button"><i class="fa fa-trash"></i></button>');
            //     table.row.add(data[single_sheetname][i]).draw(false);
            //     counter++;
            // }


            $.ajax({

                url : '{{route("hstore.excel")}}',
                type : 'POST',
                data : {'_token' : '{{csrf_token()}}','datacount' : count, 'sheet' : ini , 'code' : $('#code').val(),'result' : result },
                success:function(get){
                        progress = get['progress'];
                        iziToast.success({
                            title: 'Berhasil!',
                            message: 'Menyimpan Data',
                        });

                        

                    setTimeout(function(){
                                $.ajax({
                                    url : '{{route("rekap.excel")}}',
                                    type : 'POST',
                                    data : {'_token' : '{{csrf_token()}}','datacount' : count, 'sheet' : ini , 'code' : $('#code').val()},
                                    success:function(get){
                                        setTimeout(function(){
                                            window.location.reload();
                                        },200);
                                    }
                                });
                                
                        },1000);
                },
            });
        };

        reader.readAsArrayBuffer(oFile);       
}

        // $('#excelstore').on('click',function(){
        //     var formm = $('#formexcel');
        //     console.log(formm.serialize());
        //     console.log($('#code').val());
        //     $.ajax({
        //         url : '{{route("store.excel")}}',
        //         type : 'POST',
        //         data : formm.serialize(),
        //         success:function(get){
        //             table.ajax.reload();
        //             if (get['error'] == 'Mohon Import Data') {
        //                 iziToast.error({
        //                             title: 'Gagal!',
        //                             message: 'Mohon Import Data',
        //                 });
        //             }else{
        //                 iziToast.success({
        //                     title: 'Berhasil!',
        //                     message: 'Menyimpan Data',
        //                 });
        //             }


                        
                    

                    
                    
        //         },
        //         error:function(xhr,textStatus,errorThrowl){
        //                     iziToast.show({
        //                         color: '#DC143C',
        //                         titleColor: '#ffffff',
        //                         messageColor: '#ffffff',
        //                         title: 'Gagal!',
        //                         message: 'Menyimpan Data',
        //             });
        //         }
        //     });
        // })

        function upload_data()
        {
            ++a;
            console.log(progress);
            
            if (a > 98) {
                a = 99;
            }

            if (progress != null) {
                a = progress;
            }

            $('#progress_upload').val(a).trigger('change');

            if (a >= 100) {
                clearInterval(loop);
            }
        }

// Add your id of "File Input" 
$('#btn-upload').on('click',function(){
    $('#modal-import').modal('hide');
    $('[name="excel"]').change(function(ev) {
            fileReader(ev);
    console.log(ev);
    });
    $('[name="excel"]').change();

    loop = setInterval(upload_data,1000);
})

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