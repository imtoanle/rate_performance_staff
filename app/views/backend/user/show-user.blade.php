<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<!-- BEGIN PAGE CONTENT-->
      <div class="row profile">
        <div class="col-md-12">
          <!--BEGIN TABS-->
          <div class="tabbable tabbable-custom">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="page_profile.html#tab_1_1" data-toggle="tab">{{trans('all.overview')}}</a>
              </li>
              <li>
                <a href="page_profile.html#tab_1_3" data-toggle="tab">{{trans('all.account')}}</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1_1">
                <div class="row">
                  <div class="col-md-3">
                    <div class="profile-info">
                      <h1>{{$user->full_name}}</h1>
                      <ul class="list-unstyled">
                        <li>
                          <strong><i class="fa fa-user"></i> {{trans('all.username')}}:</strong> {{$user->username}}
                        </li>
                        <li>
                          <strong><i class="fa fa-envelope"></i> {{trans('all.email')}}:</strong> {{$user->email}}
                        </li>
                      </ul>
                    </div>
                    <!--end row-->

                      <div class="row">
                      
                      <div class="col-md-12">
                        <div class="portlet sale-summary">
                          <div class="portlet-title">
                            <div class="caption">
                               {{trans('all.summary')}}
                            </div>
                          </div>
                          <div class="portlet-body">
                            <ul class="list-unstyled">
                              <li>
                                <span class="sale-info">{{trans('all.avg-mark')}}</span>
                                <span class="sale-num">10</span>
                              </li>
                              <li>
                                <span class="sale-info">{{trans('all.last-mark')}}</span>
                                <span class="sale-num">10</span>
                              </li>
                              <li>
                                <span class="sale-info">{{trans('all.wage-coefficient')}}</span>
                                <span class="sale-num">10</span>
                              </li>
                              <li>
                                <span class="sale-info">{{trans('all.salary')}}</span>
                                <span class="sale-num">10</span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <!--end col-md-4-->
                    </div>
                    <!--end row-->
                  </div>
                  <div class="col-md-9">
                    <div class="tabbable tabbable-custom tabbable-custom-profile">
                      <ul class="nav nav-tabs">
                        <li class="active">
                          <a href="page_profile.html#tab_1_11" data-toggle="tab">{{trans('all.lastest-vote')}}</a>
                        </li>
                        <li>
                          <a href="page_profile.html#tab_1_22" data-toggle="tab">{{trans('all.feed')}}</a>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_11">
                          <div class="portlet-body">
                            <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <tr>
                              <th>
                                <i class="fa fa-briefcase"></i> Company
                              </th>
                              <th class="hidden-xs">
                                <i class="fa fa-question-sign"></i> Descrition
                              </th>
                              <th>
                                <i class="fa fa-bookmark"></i> Amount
                              </th>
                              <th>
                              </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                              <td>
                                <a href="page_profile.html#">Pixel Ltd</a>
                              </td>
                              <td class="hidden-xs">
                                 Server hardware purchase
                              </td>
                              <td>
                                 52560.10$
                                <span class="label label-success label-sm">
                                   Paid
                                </span>
                              </td>
                              <td>
                                <a class="btn btn-default btn-xs green-stripe" href="page_profile.html#">View</a>
                              </td>
                            </tr>
                            </tbody>
                            </table>
                          </div>
                        </div>
                        <!--tab-pane-->
                        <div class="tab-pane" id="tab_1_22">
                          <div class="tab-pane active" id="tab_1_1_1">
                            <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                              <ul class="feeds">
                                <li>
                                  <div class="col1">
                                    <div class="cont">
                                      <div class="cont-col1">
                                        <div class="label label-success">
                                          <i class="fa fa-bell"></i>
                                        </div>
                                      </div>
                                      <div class="cont-col2">
                                        <div class="desc">
                                           You have 4 pending tasks.
                                          <span class="label label-danger label-sm">
                                             Take action <i class="fa fa-share-alt"></i>
                                          </span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col2">
                                    <div class="date">
                                       Just now
                                    </div>
                                  </div>
                                </li>
                                
                              </ul>
                            </div>
                          </div>
                        </div>
                        <!--tab-pane-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--tab_1_2-->
              <div class="tab-pane" id="tab_1_3">
                <div class="row profile-account">
                  <div class="col-md-3">
                    <ul class="ver-inline-menu tabbable margin-bottom-10">
                      <li class="active">
                        <a data-toggle="tab" href="page_profile.html#tab_1-1">
                        <i class="fa fa-cog"></i> {{trans('all.personal-info')}} </a>
                        <span class="after">
                        </span>
                      </li>
                      <li>
                        <a data-toggle="tab" href="page_profile.html#tab_3-3"><i class="fa fa-lock"></i> {{trans('all.change-pass')}}</a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="page_profile.html#tab_4-4"><i class="fa fa-eye"></i> {{trans('all.privacity-setting')}}</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-9">
                    <div class="tab-content">
                      <div id="tab_1-1" class="tab-pane active">
                        <form action="{{route('putUser', $user->id)}}" type="PUT" class="base-ajax-form">
                          <div class="form-group">
                            <label class="control-label">{{trans('all.full-name')}}</label>
                            <input type="text" class="form-control" name="full_name" value="{{$user->full_name}}" placeholder="{{trans('all.full-name')}}">
                          </div>
                          <div class="form-group">
                            <label class="control-label">{{trans('all.birth-date')}}</label>
                            <input type="text" name="birth_date" placeholder="dd/mm/yyyy" value="{{date('d/m/Y', strtotime(str_replace('-', '/', $user->birth_date)))}}" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">{{trans('all.mobile-number')}}</label>
                            <input type="text" name="mobile_number" value="{{$user->phone_num}}" data-inputmask="'mask': '9', 'repeat': 11, 'greedy' : false" placeholder="0905..." class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">{{trans('all.address')}}</label>
                            <input type="text" name="address" value="{{$user->address}}" placeholder="# Nha Trang, Khanh Hoa" class="form-control"/>
                          </div>
                          <input type="hidden" name="form_name" value="personal_info" />
                          <div class="margiv-top-10">
                            <button type="submit" class="btn btn-info">{{trans('all.update')}}</button>
                          </div>
                        </form>
                      </div>
                      <div id="tab_3-3" class="tab-pane">
                        <form action="{{route('putUser', $user->id)}}" type="PUT" class="base-ajax-form">
                          <div class="form-group">
                            <label class="control-label">{{trans('all.current-pass')}}</label>
                            <input type="password" name="current_password" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">{{trans('all.new-pass')}}</label>
                            <input type="password" name="new_password" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">{{trans('all.confirm-pass')}}</label>
                            <input type="password" name="confirm_password" class="form-control"/>
                          </div>
                          <input type="hidden" name="form_name" value="change_pass" />
                          <div class="margin-top-10">
                            <button type="submit" class="btn btn-info">{{trans('all.update')}}</button>
                          </div>
                        </form>
                      </div>
                      <div id="tab_4-4" class="tab-pane">
                        <!-- BEGIN FORM-->
                        <form action="{{route('putUser', $user->id)}}" type="PUT" class="form-horizontal base-ajax-form">
                          <div class="form-body text-left">
                            <div class="form-group">
                              <label class="col-md-2 control-label">{{trans('all.password')}}</label>
                              <div class="col-md-10">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                  </span>
                                  <input type="text" class="form-control" name="password" placeholder="{{trans('all.empty-to-keep-password')}}">
                                </div>
                              </div>
                            </div>


                            <div class="form-group">
                              <label class="control-label col-md-2">{{trans('all.department')}}</label>
                              <div class="col-md-10">
                                  <select id="select_department" name="select_department" class="form-control select2">
                                    <option></option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}" {{$department->id == $user->department ? 'selected' : ''}}>{{$department->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-2">{{trans('all.job-title')}}</label>
                              <div class="col-md-10">
                                  <select id="select_job_titles" name="select_job_titles" class="form-control select2" multiple>
                                    <?php $arrJobTitles = explode(',',$user->job_title); ?>
                                    @foreach($jobTitles as $job)
                                    <option value="{{$job->id}}" {{in_array($job->id, $arrJobTitles) ? 'selected' : ''}}>{{$job->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-2">{{trans('all.group')}}</label>
                              <div class="col-md-10">
                                  <select id="select_groups" name="select_groups" class="form-control select2" multiple>
                                    @foreach($groups as $group)
                                    <option value="{{$group->id}}" {{$user->inGroup($group) ? 'selected' : ''}}>{{$group->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>

                            @if($user->getId() !== $currentUser->getId())
                            <div class="form-group">
                              <label class="control-label col-md-2">{{trans('all.ban-user')}}</label>
                              <div class="col-md-10">
                                <div class="make-switch" data-on-label="<i class='fa fa-check'>
                                  </i>" data-off-label="<i class='fa fa-times'></i>"> <input type="checkbox" name="banned" {{ $throttle->isBanned() ? 'checked' : '' }} class="toggle"/>
                                </div>
                              </div>
                            </div>
                            @endif

                            <div class="form-group">
                              <div class="col-md-12" style="margin-bottom: 5px;">
                                <label class="col-md-offset-1 control-label">{{trans('all.permission')}}</label>
                                <label class="col-md-offset-5 control-label">{{trans('all.selected-permission')}}</label>
                              </div>

                              <div class="">
                                <div class="col-md-12">
                                  <select multiple="multiple" class="multi-select" id="select_permissions" name="select_permissions[]">
                                    @foreach($permissions as $permission)
                                    <?php
                                      $currentGroup = isset($tagGroup) ? $tagGroup : 'first';
                                      $tagGroup = explode("_", $permission->value)[0];
                                    ?>
                                    @if($tagGroup != $currentGroup)
                                      @if($currentGroup != 'first')
                                        </optgroup>
                                      @endif
                                    <optgroup label="{{trans('all.permission-group-name.'.$tagGroup)}}">
                                    @endif
                                      <option value="{{$permission->value}}" {{in_array($permission->value, $userPermissions) ? 'selected' : ''}}>{{$permission->name}}</option>
                                    @endforeach
                                    </optgroup>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <input type="hidden" name="form_name" value="privacy_manage" />
                          <div class="col-md-9">
                            <button type="submit" class="btn btn-info">{{trans('all.update')}}</button>
                          </div>
                        </form>
                        <!-- END FORM-->
                      </div>
                    </div>
                  </div>
                  <!--end col-md-9-->
                </div>
              </div>
              <!--end tab-pane-->
            </div>
          </div>
          <!--END TABS-->
        </div>
      </div>
      <!-- END PAGE CONTENT-->


@include(Config::get('view.backend.footer-js'))
<script>
jQuery(document).ready(function() {   
  $("input[name=mobile_number]").inputmask();
  $("input[name=birth_date]").inputmask("d/m/y", {
      "placeholder": "dd/mm/yyyy"
  });

  $('#select_permissions').multiSelect({
      selectableOptgroup: true
  });

  $('#select_groups, #select_job_titles').select2({
    placeholder: "{{trans('all.select-group')}}",
    allowClear: true
  });

  $('#select_department').select2({
    placeholder: "{{trans('all.department')}}",
    allowClear: true
  });
});

</script>
