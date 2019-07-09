<!DOCTYPE html>
<html>
@include('layouts._head')
@yield('extra_style')
<body class="body-loading body-cpanel">

	<div id="wrapper">

	<div class="div-loading animated fadeIn">

        <div class="spiner-example">
            <div class="sk-spinner sk-spinner-wandering-cubes">
                <div class="sk-cube1"></div>
                <div class="sk-cube2"></div>
            </div>
        </div>
		
	</div>
		@include('layouts._sidebar')

        <div id="page-wrapper" class="gray-bg dashbard-1">
			
			@include('layouts._navbar')

			@yield('content')

			@include('layouts._footer')

			{{-- @include('layouts._smallchat') --}}

			{{-- @include('layouts._rightsidebar') --}}
		</div>
	</div>
	@include('layouts._script')
	@yield('extra_script')
</body>
</html>