
<!DOCTYPE html>
<html>

@include('layouts._head')
<style type="text/css">
    .logo-name{
        font-size: 50pt;
    }
</style>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                {{-- <h3 class="logo-name">Auto 2000</h3> --}}
                <img src="{{asset('assets/img/auto2000-new.png')}}" height="70px">

            </div>
            {{-- <h3>Login</h3> --}}
           
            <form class="m-t" method="POST" action="{{ route('login.sign') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-danger block full-width m-b">Login</button>

                <a href="javascript:void(0);"><small>Lupa password?</small></a>
            </form>
            <p class="m-t"> <small>Copyright by <strong>Alamraya Sebar Barokah</strong> &copy; 2019</small> </p>
        </div>
    </div>

    @include('layouts._script')
    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::get('gagal') != '')
                    iziToast.show({
                                color: '#DC143C',
                                titleColor: '#ffffff',
                                messageColor: '#ffffff',
                                title: 'Gagal!',
                                message: 'Anda Tidak Terdaftar',
                            });
            @endif
        })
    </script>
</body>

</html>
