<!DOCTYPE html>
<html lang="en">
@include('includes.header')
<body>
<div class="dashboard-main-wrapper">
  @include('includes.navbar')
  @include('includes.sidebar')
  <div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
      @yield('content')
    </div>
    {{-- @include('includes.footer') --}}
  </div>
</div>
</body>
</html>
