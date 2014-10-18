<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->


<div class="row ">
  <div class="col-md-6 col-sm-6">
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-bell"></i>Đang đánh giá
        </div>
      </div>
      <div class="portlet-body">
        <!--BEGIN TABS-->
          <ul class="nav nav-tabs">
            <li class="active">
              <a href="#tab_voter" data-toggle="tab">Chấm điểm</a>
            </li>
            <li>
              <a href="#tab_entitled_vote" data-toggle="tab">Được đánh giá</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_voter">
              <div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible="0">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Mã đánh giá</th>
                    <th>Tiêu đề</th>
                    <th>Phòng ban</th>
                    <th>Công cụ</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($canVoter as $vote)
                  <?php $voteGroup = $vote->voteGroup; ?>
                  <tr>
                    <td>{{$voteGroup->vote_code}}</td>
                    <td>{{$voteGroup->title}}</td>
                    <td>{{$vote->department->name}}</td>
                    <td>
                      <a href="{{route('quickUserVote')}}" class="btn btn-default btn-xs">Xem</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="tab_entitled_vote">
              <div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible1="1">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Mã đánh giá</th>
                    <th>Tiêu đề</th>
                    <th>Phòng ban</th>
                    <th>Công cụ</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($canEntitled as $vote)
                  <?php $voteGroup = $vote->voteGroup; ?>
                  <tr>
                    <td>{{$voteGroup->vote_code}}</td>
                    <td>{{$voteGroup->title}}</td>
                    <td>{{$vote->department->name}}</td>
                    <td>
                      <a href="{{route('viewMyMark', $voteGroup->id)}}" class="btn btn-default btn-xs">Xem</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--END TABS-->
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6">
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
                      </span>
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
<div class="clearfix">



@include(Config::get('view.backend.footer-js'))
<script>

//jQuery(document).ready(function() {   

//});

</script>
