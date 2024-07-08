<header class="main-header">
  <!-- Logo -->
  <a href="{{ route('dashboard') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>PT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>Panel</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{-- <i class="fa fa-bell-o"></i> --}}
            <i class="fa-regular fa-bell"></i>           

            <span class="label label-warning">{{ Auth::user()->unreadNotifications->count() }}</span>
          </a>
          {{-- @foreach (Auth::user()->unreadNotifications as $value)
            @dd($value->data['data'])
          @endforeach --}}
          <ul class="dropdown-menu">
            <li class="header">You have {{ Auth::user()->unreadNotifications->count() }} notifications</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                @foreach (Auth::user()->unreadNotifications as $value)
                @php
                    $feedback = $value->data['data'];
                @endphp
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i>{{ Str::limit($feedback['description'], 20, '...') ?? '' }} - {{ $feedback['subject'] ?? '' }} -  {{ $feedback['admin'] ?? '' }}
                    </a>
                  </li>
                @endforeach
                
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(!empty(Auth::user()->image) )
               <img src="{{asset(Auth::user()->image) }}" class="user-image" alt="User Image">
              @else
                 <img src="{{asset('img/user.jpg') }}" class="user-image" alt="User Image">
              @endif

            {{-- <span class="hidden-xs">Alexander Pierce</span> --}}
            <span class="hidden-xs">{{ ucfirst(Auth::user()->name) }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              @if(!empty(Auth::user()->image) )
              <img src="{{asset(Auth::user()->image) }}" class="img-circle" alt="User Image">
            @else
                <img src="{{asset('img/user.jpg') }}" class="user-image" alt="User Image">
            @endif
              <p>
                {{ ucfirst(Auth::user()->name) }} - {{ ucfirst(Auth::user()->role_type) }}
                <small>Member since {{ (Auth::user()->created_at) }}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="#" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>