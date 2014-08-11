@extends(Config::get('view.master'))
@section('content')
<div class="container">

		<div class="row">
			<div class="tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="shortcodes.html#popularPosts"><i class="icon icon-bars"></i> {{trans('all.service-imei')}}</a></li>
					<li class=""><a data-toggle="tab" href="shortcodes.html#recentPosts">Recent</a></li>
				</ul>
				<div class="tab-content text-left">
					<div id="popularPosts" class="tab-pane active">
						<table class="table table-striped datatable" id="table-list-datas">
					    <thead>
					        <tr class="replace-inputs">
					            <th>Id</th>
					            <th>{{ trans('all.all')}}</th>
					            <th>{{trans('all.services')}}</th>
					            <th>IMEI</th>
					            <th>{{ trans('all.code')}}</th>
					            <th>{{ trans('all.actions')}}</th>
					        </tr>
					    </thead>
					    
					    <tbody>
					    	
					    </tbody>
					</table>
					</div>
					<div id="recentPosts" class="tab-pane">
						<ul class="simple-post-list">
							<li>
								<div class="post-image">
									<div class="img-thumbnail">
										<a href="blog-post.html">
											<img alt="" src="img/blog/blog-thumb-2.jpg">
										</a>
									</div>
								</div>
								<div class="post-info">
									<a href="blog-post.html">Vitae Nibh Un Odiosters</a>
									<div class="post-meta">
											Jan 10, 2013
									</div>
								</div>
							</li>
							<li>
								<div class="post-image">
									<div class="img-thumbnail">
										<a href="blog-post.html">
											<img alt="" src="img/blog/blog-thumb-3.jpg">
										</a>
									</div>
								</div>
								<div class="post-info">
									<a href="blog-post.html">Odiosters Nullam Vitae</a>
									<div class="post-meta">
											Jan 10, 2013
									</div>
								</div>
							</li>
							<li>
								<div class="post-image">
									<div class="img-thumbnail">
										<a href="blog-post.html">
											<img alt="" src="img/blog/blog-thumb-1.jpg">
										</a>
									</div>
								</div>
								<div class="post-info">
									<a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>
									<div class="post-meta">
											Jan 10, 2013
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>



	

</div>


<script type="text/javascript">
jQuery(window).load(function()
{
    var $ = jQuery;
    table = $("#table-list-datas").dataTable({
        "sPaginationType": "bootstrap",
        "sDom": "t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
        "iDisplayLength": 10,
        "bServerSide": true,
        "sAjaxSource": "<?php echo URL::route('orders-history') ?>",
        "sServerMethod": "POST",
        "fnServerParams": function ( aoData ) {
		      aoData.push( { "name": "order_by_col", "value": "id" } );
		      aoData.push( { "name": "order_dir", "value": "desc" } );
		    },
        "bAutoWidth": false,
        "aoColumns": [
            {"sWidth": "5%", "bSortable": false},
            { "bSortable": false, "sWidth": "15%" },
            { "sWidth": "30%", "bSortable": false},
            { "sWidth": "30%", "bSortable": false },
            { "bSortable": false },
            { "bSortable": false, "sWidth": "190px" }
        ]
    });

    table.columnFilter({
            "sPlaceHolder" : "head:after",
            aoColumns: [
                null,
                { type: "select", values: [
									{ value: '1', label: '{{ trans('all.orders-history-page.pending')}}'},
									{ value: '2', label: '{{ trans('all.orders-history-page.denied')}}'},
									{ value: '3', label: '{{ trans('all.orders-history-page.completed')}}'}
								]},
                null,
                { type: "text"},
                null,
                null
            ]
        });
    $(".dataTables_wrapper select").select2({
        minimumResultsForSearch: -1
    });

    
    // Replace Checboxes
    $(".pagination a").click(function(ev)
    {
        replaceCheckboxes();
    });
});
</script>
@stop
