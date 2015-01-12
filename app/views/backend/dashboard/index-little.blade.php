<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->


<div class="row ">
  <div class="col-md-8">
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-bell"></i>Đang đánh giá
        </div>
      </div>
      <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover">
          <thead>
          <tr>
            <th style="width: 25%">Mã đánh giá</th>
            <th style="width: 35%">Tiêu đề / Phòng ban</th>
          </tr>
          </thead>
          <tbody>
          @foreach($canVoter->groupBy('vote_group_id') as $voteGroupId => $votes)
          <?php $voteGroup = VoteGroup::find($voteGroupId); ?>
          <tr>
            <td>{{$voteGroup->vote_code}}</td>
            <td>
              {{$voteGroup->title}}<br />
              <b>Phòng ban:</b><br />
              @foreach($votes as $vote)
                {{$vote->department->name}} {{CustomHelper::check_already_vote($vote, $currentUser->id)}}
                <a href="{{route('quickUserVote')}}?show_vote_data={{$voteGroup->id}},{{$vote->id}}" class="btn btn-default btn-xs">Chấm điểm</a><br />
              @endforeach
            </td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
  <div class="portlet tasks-widget">
    <div class="portlet-title">
      <div class="caption">
        <i class="fa fa-bell"></i>Thông báo
      </div>
    </div>
    <div class="portlet-body">
      <div class="scroller" style="overflow: hidden; width: auto; height: 250px;" data-always-visible="1" data-rail-visible="0">
        <ul class="feeds">
          @foreach($notifys as $notify)
          <li>
            <div class="col1">
              <div class="cont">
                <div class="cont-col1">
                  <div class="label label-sm label-success">
                    <i class="fa fa-bell"></i>
                  </div>
                </div>
                <div class="cont-col2">
                  <div class="desc">
                     {{$notify->content}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col2">
              <div class="date">
                 {{$notify->created_at->diffForHumans()}}
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>  
</div>
<div class="row">

</div>
<div class="clearfix">



@include(Config::get('view.backend.footer-js'))
<script>

//jQuery(document).ready(function() {   

//});

</script>
