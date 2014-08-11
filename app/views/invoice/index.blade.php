@extends(Config::get('view.master'))
@section('content')
<div class="container">

		<div class="row">
			@include(Config::get('view.setting-nav'))
			<div class="col-md-9">
			<div class="tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#popularPosts">{{trans('all.paid')}}</a></li>
					<li class=""><a data-toggle="tab" href="#recentPosts">{{trans('all.unpaid')}}</a></li>
				</ul>
				<div class="tab-content text-left">
					<div id="popularPosts" class="tab-pane active">
						<table class="table table-striped datatable" id="table-list-datas-paid">
					    <thead>
					        <tr class="replace-inputs">
					            <th>#ID</th>
					            <th>{{ trans('all.date')}}</th>
					            <th>{{trans('all.due-date')}}</th>
					            <th>{{trans('all.paid-date')}}</th>
					            <th>{{trans('all.total')}}</th>
					            <th>{{ trans('all.status')}}</th>
					            <th>{{ trans('all.actions')}}</th>
					        </tr>
					    </thead>
					    
					    <tbody>
					    	
					    </tbody>
					</table>
					</div>
					<div id="recentPosts" class="tab-pane">
						<table class="table table-striped datatable" id="table-list-datas-unpaid">
					    <thead>
					        <tr class="replace-inputs">
					            <th>#ID</th>
					            <th>{{ trans('all.date')}}</th>
					            <th>{{trans('all.due-date')}}</th>
					            <th>{{trans('all.paid-date')}}</th>
					            <th>{{trans('all.total')}}</th>
					            <th>{{ trans('all.status')}}</th>
					            <th>{{ trans('all.actions')}}</th>
					        </tr>
					    </thead>
					    
					    <tbody>
					    	
					    </tbody>
					</table>
					</div>
				</div>
			</div>
			</div>



	

</div>


<script type="text/javascript">
jQuery(window).load(function()
{
    var $ = jQuery;
    table = $("#table-list-datas-paid").dataTable({
        "sPaginationType": "bootstrap",
        "sDom": "t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
        "iDisplayLength": 10,
        "bServerSide": true,
        "sAjaxSource": "<?php echo URL::route('my-invoice') ?>",
        "sServerMethod": "POST",
        "fnServerParams": function ( aoData ) {
		      aoData.push( { "name": "order_by_col", "value": "id" } );
		      aoData.push( { "name": "order_dir", "value": "desc" } );
		      aoData.push( { "name": "invoice_status", "value": "2" } );
		    },
        "bAutoWidth": false,
        "aoColumns": [
            {"sWidth": "5%", "bSortable": false},
            { "bSortable": false, "sWidth": "10%" },
            { "sWidth": "10%", "bSortable": false},
            { "sWidth": "15%", "bSortable": false },
            { "bSortable": false, "sWidth": "8%" },
            { "bSortable": false, "sWidth": "1%" },
            { "bSortable": false, "sWidth": "5%" }
        ]
    });

    table = $("#table-list-datas-unpaid").dataTable({
        "sPaginationType": "bootstrap",
        "sDom": "t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
        "iDisplayLength": 10,
        "bServerSide": true,
        "sAjaxSource": "<?php echo URL::route('my-invoice') ?>",
        "sServerMethod": "POST",
        "fnServerParams": function ( aoData ) {
		      aoData.push( { "name": "order_by_col", "value": "id" } );
		      aoData.push( { "name": "order_dir", "value": "desc" } );
		      aoData.push( { "name": "invoice_status", "value": "1" } );
		    },
        "bAutoWidth": false,
        "aoColumns": [
            {"sWidth": "5%", "bSortable": false},
            { "bSortable": false, "sWidth": "10%" },
            { "sWidth": "10%", "bSortable": false},
            { "sWidth": "15%", "bSortable": false },
            { "bSortable": false, "sWidth": "8%" },
            { "bSortable": false, "sWidth": "1%" },
            { "bSortable": false, "sWidth": "5%" }
        ]
    });

});
</script>
@stop
