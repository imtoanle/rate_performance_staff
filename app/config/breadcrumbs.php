<?php 

return array(
    'indexDashboard' => array(
        array('fa fa-home',trans('all.dashboard'), '', 'last'),
        ),

    'listVotes' => array(
        array('fa fa-bar-chart-o',trans('all.votes'), ''),
        array('', trans('all.vote-manage'), route('listVotes'), 'last'),
        ),

    'listUserVotes' => array(
        array('fa fa-bar-chart-o',trans('all.votes'), ''),
        array('', trans('all.view-vote'), route('listUserVotes'), 'last'),
        ),

    'listRoles' => array(
        array('fa fa-bar-chart-o',trans('all.votes'), ''),
        array('', trans('all.role'), route('listRoles'), 'last'),
        ),

    'listCriterias' => array(
        array('fa fa-bar-chart-o',trans('all.votes'), ''),
        array('', trans('all.criteria'), route('listCriterias'), 'last'),
        ),

    //user vote mark
    'quickUserVote' => array(
        array('fa fa-paint-brush',trans('all.grading'), ''),
        array('', trans('all.quick-vote'), route('quickUserVote'), 'last'),
        ),

    'headGradingUserVote' => array(
        array('fa fa-paint-brush',trans('all.grading'), ''),
        array('', trans('all.head-of-grading'), route('headGradingUserVote'), 'last'),
        ),

    //report
    'listReportPeriod' => array(
        array('fa fa-line-chart',trans('all.report'), ''),
        array('', trans('all.reports-by-period'), route('listReportPeriod'), 'last'),
        ),

    'listReportYear' => array(
        array('fa fa-line-chart',trans('all.report'), ''),
        array('', trans('all.reports-by-year'), route('listReportYear'), 'last'),
        ),


    //user
    'listUsers' => array(
        array('fa fa-user',trans('all.user-manager'), ''),
        array('', trans('all.user'), route('listUsers'), 'last'),
        ),
    'importUsers' => array(
        array('fa fa-user',trans('all.user-manager'), ''),
        array('', 'Nhập thành viên', route('importUsers'), 'last'),
        ),
    'listJobTitles' => array(
        array('fa fa-user',trans('all.user-manager'), ''),
        array('', trans('all.job-title'), route('listJobTitles'), 'last'),
        ),

    'listDepartments' => array(
        array('fa fa-user',trans('all.user-manager'), ''),
        array('', trans('all.department'), route('listDepartments'), 'last'),
        ),

    'listGroups' => array(
        array('fa fa-user',trans('all.user-manager'), ''),
        array('', trans('all.group'), route('listGroups'), 'last'),
        ),

    'listPermissions' => array(
        array('fa fa-user',trans('all.user-manager'), ''),
        array('', trans('all.permission'), route('listPermissions'), 'last'),
        ),
);

