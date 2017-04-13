<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('css/admin/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><a href="{{url('/admin/user-profile')}}">{{ucfirst(Auth::guard('admin')->user()->first_name)}}</a></p>
        <a href="{{url('/admin/user-profile')}}"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu">
      <li class="header"><center>=================================</center></li>
      <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{url('admin/dashboard')}}"><i class="fa fa-circle-o text-red"></i> <span>Dashboard</span></a></li>
      <li class="{{ (Request::is('admin/create-user') || Request::is('admin/list-user')) ? 'active treeview' : 'treeview' }}">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>{{trans('admin.usermanagement')}}</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/create-user') ? 'active' : '' }}"><a href="{{url('admin/create-user')}}"><i class="fa fa-circle-o"></i>{{trans('admin.createuser')}}</a></li>
          <li class="{{ Request::is('admin/list-user') ? 'active' : '' }}"><a href="{{url('admin/list-user')}}"><i class="fa fa-circle-o"></i> {{trans('admin.userlist')}}</a></li>
        </ul>
      </li>
      <li class="{{ (Request::is('admin/importSchoolQuickFact') || Request::is('admin/list-school')) ? 'active treeview' : 'treeview' }}">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>School Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/importSchoolQuickFact') ? 'active' : '' }}"><a href="{{url('admin/importSchoolQuickFact')}}"><i class="fa fa-circle-o"></i>School Fact Import</a></li>
          <li class="{{ Request::is('admin/list-school') ? 'active' : '' }}"><a href="{{url('admin/list-school')}}"><i class="fa fa-circle-o"></i>Schools List</a></li>
        </ul>
      </li>
<!--      <li class="{{ (Request::is('admin/create-email-template') || Request::is('admin/list-email-template')) ? 'active treeview' : 'treeview' }}">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>{{trans('admin.emailtemplate')}}</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/create-email-template') ? 'active' : '' }}"><a href="{{url('admin/create-email-template')}}"><i class="fa fa-circle-o"></i> {{trans('admin.createemailtemplate')}}</a></li>
          <li class="{{ Request::is('admin/list-email-template') ? 'active' : '' }}"><a href="{{url('admin/list-email-template')}}"><i class="fa fa-circle-o"></i>{{trans('admin.emailtemplatelist')}}</a></li>
        </ul>
      </li>-->
      <!--<li class="{{ (Request::is('admin/list-cms-template') || Request::is('admin/create-cms-template')) ? 'active treeview' : 'treeview' }}">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>{{trans('admin.cms')}}</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/list-cms-template') ? 'active' : '' }}"><a href="{{url('admin/list-cms-template')}}"><i class="fa fa-circle-o"></i> {{trans('admin.cmslist')}}</a></li>
          <li class="{{ Request::is('admin/create-cms-template') ? 'active' : '' }}"><a href="{{url('admin/create-cms-template')}}"><i class="fa fa-circle-o"></i>{{trans('admin.createcms')}}</a></li>
        </ul>
      </li>-->
    </ul>
  </section>
</aside>