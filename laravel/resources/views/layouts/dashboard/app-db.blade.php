<!DOCTYPE html>
<html lang="ar" dir="rtl" class="layout-navbar-fixed layout-compact dark-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template" data-style="dark">
<head>
@include('layouts.dashboard.head')
</head>
<body>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
<div class="layout-container">

@include('layouts.dashboard.menu')
   <!-- Layout container -->
   <div class="layout-page">
@include('layouts.dashboard.navbar')

@include('layouts.dashboard.alert')

{{ $slot }}
@include('layouts.dashboard.footer')

   </div>
   
</div>
</div>


@include('layouts.dashboard.script')
</body>
</html>
