<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
@include(Config::get('view.backend.header-css'))
<!-- END PAGE LEVEL PLUGIN STYLES -->

<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>{{trans('all.create-vote')}}
    </div>
    <div class="tools">
      <a href="javascript:;" class="collapse"></a>
      <a href="form_layouts.html#portlet-config" data-toggle="modal" class="config"></a>
      <a href="javascript:;" class="reload"></a>
      <a href="javascript:;" class="remove"></a>
    </div>
  </div>
  <div class="portlet-body form">
    <!-- BEGIN FORM-->
    <form action="{{route('postNewVote')}}" class="horizontal-form base-ajax-form" type="POST">
      <div class="form-body">
        <h3 class="form-section">{{trans('all.vote-info')}}</h3>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label class="control-label">{{trans('all.title')}}</label>
              <input type="text" name="title" class="form-control" placeholder="VD: Đánh giá nhân viên tháng xx">
            </div>
          </div>
          <!--/span-->
          <div class="col-md-7">
            <div class="form-group">
              <label class="control-label">{{trans('all.entitled-vote')}}</label>
              <input type="hidden" name="select2_entitled_vote" id="select2_entitled_vote" class="form-control select2" multiple>
            </div>
          </div>
          <!--/span-->
        </div>
        <!--/row-->
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label class="control-label">{{trans('all.object-vote')}}</label>
              <select id="select_groups" name="select2_groups" class="form-control select2" multiple>
                @foreach($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!--/span-->
          <div class="col-md-7">
            <div class="form-group">
              <label class="control-label">{{trans('all.voter')}}</label>
              <input type="hidden" name="select2_voter" id="select2_voter" class="form-control select2" multiple>
            </div>
          </div>
          <!--/span-->
        </div>
        <!--/row-->
        
        
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

  $('select#select_groups').select2({
    placeholder: "Select an option",
    allowClear: true
  });  

  $('#select2_voter, #select2_entitled_vote').select2({
    multiple: true,
    minimumInputLength: 1,
    ajax: {
      url: "{{route('listUsersSearch')}}",
      dataType: 'json',
      data: function (term, page) {
        return {
          q: term,
          page_limit: 10,
          select_id: $(this).attr('id'),
          groups_id: $('#select_groups').val(),
        };
      },
      results: function (data, page) {
        return { results: data };
      }
    },
    formatResult: function(user, data1, query){
      var markup = '\
        <div class="row">\
          <div class="col-md-3">\
            <i class="fa fa-user"></i>'+ user.text.replace(new RegExp('(' + query.term + ')', 'gi'), '<b class="color-success">$1</b>') + '\
          </div>\
          <div class="col-md-3">\
            <i class="fa fa-credit-card"></i> '+ user.full_name.replace(new RegExp('(' + query.term + ')', 'gi'), '<b class="color-success">$1</b>') +'\
          </div>\
          <div class="col-md-6">\
            <i class="fa fa-group"></i> '+ user.group_name +'\
          </div>\
        </div>';
      
      return markup;
    }, // omitted for brevity, see the source of this page
    //formatSelection: function(user){ return user.text;}, // omitted for brevity, see the source of this page
    //dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
  });

});
</script>


                