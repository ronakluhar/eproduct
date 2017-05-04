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
<!--      <li class="{{ (Request::is('admin/create-user') || Request::is('admin/list-user')) ? 'active treeview' : 'treeview' }}">
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
      </li>-->
      <li class="{{ (Request::is('admin/importSchoolQuickFact') || Request::is('admin/list-school')) ? 'active treeview' : 'treeview' }}">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>School Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/school-list') ? 'active' : '' }}"><a href="{{url('admin/school-list')}}"><i class="fa fa-circle-o"></i>Schools List</a></li>        
          <li class="{{ Request::is('admin/import-school-apply-accepted') ? 'active' : '' }}"><a href="{{url('admin/import-school-apply-accepted')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_apply_accepted')}}</a></li>
          <li class="{{ Request::is('admin/import-school-award-level') ? 'active' : '' }}"><a href="{{url('admin/import-school-award-level')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_award_level')}}</a></li>
          <li class="{{ Request::is('admin/importSchoolCompletion') ? 'active' : '' }}"><a href="{{url('admin/importSchoolCompletion')}}"><i class="fa fa-circle-o"></i>School Completions</a></li>
          <li class="{{ Request::is('admin/importSchoolDiversity') ? 'active' : '' }}"><a href="{{url('admin/importSchoolDiversity')}}"><i class="fa fa-circle-o"></i>School Diversity</a></li>
          <li class="{{ Request::is('admin/importSchoolEndowment') ? 'active' : '' }}"><a href="{{url('admin/importSchoolEndowment')}}"><i class="fa fa-circle-o"></i>School Endowment</a></li>
          <li class="{{ Request::is('admin/importSchoolFaculty') ? 'active' : '' }}"><a href="{{url('admin/importSchoolFaculty')}}"><i class="fa fa-circle-o"></i>School Faculty</a></li>
          <li class="{{ Request::is('admin/import-school-field-of-study') ? 'active' : '' }}"><a href="{{url('admin/import-school-field-of-study')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_field_of_study')}}</a></li>          
          <li class="{{ Request::is('admin/import-school-financial-aid') ? 'active' : '' }}"><a href="{{url('admin/import-school-financial-aid')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_financial_aid')}}</a></li>          
          <li class="{{ Request::is('admin/import-school-graduation-rate-time') ? 'active' : '' }}"><a href="{{url('admin/import-school-graduation-rate-time')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_graduation_rate_time')}}</a></li>          
          <li class="{{ Request::is('admin/importSchoolLibrary') ? 'active' : '' }}"><a href="{{url('admin/importSchoolLibrary')}}"><i class="fa fa-circle-o"></i>School Library</a></li>          
          <li class="{{ Request::is('admin/import-school-net-price-in-state') ? 'active' : '' }}"><a href="{{url('admin/import-school-net-price-in-state')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_net_price_in_state')}}</a></li>
          <li class="{{ Request::is('admin/import-school-net-price-out-state') ? 'active' : '' }}"><a href="{{url('admin/import-school-net-price-out-state')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_net_price_out_state')}}</a></li>          
          <li class="{{ Request::is('admin/importSchoolQuickFact') ? 'active' : '' }}"><a href="{{url('admin/importSchoolQuickFact')}}"><i class="fa fa-circle-o"></i>School Quick Fact</a></li>          
          <li class="{{ Request::is('admin/import-school-ROTC') ? 'active' : '' }}"><a href="{{url('admin/import-school-ROTC')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_ROTC')}}</a></li>
          <li class="{{ Request::is('admin/import-school-sat-act-scores') ? 'active' : '' }}"><a href="{{url('admin/import-school-sat-act-scores')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_sat_act_scores')}}</a></li>          
          <li class="{{ Request::is('admin/import-school-students-to-faculty') ? 'active' : '' }}"><a href="{{url('admin/import-school-students-to-faculty')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_students_to_faculty')}}</a></li>
          <li class="{{ Request::is('admin/import-school-study-abroad') ? 'active' : '' }}"><a href="{{url('admin/import-school-study-abroad')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_study_abroad')}}</a></li>
          <li class="{{ Request::is('admin/import-school-teacher-certification') ? 'active' : '' }}"><a href="{{url('admin/import-school-teacher-certification')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_teacher_certification')}}</a></li>
          <li class="{{ Request::is('admin/import-school-tuition-fees') ? 'active' : '' }}"><a href="{{url('admin/import-school-tuition-fees')}}"><i class="fa fa-circle-o"></i>{{trans('admin.school_tuition_fees')}}</a></li>
        </ul>
      </li>
      <li class="{{ (Request::is('admin/upload-school-logo') || Request::is('admin/list-school-logo') || Request::is('admin/multiple-upload-image')) ? 'active treeview' : 'treeview' }}">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>{{trans('admin.schoolmanagement')}}</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/multiple-upload-image') ? 'active' : '' }}"><a href="{{url('admin/multiple-upload-image')}}"><i class="fa fa-circle-o"></i>{{trans('admin.lbl_upload_bulk_logo')}}</a></li>
          <li class="{{ Request::is('admin/upload-school-logo') ? 'active' : '' }}"><a href="{{url('admin/upload-school-logo')}}"><i class="fa fa-circle-o"></i>{{trans('admin.lbl_upload_logo')}}</a></li>
          <li class="{{ Request::is('admin/school-logo-list') ? 'active' : '' }}"><a href="{{url('admin/school-logo-list')}}"><i class="fa fa-circle-o"></i> {{trans('admin.lbl_school_logo_list')}}</a></li>
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