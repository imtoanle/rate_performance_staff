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

  <?php $arrRoutes = array('listVotes', 'listUserVotes', 'listRoles', 'listCriterias'); ?>
  {{ BackendSideBar::create_root_open(trans('all.votes'), $arrRoutes, 'fa fa-bar-chart-o')}}  
    {{ BackendSideBar::create_node(trans('all.vote-manage'), 'listVotes', 'fa fa-list') }}  
    {{ BackendSideBar::create_node(trans('all.view-vote'), 'listUserVotes', 'fa fa-signal') }}      
    
    {{ BackendSideBar::create_node(trans('all.role'), 'listRoles', 'fa fa-star') }}  
    {{ BackendSideBar::create_node(trans('all.criteria'), 'listCriterias', 'fa fa-trophy') }}  
  {{ BackendSideBar::create_root_close() }} 

  <?php $arrRoutes = array('quickUserVote', 'headGradingUserVote'); ?>
  {{ BackendSideBar::create_root_open(trans('all.grading'), $arrRoutes, 'fa fa-paint-brush')}}  
    {{ BackendSideBar::create_node(trans('all.quick-vote'), 'quickUserVote', 'fa fa-check') }}  
    {{ BackendSideBar::create_node(trans('all.head-of-grading'), 'headGradingUserVote', 'fa fa-legal') }}  
  {{ BackendSideBar::create_root_close() }} 


  <?php $arrRoutes = array('listReportPeriod', 'listReportYear'); ?>
  {{ BackendSideBar::create_root_open(trans('all.report'), $arrRoutes, 'fa fa-line-chart')}}  
    {{ BackendSideBar::create_node(trans('all.reports-by-period'), 'listReportPeriod', 'fa fa-list') }}  
    {{ BackendSideBar::create_node(trans('all.reports-by-year'), 'listReportYear', 'fa fa-list') }}  
  {{ BackendSideBar::create_root_close() }} 

  <?php $arrRoutes = array('listPermissions', 'listJobTitles', 'listUsers', 'listGroups', 'listDepartments'); ?>
  {{ BackendSideBar::create_root_open(trans('all.user-manager'), $arrRoutes, 'fa fa-user')}}  
    {{ BackendSideBar::create_node(trans('all.user'), 'listUsers', 'fa fa-user') }}  
    {{ BackendSideBar::create_node(trans('all.job-title'), 'listJobTitles', 'fa fa-mortar-board') }}  
    {{ BackendSideBar::create_node(trans('all.department'), 'listDepartments', 'fa fa-sitemap') }}  
    {{ BackendSideBar::create_node(trans('all.group'), 'listGroups', 'fa fa-group') }}  
    {{ BackendSideBar::create_node(trans('all.permission'), 'listPermissions', 'fa fa-database') }}  
  {{ BackendSideBar::create_root_close() }} 
</ul>
<!-- END SIDEBAR MENU -->

