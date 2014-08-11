@extends(Config::get('view.master'))
@section('content')
<div class="container">

		<div class="row">
			@include(Config::get('view.setting-nav'))
			<div class="col-md-9">
			<div class="tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#popularPosts">{{trans('all.settings.statement')}}</a></li>
				</ul>
				<div class="tab-content text-left">
					<div id="popularPosts" class="tab-pane active">
						<table class="table table-striped datatable" id="table-list-datas-paid">
					    <thead>
					        <tr class="replace-inputs">
					            <th>{{ trans('all.date')}}</th>
					            <th>{{trans('all.description')}}</th>
					            <th>{{trans('all.service-imei-page.type')}}</th>
					            <th>{{trans('all.invoice-page.price')}}</th>
					            <th>{{ trans('all.add-fund-page.current-balance')}}</th>
					            <th>SID</th>
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
        "sAjaxSource": "<?php echo URL::route('my-statement') ?>",
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
            { "sWidth": "5%", "bSortable": false},
            { "sWidth": "5%", "bSortable": false },
            { "bSortable": false, "sWidth": "5%" },
            { "bSortable": false, "sWidth": "1%" },
        ]
    });

    table.columnFilter({
        "sPlaceHolder" : "head:after",
        aoColumns: [
            null,
            null,
            { type: "select", values: [
							{ value: '1', label: '{{ trans('all.statement-page.sort-type-addfund')}}'},
							{ value: '2', label: '{{ trans('all.statement-page.sort-type-refund')}}'},
							{ value: '3', label: '{{ trans('all.statement-page.sort-type-place-order')}}'}
						]},
            null,
            null,
            null
        ]
    });

});
</script>
@stop
