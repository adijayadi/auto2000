<?php $message = App\Http\Controllers\message::alertt();
    $customer = App\Http\Controllers\message::customer();
    $planned = App\Http\Controllers\message::planned();
    $hasil = App\Http\Controllers\message::hasil();
     ?>
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            {{-- <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Cari Sesuatu..." class="form-control" name="top-search" id="top-search">
                </div>
            </form> --}}
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Selamat datang di Auto 2000.</span>
            </li>

            <!-- <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <img alt="image" class="img-circle" src="{{asset('assets/img/a7.jpg')}}">
                            </a>
                            <div class="media-body">
                                <small class="pull-right">46j lalu</small>
                                <strong>Mike Loreipsum</strong> mulai mengikuti <strong>Monica Smith</strong>. <br>
                                <small class="text-muted">3 hari lalu jam 7:58 pm - 10.06.2014</small>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <img alt="image" class="img-circle" src="{{asset('assets/img/a4.jpg')}}">
                            </a>
                            <div class="media-body ">
                                <small class="pull-right text-navy">5j lalu</small>
                                <strong>Chris Johnatan Overtunk</strong> mulai mengikuti <strong>Monica Smith</strong>. <br>
                                <small class="text-muted">Kemarin 1:21 pm - 11.06.2014</small>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <img alt="image" class="img-circle" src="{{asset('assets/img/profile.jpg')}}">
                            </a>
                            <div class="media-body ">
                                <small class="pull-right">23j lalu</small>
                                <strong>Monica Smith</strong> sayang <strong>Kim Smith</strong>. <br>
                                <small class="text-muted">2 hari lalu jam 2:30 am - 11.06.2014</small>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="javascript:void(0);">
                                <i class="fa fa-envelope"></i> <strong>Baca Semua Pesan</strong>
                            </a>
                        </div>
                    </li>
                </ul>
            </li> -->

            <li class="dropdown">
                @if(Auth::user()->u_user == 'S')
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="javascript:void(0);">
                    <i class="fa fa-bell"></i>  <span class="label label-primary">{{$message + $planned}}</span>
                </a>
                @else
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="javascript:void(0);">
                    <i class="fa fa-bell"></i>  <span class="label label-primary">{{$customer}}</span>
                </a>
                @endif
                <ul class="dropdown-menu dropdown-alerts">
                    @if(Auth::user()->u_user == 'S')
                    <!-- <li class="divider"></li> -->
                    <li>
                        <a href="{{route('data_suspect')}}">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Followup
                                <span class="pull-right text-muted small">{{$message}}</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('rencana_followup')}}">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Rencana Follow up
                                <span class="pull-right text-muted small">{{$planned}}</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('summary_tindakan')}}">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Hasil Follow up
                                <span class="pull-right text-muted small">{{$hasil}}</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="javascript:void(0);">
                                <strong>Lihat Semua Peringatan</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                    @else
                    <li>
                        <a href="{{route('kelola_penugasan')}}">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Data Customer
                                <span class="pull-right text-muted small">{{$customer}}</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="javascript:void(0);">
                                <strong>Lihat Semua Peringatan</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                    @endif
                </ul>
            </li>


            <li>
                <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            {{-- <li>
                <a class="right-sidebar-toggle">
                    <i class="fa fa-tasks"></i>
                </a>
            </li> --}}
        </ul>

    </nav>
</div>