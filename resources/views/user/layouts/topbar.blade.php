<!--Start topbar header-->
<header class="topbar-nav">
  <nav class="navbar navbar-expand fixed-top">
    <ul class="navbar-nav mr-auto align-items-center">
      <li class="nav-item">
        <a class="nav-link toggle-menu" href="javascript:void();">
          <i class="icon-menu menu-icon"></i>
        </a>
      </li>
    </ul>
    <div style="align-content: center; color: red;">
      <h5 style="color:#dc0b3e; align-items:center;">{{$company->company_name}}</h5>
      <h6 style="color:#dc0b3e;">({{$company->system_name}})</h6>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
    <ul class="navbar-nav align-items-center right-nav-link">
    
      {{-- <li class="nav-item language">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
        <ul class="dropdown-menu dropdown-menu-right">
            <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
            <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
            <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
            <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
          </ul>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="dashboard-service-support.html#">
          <span class="user-profile"><img src="{{ asset('theme/assets/images/avatars/defaultavatar.png') }}" class="img-circle" alt="user avatar"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
          {{-- <li class="dropdown-item user-details">
            <a href="javaScript:void();">
             <div class="media">
               <div class="avatar"><img class="align-self-start mr-3" src="{{ asset('theme/assets/images/avatars/avatar-13.png') }}" alt="user avatar"></div>
              <div class="media-body">
              <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
              <p class="user-subtitle">mccoy@example.com</p>
              </div>
             </div>
            </a>
          </li> --}}
          {{-- <li class="dropdown-divider"></li> --}}
          <li class="dropdown-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-power-off"></i> <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</header>
<!--End topbar header-->