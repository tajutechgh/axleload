<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" class="bg-theme bg-theme2" data-simplebar="" data-simplebar-auto-hide="true">
  <div class="brand-logo">
    <a href="#">
      <img src="{{Storage::disk('local')->url($logo->image)}}" class="logo-icon" alt="logo icon" style="width:60px;">
      <h5 class="logo-text">G.H.A</h5>
    </a>
  </div>
  <div class="user-details">
    <div class="media align-items-center collapsed" data-toggle="collapse" data-target="#user-dropdown">
      <div class="avatar"><img class="mr-3 side-user-img" src="{{ asset('theme/assets/images/avatars/defaultavatar.png') }}" alt="user avatar"></div>
      <div class="media-body">
        <h6 class="side-user-name">{{Auth::user()->name}}</h6> 
      </div>
    </div> 
    {{-- <div id="user-dropdown" class="collapse">
      <ul class="user-setting-menu">
        <li><a href="javaScript:void();"><i class="icon-user"></i>  My Profile</a></li>
        <li><a href="javaScript:void();"><i class="icon-settings"></i> Setting</a></li>
        <li><a href="javaScript:void();"><i class="icon-power"></i> Logout</a></li>
      </ul>
    </div> --}}
  </div>
  <ul class="sidebar-menu do-nicescrol">
    <li class="sidebar-header">MAIN NAVIGATION</li> 
    @foreach (Auth::user()->roles as $role)
      @if ($role->name == 'System Admin')
        <li>
          <a href="{{ route('home') }}" class="waves-effect">
            <i class="fa fa-dashboard"></i> <span> Dashboard</span>
          </a>
        </li>
      @endif
      @if ($role->name == 'Weighing Officer')
        <li>
          <a href="{{ route('weighingofficer') }}" class="waves-effect">
            <i class="fa fa-dashboard"></i> <span> Dashboard</span>
          </a>
        </li>
      @endif
      @if ($role->name == 'National Admin')
        <li>
          <a href="{{ route('nationaladmin') }}" class="waves-effect">
            <i class="fa fa-dashboard"></i> <span> Dashboard</span>
          </a>
        </li>
      @endif
      @if ($role->name == 'Station Admin')
        <li>
          <a href="{{ route('stationadmin') }}" class="waves-effect">
            <i class="fa fa-dashboard"></i> <span> Dashboard</span>
          </a>
        </li>
      @endif
      @if ($role->name == 'Regional Admin')
        <li>
          <a href="{{ route('regionaladmin') }}" class="waves-effect">
            <i class="fa fa-dashboard"></i> <span> Dashboard</span>
          </a>
        </li>
      @endif
      @if ($role->name == 'Cashier')
        <li>
          <a href="{{ route('cashier') }}" class="waves-effect">
            <i class="fa fa-dashboard"></i> <span> Dashboard</span>
          </a>
        </li>
      @endif
      @if ($role->name == 'Overload Entry Clerk')
        <li>
          <a href="{{ route('overloadentryclerk') }}" class="waves-effect">
            <i class="fa fa-dashboard"></i> <span> Dashboard</span>
          </a>
        </li>
      @endif
    @endforeach
    
    @can('user.accessControl', Auth::user())
      <li>
        <a href="javaScript:void();" class="waves-effect"> 
          <i class="fa fa-users"></i> <span>Access</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          @can('user.accessPermissions', Auth::user())
            <li><a href="{{ route('permission.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> Permissions</a></li>
          @endcan
          @can('user.accessRoles', Auth::user())
            <li><a href="{{ route('role.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> Roles</a></li>
          @endcan
          @can('user.accessUsers', Auth::user())
            <li><a href="{{ route('user.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> Users</a></li>
          @endcan
        </ul>
      </li>
    @endcan
    
    @can('user.transactions', Auth::user())
      <li>
        <a href="{{ route('transaction.index') }}" class="waves-effect">
          <i class="fa fa-handshake-o"></i> <span> Transactions</span>
        </a>
      </li>
    @endcan
    
    @can('user.transactionEnquiry', Auth::user())
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fa fa-search-plus"></i> <span>Transaction Enquiry</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          @can('user.weighingEnquiry', Auth::user())
            <li><a href="{{ route('weighing.enquiry') }}"><i class="zmdi zmdi-long-arrow-right"></i> Weighing</a></li>
          @endcan
          @can('user.fineEnquiry', Auth::user())
            <li><a href="{{ route('fines.enquiry') }}"><i class="zmdi zmdi-long-arrow-right"></i> Fines</a></li>
          @endcan
        </ul>
      </li>
    @endcan
    
    @can('user.transactionFines', Auth::user())
      <li>
        <a href="{{ route('overloadcases.index') }}" class="waves-effect">
          <i class="fa fa-archive"></i> <span> Transaction Fines</span>
        </a>
      </li>
    @endcan
    
    @can('user.blacklistedVehicles', Auth::user())
      <li>
        <a href="{{ route('blacklist.index') }}" class="waves-effect">
          <i class="fa fa-times-rectangle"></i> <span> Blacklisted Vehicles</span>
        </a>
      </li>
    @endcan
    
    @can('user.reports', Auth::user())
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fa fa-database"></i> <span>Reports</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          {{-- @can('user.weighingEnquiry', Auth::user()) --}}
            <li><a href="{{ route('technical') }}"><i class="zmdi zmdi-long-arrow-right"></i> Technical</a></li>
          {{-- @endcan --}}
          {{-- @can('user.fineEnquiry', Auth::user()) --}}
            <li><a href="#"><i class="zmdi zmdi-long-arrow-right"></i> Financial</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
    @endcan
    
    @can('user.setups', Auth::user())
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fa fa-cog"></i> <span>Setups</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          @can('user.stationsSetup', Auth::user())
            <li><a href="{{ route('station.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> Stations</a></li>
          @endcan
          @can('user.typeOfVehiclesSetup', Auth::user())
            <li><a href="{{ route('vehicletype.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> Types of Vehicle</a></li>
          @endcan
          @can('user.commoditiesSetup', Auth::user())
            <li><a href="{{ route('commodity.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> Commodities</a></li>
          @endcan
          @can('user.heightSetup', Auth::user())
            <li><a href="{{ route('height.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> Height</a></li>
          @endcan
          @can('user.regionsSetup', Auth::user())
            <li><a href="{{ route('region.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> Regions</a></li>
          @endcan
          @can('user.finesSetup', Auth::user())
            <li><a href="{{ route('fine.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> Fines</a></li>
          @endcan
          @can('user.generalSettingsSetup', Auth::user())
            <li><a href="{{ route('settings') }}"><i class="zmdi zmdi-long-arrow-right"></i> General Settings</a></li>
          @endcan
          {{-- <li><a href="{{ route('finetype.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> Type Of Fines</a></li> --}}
          @can('user.systemSetup', Auth::user())
            <li><a href="{{ route('system.index') }}"><i class="zmdi zmdi-long-arrow-right"></i> System</a></li>
          @endcan
        </ul>
      </li>
    @endcan

    <li>
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off"></i> <span>Logout</span>
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </li>
    
  </ul>
</div>
<!--End sidebar-wrapper-->