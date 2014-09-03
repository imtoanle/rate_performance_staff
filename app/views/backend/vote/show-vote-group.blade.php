<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>{{trans('all.show-vote-group')}}
    </div>
  </div>
  <div class="portlet-body form">
    <!-- BEGIN FORM-->
    <form action="{{route('putVoteGroup', $voteGroup->id)}}" class="form-horizontal base-ajax-form" type="PUT">
      <div class="form-body">
        <h3 class="form-section">{{trans('all.info-vote-group')}}</h3>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.vote-code')}}</label>
          <div class="col-md-8">
            <input type="text" name="vote_code" value="{{$voteGroup->vote_code}}" class="form-control" placeholder="VD: VOTE102014">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.title')}}</label>
          <div class="col-md-8">
            <input type="text" name="title" value="{{$voteGroup->title}}" class="form-control" placeholder="VD: Đánh giá nhân viên tháng xx">
          </div>
        </div>

        <!--
        <div class="form-group">
          <label class="col-md-3 control-label">{{trans('all.head-department')}}</label>
          <div class="col-md-8">
            <input type="hidden" name="can_view_results" id="can_view_results" value="{{$voteGroup->head_department}}" class="form-control select2">
          </div>
        </div>
        -->

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

  $('#can_view_results').select2({
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
    initSelection: function(element, callback) {
        var id=$(element).val();
        if (id!=="") {
          $.ajax('{{route('listUsersSearch')}}', {
              data: {
                  single_user_id: id
              },
              dataType: "json"
          }).done(function (data) {
              callback(data);
          });
        }
    },
    formatResult: markup_result, // omitted for brevity, see the source of this page
    formatSelection: function(user){ return user.text;}, // omitted for brevity, see the source of this page
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


                