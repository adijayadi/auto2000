<!DOCTYPE html>
<html>
@include('layouts._head')
@yield('extra_style')
<body>
	<div id="wrapper">

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