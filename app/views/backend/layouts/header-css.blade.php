@if(in_array(Route::currentRouteName(), array('listPermissions', 'listGroups', 'showGroup', 'listUsers', 'showUser', 'newUser', 'newVote', 'showVote', 'listJobTitles', 'listDepartments', 'listRoles', 'listCriterias', 'listRatingTypes', 'showVoteGroup', 'copyVoteGroup', 'listReportYear', 'quickUserVote', 'listUserVotes')))
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/select2_conquer.css')}}"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_conquer.css"/>
@endif

@if(in_array(Route::currentRouteName(), array('listPermissions', 'listGroups', 'showGroup', 'listUsers', 'listVotes', 'listUserVotes', 'listJobTitles', 'listDepartments', 'listRoles', 'listCriterias', 'listRatingTypes', 'listReportPeriod', 'headGradingUserVote', 'listReportSpecifyUser')))
<link rel="stylesheet" href="{{asset('assets/plugins/data-tables/DT_bootstrap.css')}}"/>
@endif

@if(in_array(Route::currentRouteName(), array('showGroup', 'newGroup', 'showUser', 'newUser', 'newVote', 'showVote')))
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/jquery-multi-select/css/multi-select.css')}}"/>
@endif


@if(in_array(Route::currentRouteName(), array('showUser')))
<link href="{{asset('assets/css/pages/profile.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-conquer.css')}}"/>
@endif

@if(in_array(Route::currentRouteName(), array('newVote', 'showVote')))
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-datepicker/css/datepicker.css')}}"/>
@endif

@if(in_array(Route::currentRouteName(), array('quickUserVote', 'headGradingUserVote')))
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}"/>
@endif

@if(in_array(Route::currentRouteName(), array('importUsers')))
<link href="{{asset('assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')}}" rel="stylesheet"/>
@endif

<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-toastr/toastr.min.css')}}"/>