@extends(Config::get('view.master'))
@section('content')
<div class="container">
		@include(Config::get('view.services-nav'))
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<div class="featured-box featured-box-secundary default info-content no-margin-top">
						<div class="box-content text-left">
							<div id="tabcontent">
								<div class="form-group">
									<div class="pull-left">
										<input type="text" name="search" id="searchservicebox" class='form-control'  placeholder="{{ trans('all.search-service')}}"/>
									</div>   
									<div class="pull-right">
										[ <span class="exp-col" onclick="expandall();">{{trans('all.expand-all')}}</span> | 
										<span class="exp-col" onclick="collapseall();">{{trans('all.collapse-all')}}</span> ]
									</div>
								</div>

							  <div class="accordion">
							  	@foreach($datas as $data)
							    <div class="accordion-group panel-default">
							      <div class="accordion-heading panel-heading">
											<h4 class="panel-title">
												<a href="#g{{$data[0]->id}}"  data-toggle="collapse" class="accordion-toggle">
													<i class="icon icon-usd"></i>
													{{ $data[0]->name }}
													<i class="icon icon-chevron-down pull-right"></i>
												</a>
											</h4>
										</div>

							      <div class="accordion-body collapse" id="g{{$data[0]->id}}">
							          <div class="accordion-inner">              
							            <table  class="table table-bordered table-striped">
							              <tr>
							                <th width="50%" align="left"> </th>
							                <th width="5%" align="left">{{trans('all.service-imei-page.type')}}</th>
							                <th width="15%" align="right">{{trans('all.service-imei-page.delivery-time')}}</th>
							              </tr>
							              @foreach($data[1] as $service)
								              <tr>
								            		<td>
								            			<a href="{{route('detail-imei-service', array($service->id, Str::slug($service->name)))}}" class="searchme">{{$service->name}}</a>
								          			</td>
								                <td align="center">
								                	<img src="{{asset('img/type-service/'.array_flip(Config::get('variable.type-service'))[$service->type].'.png')}}" title="{{array_flip(Config::get('variable.type-service'))[$service->type]}}"/>
								              	</td>
								            		<td align="right">1-6 Hours</td>
								              </tr>
							              @endforeach
							            </table> 
							       		</div>
							 			</div>  
									</div>   
									@endforeach     
							    <div style="clear:both"></div>
							  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>

<script>
(function($){
    $.fn.extend({        
        searchService: function(options) {
            var defaults = {
                searchBox: '#searchlistbox',
                searchObj: '.searchme'                                  
            }; 
                                           
            var options = $.extend(defaults, options);
           this.each(function() {            
                var o =options;             
                var obj = $(this);                                                                                       
                  $(o.searchBox).keyup(function(){                             
                    searchWord = $(this).val(); 
                    if (searchWord.length >= 1) {                        
                        $(o.searchObj,obj).each(function() {                            
                            text = $(this).text();                                                        
                            if (text.match(RegExp(searchWord, 'i'))) {
                                $(this).parents('tr,li').css({'display':'table-row'}).addClass('block');
                                expandall();                                                                      
                            }
                            else{
                                $(this).parents('tr,li').css({'display':'none'}).removeClass('block');                                        
                            }
                        });
                    }else{
                        $('tr,li',obj).css({'display':'table-row'}).addClass('block');       
                    }
                    
                    $('.accordion-group').not('.except').each(function(){
                       if($(this).find('.block').length=='0'){                                  
                          $(this).css({'display':'none'});  
                       }
                       else{
                           $(this).css({'display':'block'});  
                       } 
                    })
                                                                                                                                                                                         
                });                                                
            });
        }
    });
})(jQuery);

$(document).ready(function(){   
   $('.accordion').searchService({searchBox:'#searchservicebox'});               
});

function expandall(){
   $('.accordion-body').addClass('in');
}

function collapseall(){
    $('.accordion-body').removeClass('in');            
}
  </script>
@stop