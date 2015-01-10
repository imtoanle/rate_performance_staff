<!-- BEGIN SIDEBAR MENU -->
<ul class="page-sidebar-menu">
  <li class="sidebar-toggler-wrapper">
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="sidebar-toggler">
    </div>
    <div class="clearfix">
    </div>
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
  </li>
  <li>
    <form class="search-form" role="form" action="index.html" method="get">
      <div class="input-icon right">
        <i class="fa fa-search"></i>
        <input type="text" class="form-control input-medium input-sm" name="query" placeholder="Search...">
      </div>
    </form>
  </li>

  <?php $arrRoutes = array('indexDashboard'); ?>
  {{ BackendSideBar::create_node(trans('all.dashboard'), 'indexDashboard', 'fa fa-home') }}  

  @if ( $currentUser->hasAnyAccess(['votes-management_list', 'role-management_list', 'criteria-management_list', 'rating-type-management_list']) )
  <?php $arrRoutes = array('listVotes', 'listRoles', 'listCriterias', 'listRatingTypes'); ?>
  {{ BackendSideBar::create_root_open(trans('all.votes'), $arrRoutes, 'fa fa-bar-chart-o')}}  
    @if ( $currentUser->hasAnyAccess(['votes-management_list']) )
      {{ BackendSideBar::create_node(trans('all.vote-manage'), 'listVotes', 'fa fa-list') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['role-management_list']) )
      {{ BackendSideBar::create_node(trans('all.role'), 'listRoles', 'fa fa-star') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['criteria-management_list']) )
      {{ BackendSideBar::create_node(trans('all.criteria'), 'listCriterias', 'fa fa-trophy') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['rating-type-management_list']) )
    <!--
      {{ BackendSideBar::create_node(trans('all.rating-type'), 'listRatingTypes', 'fa fa-trophy') }}  
    -->
    @endif
  {{ BackendSideBar::create_root_close() }} 
  @endif

  @if ( $currentUser->hasAnyAccess(['user-votes-management_list', 'user-votes-management_quick', 'user-votes-management_head-grading']) )
  <?php $arrRoutes = array('listUserVotes', 'quickUserVote', 'headGradingUserVote', 'anyUserVote'); ?>
  {{ BackendSideBar::create_root_open(trans('all.grading'), $arrRoutes, 'fa fa-paint-brush')}}  
    @if ( $currentUser->hasAnyAccess(['user-votes-management_list']) )
      {{ BackendSideBar::create_node(trans('all.view-vote'), 'listUserVotes', 'fa fa-signal') }}      
    @endif

    @if ( $currentUser->hasAnyAccess(['user-votes-management_quick']) )
      {{ BackendSideBar::create_node(trans('all.quick-vote'), 'quickUserVote', 'fa fa-check') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['user-votes-management_head-grading']) )
      {{ BackendSideBar::create_node(trans('all.head-of-grading'), 'headGradingUserVote', 'fa fa-legal') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['user-votes-management_quick']) )
      {{ BackendSideBar::create_node('Chấm điểm tự do', 'anyUserVote', 'fa fa-legal') }}  
    @endif
  {{ BackendSideBar::create_root_close() }} 
  @endif


  @if ( $currentUser->hasAnyAccess(['reports-management_period', 'reports-management_year', 'reports-management_specify-user']) )
  <?php $arrRoutes = array('listReportPeriod', 'listReportYear', 'listReportSpecifyUser'); ?>
  {{ BackendSideBar::create_root_open(trans('all.report'), $arrRoutes, 'fa fa-line-chart')}}  
    @if ( $currentUser->hasAnyAccess(['reports-management_period']) )
      {{ BackendSideBar::create_node(trans('all.reports-by-period'), 'listReportPeriod', 'fa fa-list') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['reports-management_year']) )
      {{ BackendSideBar::create_node(trans('all.reports-by-year'), 'listReportYear', 'fa fa-list') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['reports-management_specify-user']) )
      {{ BackendSideBar::create_node('Báo cáo được chỉ định', 'listReportSpecifyUser', 'fa fa-list') }}  
    @endif
  {{ BackendSideBar::create_root_close() }} 
  @endif

  @if ( $currentUser->hasAnyAccess(['users-management_list', 'users-management_import', 'job-titles-management_list', 'department-management_list', 'groups-management_list']) )
  <?php $arrRoutes = array('listPermissions', 'listJobTitles', 'listUsers', 'listGroups', 'listDepartments', 'importUsers'); ?>
  {{ BackendSideBar::create_root_open(trans('all.user-manager'), $arrRoutes, 'fa fa-user')}}  
    @if ( $currentUser->hasAnyAccess(['users-management_list']) )
      {{ BackendSideBar::create_node(trans('all.user'), 'listUsers', 'fa fa-user') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['users-management_import']) )
      {{ BackendSideBar::create_node(trans('all.import-users'), 'importUsers', 'fa fa-users') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['job-titles-management_list']) )
      {{ BackendSideBar::create_node(trans('all.job-title'), 'listJobTitles', 'fa fa-mortar-board') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['department-management_list']) )      
      {{ BackendSideBar::create_node(trans('all.department'), 'listDepartments', 'fa fa-sitemap') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['groups-management_list']) )
      {{ BackendSideBar::create_node(trans('all.group'), 'listGroups', 'fa fa-group') }}  
    @endif

    @if ( $currentUser->hasAnyAccess(['superadmin']) )
      {{ BackendSideBar::create_node(trans('all.permission'), 'listPermissions', 'fa fa-database') }}  
    @endif
  {{ BackendSideBar::create_root_close() }} 
  @endif

</ul>
<!-- END SIDEBAR MENU -->

