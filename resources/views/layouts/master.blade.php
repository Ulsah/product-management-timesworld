<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
<title>AdminLTE 3 | Dashboard</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">


<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
<script nonce="5424e04a-66a8-4e76-8ea7-664831e07951">(function(w,d){!function(a,e,t,r,z){a.zarazData=a.zarazData||{},a.zarazData.executed=[],a.zarazData.tracks=[],a.zaraz={deferred:[]};var s=e.getElementsByTagName("title")[0];s&&(a.zarazData.t=e.getElementsByTagName("title")[0].text),a.zarazData.w=a.screen.width,a.zarazData.h=a.screen.height,a.zarazData.j=a.innerHeight,a.zarazData.e=a.innerWidth,a.zarazData.l=a.location.href,a.zarazData.r=e.referrer,a.zarazData.k=a.screen.colorDepth,a.zarazData.n=e.characterSet,a.zarazData.o=(new Date).getTimezoneOffset(),a.dataLayer=a.dataLayer||[],a.zaraz.track=(e,t)=>{for(key in a.zarazData.tracks.push(e),t)a.zarazData["z_"+key]=t[key]},a.zaraz._preSet=[],a.zaraz.set=(e,t,r)=>{a.zarazData["z_"+e]=t,a.zaraz._preSet.push([e,t,r])},a.dataLayer.push({"zaraz.start":(new Date).getTime()}),a.addEventListener("DOMContentLoaded",(()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r);z.defer=!0,z.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData))),t.parentNode.insertBefore(z,t)}))}(w,d,0,"script");})(window,document);</script></head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="app">

<div class="preloader flex-column justify-content-center align-items-center">
<img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
</li>
<li class="nav-item d-none d-sm-inline-block">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
</li>
<li class="nav-item d-none d-sm-inline-block">
<a href="#" class="nav-link">Contact</a>
</li>
</ul>

</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="index3.html" class="brand-link">
<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light">AdminLTE 3</span>
</a>

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
</div>
<div class="info">
 <a href="#" class="d-block">{{ Auth::user()->name }}</a>
</div>
</div>

<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<li class="nav-item menu-open">
			<a href="#" class="nav-link">
				<i class="nav-icon fas fa-tachometer-alt"></i>
				<p>
					Operations
					<i class="right fas fa-angle-left"></i>
				</p>
			</a>
			<ul class="nav nav-treeview">
				@can('isAdmin')
					<li class="nav-item">
						<router-link to="/admin/manage-users" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Manage Users</p>
						</router-link>
					</li>
				@endcan
				@can('isAdmin')
					<li class="nav-item">
						<router-link to="/admin/manage-appointments" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Manage Appointments</p>
						</a>
					</li>
				@endcan
				@can('isDoctor')
					<li class="nav-item">
						<router-link to="/doctor/manage-appointments" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Manage Appointments</p>
						</a>
					</li>
				@endcan
				@can('isUser')
					<li class="nav-item">
						<router-link to="/user/manage-appointments" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Manage Appointments</p>
						</a>
					</li>
				@endcan
			</ul>
		</li>
	</ul>
</nav>

</div>

</aside>

<div class="content-wrapper">

<section class="content">
<div class="container-fluid">

<router-view>
        {{-- vue components here --}}
</router-view>
</div>

</section>


<section class="col-lg-5 connectedSortable">



</section>

</div>

</div>

</div>



<footer class="main-footer">
<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
All rights reserved.
<div class="float-right d-none d-sm-inline-block">
<b>Version</b> 3.2.0
</div>
</footer>

<aside class="control-sidebar control-sidebar-dark">

</aside>

</div>

<!-- Only authenticated user -->
@auth
	<script>
		// Sets user data into window.user
		window.user = @json(auth()->user()) ;
	</script>
@endauth

<script src="{{ asset('js/app.js') }}"</script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="https://kit.fontawesome.com/ad66c9c2be.js" crossorigin="anonymous"></script>
</body>
</html>
