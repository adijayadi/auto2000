@extends('main')
<style>

</style>
@section('content')
<div class="row  border-bottom white-bg dashboard-header">

        <div class="col-xs-12">
            <h2>Dashboard Auto 2000</h2>
                    <span>Selamat Datang <b>{{Auth::user()->u_name}}</b></span>
        </div>
</div>

@if(Auth::user()->u_user == 'A')
<div class="wrapper wrapper-content">

    <div class="ibox">

        <div class="ibox-content">
            <div class="row">

                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                    <h3 class="mt-2">Monitoring Tindakan Service Advisor</h3>
                </div>

                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control input-sm" id="filter-service" name="" placeholder="Cari Service Advisor">
                        <div class="input-group-addon"><i class="fa fa-search"></i>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>

    <div class="row mt-4 " id="list-service-advisor">
    @if(count($adv) != 0)
        @for($i = 0;$i<count($adv);$i++)
            <div class="col-lg-4 services-column">
                <div class="ibox float-e-margins services-box">
                    <div class="ibox-title header-service">
                        <h5>{{$adv[$i]}}</h5>
                    </div>
                    <div class="ibox-content service-content no-padding">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>Kendaraan Telah Melakukan Service</div>
                                <div class="label label-servies">{{$service[$i]}}</div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>Kendaraan Yang Harus Di Follow Up</div>
                                <div class="label label-servies">{{$followup[$i]}}</div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>Kendaraan Yang Telah Di Follow Up Dan Tidak Bersedia</div> 
                                <div class="label label-servies">{{$tidakbersedia[$i]}}</div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>Kendaraan Yang Telah Di Follow Up Dan Bersedia Service dan Telah Melakukan Booking</div>
                                <div class="label label-servies">{{$booking[$i]}}</div>
                                
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>Kendaraan Yang Telah Di Follow Up Dan Bersedia Service dan Belum Melakukan Booking</div>
                                <div>
                                <span class="label label-servies">{{$tidakbooking[$i]}}</span>
                                </div>
                                
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>   
        @endfor

        <div class="col-xs-12 d-none" id="noRecordFound">
            <div class="widget style1 white-bg">
                <h3 class="text-center">Tidak ada yang cocok</h3>
            </div>
        </div>
    @else
        <div class="widget style1 white-bg">
            <h3 class="text-center">Tidak ada Data</h3>
        </div>
    @endif
                    
        {{-- <div class="col-xs-12">

            <div class="ibox">

                <div class="ibox-title">

                    <h5>Summary Tindakan Service Advisor</h5>
                    
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">

                        <table class="table table-bordered table-hover" id="table_service">
                            <thead>
                                <tr>
                                    <th>Service Advisor</th>
                                    <th>Summary Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        
                    </div>

                </div>

            </div>
            
        </div> --}}
        
    </div>

</div>
@elseif(Auth::user()->u_user == 'S')
<div class="wrapper wrapper-content">

    <div class="row">

        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

            <div class="widget style1 yellow-bg">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> Suspect </span>
                        <h2 class="font-bold suspect">0</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
            
            <div class="widget style1 navy-bg">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-user-check fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span>Sudah Follow Up</span>
                        <h2 class="font-bold follow-up">0</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

            <div class="widget style1 blue-bg">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-book-open fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span>Sudah Booking</span>
                        <h2 class="font-bold sudah-booking">0</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

            <div class="widget style1 yellow-bg">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-book fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span>Belum Booking</span>
                        <h2 class="font-bold belum-booking">0</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

            <div class="widget style1 lazur-bg">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-sync fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span>Dihubungi Lagi</span>
                        <h2 class="font-bold dihubungi-lagi">0</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

            <div class="widget style1 red-bg">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-times fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span>Tidak Bersedia</span>
                        <h2 class="font-bold tidak-bersedia">0</h2>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

</div>
@endif

@endsection
@section('extra_script')
<script type="text/javascript">
    $(document).ready(function(){
        @if (Auth::user()->u_user == 'A')
            $('.services-column .label-servies').each(function(){
                var ini = $(this);
                // console.log(ini.text());

                if (parseInt(ini.text()) < 100) {
                    counterNum(ini, 0, parseInt(ini.text()), 1, parseInt(ini.text()));
                } else if (parseInt(ini.text()) < 1000){
                    counterNum(ini, 0, parseInt(ini.text()), 1, parseInt(ini.text()) / 10);
                } else {
                    counterNum(ini, 0, parseInt(ini.text()), 1, parseInt(ini.text()) / 10000);
                }
            });

            $('#filter-service').keyup(function(){
                myFunction();
            });

            function myFunction() {
              // Declare variables
              var input, filter, ul, li, a, i, txtValue;
              input = document.getElementById('filter-service');
              filter = input.value.toUpperCase();
              ul = document.getElementById("list-service-advisor");
              li = ul.getElementsByClassName('services-column');

              // Loop through all list items, and hide those who don't match the search query
              for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("h5")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  li[i].style.display = "";
                  $('#noRecordFound').addClass('d-none');
                } else {
                  li[i].style.display = "none";
                  $('#noRecordFound').removeClass('d-none');
                }
              }
            }
        @elseif(Auth::user()->u_user == 'S')
            $.ajax({
                url:"{{route('getcount.summary')}}",
                dataType:'JSON',
                type:'POST',
                data: {
                    '_token' :'{{csrf_token()}}',
                    '_method' :'PUT',
                },
                success:function(res){
                    console.log(res);
                    counterNum($('.widget .suspect'), 0, res.all, 1, 15);
                    counterNum($('.widget .follow-up'), 0, res.done, 1, 250);
                    counterNum($('.widget .sudah-booking'), 0, res.booking, 1, 500);
                    counterNum($('.widget .belum-booking'), 0, res.notbooking, 1, 500);
                    counterNum($('.widget .dihubungi-lagi'), 0, res.refu, 1, 500);
                    counterNum($('.widget .tidak-bersedia'), 0, res.denied, 1, 500);
                }
            });
        @endif

        function counterNum(obj, start, end, step, duration) {
            $(obj).html(start);
            setInterval(function(){
                var val = Number($(obj).html());
                if (val < end) {
                    $(obj).html(val+step);
                } else {
                    clearInterval();
                }
            },duration);
        }
    });
</script>
@endsection