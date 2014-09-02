<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>{{trans('all.copy-vote-group')}}
    </div>
  </div>
  <div class="portlet-body form">
    <!-- BEGIN FORM-->
    <form action="{{route('postCopyVoteGroup', $vote_group_id)}}" class="form-horizontal base-ajax-form" type="POST">
      <div class="form-body">
        <h3 class="form-section">{{trans('all.info-vote-group')}}</h3>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.vote-code')}}</label>
          <div class="col-md-8">
            <input type="text" name="vote_code" class="form-control" placeholder="VD: VOTE102014">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.title')}}</label>
          <div class="col-md-8">
            <input type="text" name="title" class="form-control" placeholder="VD: Đánh giá nhân viên tháng xx">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.head-department')}}</label>
          <div class="col-md-8">
            <input type="hidden" name="head_department" id="head_department" class="form-control select2">
          </div>
        </div>

      </div>
      <div class="form-actions right">
        <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> {{trans('all.save')}}</button>
      </div>
    </form>
    <!-- END FORM-->
  </div>
</div>

@include(Config::get('view.backend.footer-js'))
<script>
jQuery(document).ready(function() {   

  $('#head_department').select2({
    placeholder: "{{trans('all.select-head-department')}}",
    minimumInputLength: 1,
    ajax: {
      url: "{{route('listUsersSearch')}}",
      dataType: 'json',
      data: function(term, page) {
        return {
          q: term,
          page_limit: 10,
        };
      },
      results: function (data, page) {
        return { results: data };
      }
    },
    formatResult: markup_result, // omitted for brevity, see the source of this page
    //dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
  });

});

function markup_result(user, data1, query){
  var markup = '\
    <div class="row">\
      <div class="col-md-3">\
        <i class="fa fa-user"></i>'+ user.text.replace(new RegExp('(' + query.term + ')', 'gi'), '<b class="color-success">$1</b>') + '\
      </div>\
      <div class="col-md-3">\
        <i class="fa fa-credit-card"></i> '+ user.full_name.replace(new RegExp('(' + query.term + ')', 'gi'), '<b class="color-success">$1</b>') +'\
      </div>\
      <div class="col-md-6">\
        <i class="fa fa-group"></i> '+ user.job_title_name +'\
      </div>\
    </div>';
  
  return markup;
}
</script>