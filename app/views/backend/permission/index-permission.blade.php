@extends(Config::get('view.backend.master'))
@section('content')

<!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet box light-grey">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-globe"></i>Danh sách quyền
              </div>
            </div>
            <div class="portlet-body">
              <table class="table table-striped table-bordered table-hover" id="ajax-data-table">
              <thead>
              <tr>
                <th class="table-checkbox">
                  <input type="checkbox" class="group-checkable" data-set="#ajax-data-table .checkboxes"/>
                </th>
                <th>{{trans('all.name')}}</th>
                <th>{{trans('all.value')}}</th>
                <th>{{trans('all.desc')}}</th>
              </tr>
              </thead>
              <tbody>
              @foreach($permissions as $permission)
              <tr class="odd gradeX">
                <td>
                  <div class="checker">
                    <span>
                      <input type="checkbox" class="checkboxes" value="{{$permission->id}}"/>
                    </span>
                  </div>
                </td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->value}}</td>
                <td>{{$permission->description}}</td>
              </tr>
              @endforeach
              </tbody>
              </table>
            </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->

<script>
jQuery(document).ready(function() {   
  
  var TableManaged = function () {

    return {

        //main function to initiate the module
        init: function () {
            
            if (!jQuery().dataTable) {
                return;
            }

            // begin first table
            $('#ajax-data-table').dataTable({
                "aoColumns": [
                  { "bSortable": false },
                  null,
                  null,
                  null,
                ],
                "aLengthMenu": [
                    [10, 20, 30, -1],
                    [10, 20, 30, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 10,
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sProcessing": '<i class="fa fa-coffee"></i>&nbsp;{{trans('all.please-wait')}}',
                    "sLengthMenu": "_MENU_ records",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });
        }
    };
  }();

  TableManaged.init();
});
</script>
@stop