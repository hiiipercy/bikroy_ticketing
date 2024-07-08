  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(!empty(Auth::user()->image) )
          <img src="{{asset(Auth::user()->image) }}" class="img-circle" alt="User Image">
         @else
            <img src="{{asset('img/user.jpg') }}" class="img-circle" alt="User Image">
         @endif
        </div>
        <div class="pull-left info">
          <p>{{ ucfirst(Auth::user()->name) }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      @if(Auth::check() && Auth::user()->role_type == 'Admin')
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i><span> User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user.index') }}">User List</a></li>
            <li><a href="{{ route('user.create') }}">Add User</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-window-maximize"></i> <span>Subject</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('subject.index') }}">Subject List</a></li>
            <li><a href="{{ route('subject.create') }}">Add Subject</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-ticket"></i> <span>Ticket</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('ticket.index') }}">Ticket List</a></li>
            <li><a href="{{ route('ticket.create') }}">Add Ticket</a></li>
          </ul>
        </li>
      </ul>
      @endif

      @if(Auth::check() && Auth::user()->role_type == 'User')
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Ticket</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('ticket.index') }}">Ticket List</a></li>
            <li><a href="{{ route('ticket.create') }}">Create Ticket</a></li>
          </ul>
        </li>
      </ul>
      @endif
    </section>
  </aside>