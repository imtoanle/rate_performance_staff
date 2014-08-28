@if(in_array(Route::currentRouteName(), array('listPermissions', 'listGroups', 'showGroup', 'listUsers', 'showUser', 'newUser', 'newVote', 'showVote', 'listJobTitles', 'listDepartments')))
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/select2_conquer.css')}}"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_conquer.css"/>
@endif

@if(in_array(Route::currentRouteName(), array('listPermissions', 'listGroups', 'showGroup', 'listUsers', 'listVotes', 'listUserVotes', 'listJobTitles', 'listDepartments')))
<link rel="stylesheet" href="{{asset('assets/plugins/data-tables/DT_bootstrap.css')}}"/>
@endif

@if(in_array(Route::currentRouteName(), array('showGroup', 'newGroup', 'showUser', 'newUser', 'newVote')))
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/jquery-multi-select/css/multi-select.css')}}"/>
@endif


@if(in_array(Route::currentRouteName(), array('showUser')))
<link href="{{asset('assets/css/pages/profile.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-conquer.css')}}"/>
@endif

@if(in_array(Route::currentRouteName(), array('newVote')))
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-datepicker/css/datepicker.css')}}"/>
@endif

<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-toastr/toastr.min.css')}}"/>