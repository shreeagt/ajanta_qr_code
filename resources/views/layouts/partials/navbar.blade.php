<style>
  a.active {
    background-color: #75bdd9;
    color: #041E42;
  }
</style>
<div class="dashboard_content_wrapper">
  <div class="dashboard dashboard_wrapper pr30 pr0-md">
    <div class="dashboard__sidebar" style="overflow: hidden;">

      <div class="dashboard_sidebar_list">

        @auth
        @role('admin')
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('home.index')}}" class=" items-center"><i class="fa-solid fa-gauge mr15"></i>Dashboard</a>
        </div> 
        <div class="sidebar_list_item">
          <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }} items-center "><i class="flaticon-house mr15"></i>User Management</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('all.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>All Doctors</a>
        </div>
        <div class="sidebar_list_item">
          <a href="{{ route('videoList') }}" class="{{ request()->routeIs('videoList') ? 'active' : '' }} items-center"><i class="flaticon-cash-on-delivery mr15"></i>Pending Doctors</a>
        </div>
        <div class="sidebar_list_item" style="margin-top: 14px; margin-bottom: 14px;">
          <a href="{{ route('getapprove.doctors') }}" class="items-center"><i class="flaticon-cash-on-delivery mr15"></i>Approved Doctors</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{ route('get.doctors.printer') }}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Qr Under Printing</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('get.dispatched.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Qr Dispatched</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('live.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Live Qr</a>
        </div>
        @endrole
        @role('team_lead')
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('home.index')}}" class=" items-center"><i class="fa-solid fa-gauge mr15"></i>Dashboard</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{ route('video.solist') }}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>SO List</a>
        </div>
        <div class="sidebar_list_item">
          <a href="{{ route('videoList') }}" class="{{ request()->routeIs('videoList') ? 'active' : '' }} items-center"><i class="flaticon-cash-on-delivery mr15"></i>All Doctors List</a>
        </div>
        <div class="sidebar_list_item" style="margin-top: 14px;">
          <a href="{{route('getapprove.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Approved Doctors</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{ route('get.doctors.printer') }}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Qr Under Printing</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('get.dispatched.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Qr Dispatch</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('live.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Live Qr</a>
        </div>
        @endrole
        @role('rsm')
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('home.index')}}" class=" items-center"><i class="fa-solid fa-gauge mr15"></i>Dashboard</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{ route('video.dmlist') }}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>DM List</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{ route('video.solist') }}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>SO List</a>
        </div>
        <div class="sidebar_list_item">
          <a href="{{ route('videoList') }}" class="{{ request()->routeIs('videoList') ? 'active' : '' }} items-center"><i class="flaticon-cash-on-delivery mr15"></i>All Doctors</a>
        </div>
        <div class="sidebar_list_item" style="margin-top: 14px;">
          <a href="{{route('getapprove.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Approved Doctors</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{ route('get.doctors.printer') }}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Qr Under Printing</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('get.dispatched.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Qr Dispatch</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('live.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Live Qr</a>
        </div>
        @endrole
        @role('so')
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('home.index')}}" class=" items-center"><i class="fa-solid fa-gauge mr15"></i>Dashboard</a>
        </div>
        <div class="sidebar_list_item">
          <a href="{{ route('doctors.show') }}" class="items-center">
            <i class="flaticon-house mr15"></i>All Doctors
          </a>
        </div>
        <div class="sidebar_list_item" style="margin-top: 14px;">
          <a href="{{route('getapprove.doctors')}}" class="{{ request()->routeIs('videoList') ? 'active' : '' }} items-center"><i class="flaticon-cash-on-delivery mr15"></i>Approved Doctors</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{ route('get.doctors.printer') }}" class="{{ request()->routeIs('videoList') ? 'active' : '' }} items-center"><i class="flaticon-cash-on-delivery mr15"></i>Qr Under Printing</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('get.dispatched.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Qr Dispatch</a>
        </div>
        <div class="sidebar_list_item" style="margin-bottom: 14px;">
          <a href="{{route('live.doctors')}}" class=" items-center"><i class="flaticon-cash-on-delivery mr15"></i>Live Qr</a>
        </div>

        @endrole

      </div>
    </div>
    @endauth


    @auth
    
    <div class="text-end">
      <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
    </div>
    @endauth

    @guest

    <div class="text-end">
      <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
      {{-- <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a> --}}
    </div>
    @endguest


  </div>
</div>