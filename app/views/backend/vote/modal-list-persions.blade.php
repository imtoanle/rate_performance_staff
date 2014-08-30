<div class="row">
  <div class="col-md-12">
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-picture"></i>{{trans('all.entitled-vote')}}
        </div>
      </div>
      <div class="portlet-body">
        <div class="table-responsive">
          <table class="table table-condensed table-hover">
          <thead>
          <tr>
            <th>{{trans('all.username')}}</th>
            <th>{{trans('all.full-name')}}</th>
            <th>{{trans('all.job-title')}}</th>
          </tr>
          </thead>
          <tbody>
          @foreach($entitledVoteUsers as $user)
          <tr>
            <td>{{$user->username}}</td>
            <td>{{$user->full_name}}</td>
            <td>{{$user->job_titles_name()}}</td>
          </tr>
          @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-picture"></i>{{trans('all.voter')}}
        </div>
      </div>
      <div class="portlet-body">
        <div class="table-responsive">
          <table class="table table-condensed table-hover">
          <thead>
          <tr>
            <th>{{trans('all.username')}}</th>
            <th>{{trans('all.full-name')}}</th>
            <th>{{trans('all.job-title')}}</th>
            <th>{{trans('all.role')}}</th>
          </tr>
          </thead>
          <tbody>
          @foreach($voterUsers as $user)
          <tr>
            <td>{{$user->username}}</td>
            <td>{{$user->full_name}}</td>
            <td>{{$user->job_titles_name()}}</td>
            <td>{{$arrayVoterId[$user->id]}}</td>
          </tr>
          @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>