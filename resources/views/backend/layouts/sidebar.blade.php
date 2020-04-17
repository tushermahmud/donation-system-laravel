<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/backend/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li><a href="{{route('donations.index')}}"><i class="fa fa-pencil"></i> <span>Donations</span></a></li>
        <li><a href="{{route('orders.index')}}"><i class="fa fa-folder"></i> <span>Orders</span></a></li>
        <li><a href="{{route('event.index')}}"><i class="fa fa-users"></i> <span>Events</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>