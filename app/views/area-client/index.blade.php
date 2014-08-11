@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="col-md-12 featured-box featured-box-secundary">
		<div class="row">
			<div class="col-md-12 box-content clearfix">
				<div class="col-md-5">
					<div class="col-md-4">
						<img class="img-circle img-responsive" src="img/holder.png">
					</div>
					<div class="col-md-8 text-left">
						<div class="row"><i class="icon icon-user"></i> {{ Auth::user()->name}}</div>
						<div class="row"><i class="icon icon-envelope"></i> {{ Auth::user()->email}}</div>
						<div class="row"><i class="icon icon-phone"></i> {{ Auth::user()->phone }}</div>
						<div class="row"><i class="icon icon-map-marker"></i> {{ Auth::user()->address }} - {{ Auth::user()->city }} - {{ Auth::user()->state }} - {{ Auth::user()->country }}</div>
					</div>
				</div>

				<div class="col-md-offset-1 col-md-5">
					<div class="progress-bars text-left">
						<div class="progress-label">
							<span>{{trans('all.area-client-page.pending-order')}} ({{ $orderResults['count']['pending_order'] }})</span>
						</div>
						<div class="progress">
							<div class="progress-bar progress-bar-primary" data-appear-progress-animation="{{ $orderResults['percent']['pending_order'] }}%">
								<span class="progress-bar-tooltip">{{ $orderResults['percent']['pending_order'] }}%</span>
							</div>
						</div>
						<div class="progress-label">
							<span>{{trans('all.area-client-page.denied-order')}} ({{ $orderResults['count']['denied_order'] }})</span>

						</div>
						<div class="progress">
							<div class="progress-bar progress-bar-danger" data-appear-progress-animation="{{ $orderResults['percent']['denied_order'] }}%" data-appear-animation-delay="300">
								<span class="progress-bar-tooltip">{{ $orderResults['percent']['denied_order'] }}%</span>
							</div>
						</div>

						<div class="progress-label">
							<span>{{trans('all.area-client-page.completed-order')}} ({{ $orderResults['count']['completed_order'] }})</span>
						</div>
						<div class="progress">
							<div class="progress-bar progress-bar-warning" data-appear-progress-animation="{{ $orderResults['percent']['completed_order'] }}%" data-appear-animation-delay="300">
								<span class="progress-bar-tooltip">{{ $orderResults['percent']['completed_order'] }}%</span>
							</div>
						</div>
						
					</div>
				</div>

			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
			<div class="tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="shortcodes.html#popularPosts"><i class="icon icon-bars"></i> 20 {{trans('all.area-client-page.last-orders')}}</a></li>
					<li class=""><a data-toggle="tab" href="shortcodes.html#recentPosts">{{trans('all.latest-notice')}}</a></li>
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
						<div class="col-md-12">
						<div class="">
							<div class="row">
								<div class="owl-carousel" data-plugin-options='{"items": 1, "autoHeight": true}'>
								<?php $countBlogs = count($latestBlogs) ?>
								@for($i=0; $i<$countBlogs; $i++)
									<div>
										<div class="col-md-6">
											<article>
												<h4><a href="blog-post.html">{{$latestBlogs[$i]->title}}</a></h4>
												<p>&nbsp;{{$latestBlogs[$i]->content}}</p>
												<p>{{$latestBlogs[$i]->created_at->format('d/m/Y')}}</p>
											</article>
										</div>
									</div>
								@endfor
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>

		</div>
		</div>

		<div class="row">
			<div class="col-md-12 text-left login-log">
				<span><i class="icon icon-lock"></i> <strong>{{trans('all.area-client-page.last-login')}}</strong>: {{ $lastLogin->created_at->format('d/m/Y \, G:i A')}} - <strong>IP:</strong> {{$lastLogin->ip}} <button href="javascript:;" onclick="showLoginLogModal('{{route('get-login-logs')}}', 'modal-login-logs');" class="btn btn-info" type="button">{{trans('all.read-more')}}</button></span>
			</div>
		</div>
	

</div>



<!-- Modal 7 (Ajax Modal)-->
<div class="modal fade" id="modal-login-logs">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{trans('all.sign-in')}}</h4>
			</div>
			
			<div class="modal-body">
			
				{{trans('all.loading')}}
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-detail-order">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{trans('all.ajax-detail-order.detail-order')}}</h4>
			</div>
			
			<div class="modal-body">
			
				{{trans('all.loading')}}
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('all.close')}}</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function showLoginLogModal(action, modal, orderId)
{
	jQuery('#'+modal).modal('show', {backdrop: 'static'});
	
	$.ajax({
		url: action,
		data: 'orderId='+orderId,
		method: "post",
		success: function(response)
		{
			jQuery('#'+modal+' .modal-body').html(response);
		}
	});
}

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
		      aoData.push( { "name": "limit", "value": "20" } );
		    },
        "bAutoWidth": false,
        "aoColumns": [
            {"sWidth": "5%", "bSortable": false},
            { "bSortable": false, "sWidth": "10%" },
            { "sWidth": "25%", "bSortable": false},
            { "sWidth": "25%", "bSortable": false },
            { "sWidth": "30%", "bSortable": false },
            { "bSortable": false, "sWidth": "10%" }
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

