@extends(Config::get('view.master'))
@section('content')
<div id="content" class="content full">
	<div class="slider-container">
		<div class="slider" id="revolutionSlider">
			<ul>
				<li data-transition="fade" data-slotamount="13" data-masterspeed="300" >

					<img src="{{ asset('img/slides/slide-bg.jpg') }}" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

					<div class="tp-caption sft stb visible-lg"
						 data-x="72"
						 data-y="180"
						 data-speed="300"
						 data-start="1000"
						 data-easing="easeOutExpo"><img src="{{ asset('img/slides/slide-title-border.png') }}" alt=""></div>

					<div class="tp-caption top-label lfl stl"
						 data-x="122"
						 data-y="180"
						 data-speed="300"
						 data-start="500"
						 data-easing="easeOutExpo">DO YOU NEED A NEW</div>

					<div class="tp-caption sft stb visible-lg"
						 data-x="372"
						 data-y="180"
						 data-speed="300"
						 data-start="1000"
						 data-easing="easeOutExpo"><img src="{{ asset('img/slides/slide-title-border.png') }}" alt=""></div>

					<div class="tp-caption main-label sft stb"
						 data-x="30"
						 data-y="210"
						 data-speed="300"
						 data-start="1500"
						 data-easing="easeOutExpo">WEB DESIGN?</div>

					<div class="tp-caption bottom-label sft stb"
						 data-x="80"
						 data-y="280"
						 data-speed="500"
						 data-start="2000"
						 data-easing="easeOutExpo">Check out our options and features.</div>

					<div class="tp-caption randomrotate"
						 data-x="800"
						 data-y="248"
						 data-speed="500"
						 data-start="2500"
						 data-easing="easeOutBack"><img src="{{ asset('img/slides/slide-concept-2-1.png') }}" alt=""></div>

					<div class="tp-caption sfb"
						 data-x="850"
						 data-y="200"
						 data-speed="400"
						 data-start="3000"
						 data-easing="easeOutBack"><img src="{{ asset('img/slides/slide-concept-2-2.png') }}" alt=""></div>

					<div class="tp-caption sfb"
						 data-x="820"
						 data-y="170"
						 data-speed="700"
						 data-start="3150"
						 data-easing="easeOutBack"><img src="{{ asset('img/slides/slide-concept-2-3.png') }}" alt=""></div>

					<div class="tp-caption sfb"
						 data-x="770"
						 data-y="130"
						 data-speed="1000"
						 data-start="3250"
						 data-easing="easeOutBack"><img src="{{ asset('img/slides/slide-concept-2-4.png') }}" alt=""></div>

					<div class="tp-caption sfb"
						 data-x="500"
						 data-y="80"
						 data-speed="600"
						 data-start="3450"
						 data-easing="easeOutExpo"><img src="{{ asset('img/slides/slide-concept-2-5.png') }}" alt=""></div>

					<div class="tp-caption blackboard-text lfb "
						 data-x="530"
						 data-y="300"
						 data-speed="500"
						 data-start="3450"
						 data-easing="easeOutExpo" style="font-size: 37px;">Think</div>

					<div class="tp-caption blackboard-text lfb "
						 data-x="555"
						 data-y="350"
						 data-speed="500"
						 data-start="3650"
						 data-easing="easeOutExpo" style="font-size: 47px;">Outside</div>

					<div class="tp-caption blackboard-text lfb "
						 data-x="580"
						 data-y="400"
						 data-speed="500"
						 data-start="3850"
						 data-easing="easeOutExpo" style="font-size: 32px;">The box :)</div>
				</li>
				<li data-transition="fade" data-slotamount="5" data-masterspeed="1000" >

					<img src="{{ asset('img/slides/slide-bg.jpg') }}" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

						<div class="tp-caption fade"
							 data-x="50"
							 data-y="100"
							 data-speed="1500"
							 data-start="500"
							 data-easing="easeOutExpo"><img src="{{ asset('img/slides/slide-concept.png') }}" alt=""></div>

						<div class="tp-caption blackboard-text fade "
							 data-x="180"
							 data-y="180"
							 data-speed="1500"
							 data-start="1000"
							 data-easing="easeOutExpo" style="font-size: 30px;">easy to</div>

						<div class="tp-caption blackboard-text fade "
							 data-x="180"
							 data-y="220"
							 data-speed="1500"
							 data-start="1200"
							 data-easing="easeOutExpo" style="font-size: 40px;">customize!</div>

						<div class="tp-caption main-label sft stb"
							 data-x="580"
							 data-y="190"
							 data-speed="300"
							 data-start="1500"
							 data-easing="easeOutExpo">DESIGN IT!</div>

						<div class="tp-caption bottom-label sft stb"
							 data-x="580"
							 data-y="250"
							 data-speed="500"
							 data-start="2000"
							 data-easing="easeOutExpo">Create slides with brushes and fonts.</div>



				</li>
			</ul>
		</div>
	</div>

	@if(!Auth::check())
	<div class="home-intro">
		<div class="container">

			<div class="row">
				<div class="col-md-8">
					<p>
						{{trans('all.home-page.home-intro-text1')}}
						<span>{{trans('all.home-page.home-intro-text2')}}</span>
					</p>
				</div>
				<div class="col-md-4">
					<div class="get-started">
						<a href="{{route('sign-in')}}" class="btn btn-lg btn-primary">{{trans('all.home-page.sign-up-now')}}</a>
					</div>
				</div>
			</div>

		</div>
	</div>
	@endif

	
	<div class="container">
		<div class="row featured-boxes">
			<div class="col-md-3">
				<div class="featured-box featured-box-primary">
					<div class="box-content">
						<i class="icon-featured icon icon-mobile"></i>
						<h4>{{trans('all.home-page.title-box-1')}}</h4>
						<p>{{trans('all.home-page.des-box-1')}}</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="featured-box featured-box-secundary">
					<div class="box-content">
						<i class="icon-featured icon icon-credit-card"></i>
						<h4>{{trans('all.home-page.title-box-2')}}</h4>
						<p>{{trans('all.home-page.des-box-2')}}</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="featured-box featured-box-tertiary">
					<div class="box-content">
						<i class="icon-featured icon icon-phone"></i>
						<h4>{{trans('all.home-page.title-box-3')}}</h4>
						<p>{{trans('all.home-page.des-box-3')}}</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="featured-box featured-box-quaternary">
					<div class="box-content">
						<i class="icon-featured icon icon-shopping-cart"></i>
						<h4>{{trans('all.home-page.title-box-4')}}</h4>
						<p>{{trans('all.home-page.des-box-4')}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	


	<div class="map-section">
		<section class="featured footer map">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="recent-posts push-bottom">
							<h2>{{trans('all.home-page.latest-blog-post')}}</h2>
							<div class="row">
								<div class="owl-carousel" data-plugin-options='{"items": 1, "autoHeight": true}'>
								<?php $countBlogs = count($latestBlogs) ?>
								@for($i=0; $i<$countBlogs; $i++)
									@if($i%2==0)
									<div>
									@endif
										<div class="col-md-6">
											<article>
												<div class="date">
													<span class="day">{{$latestBlogs[$i]->created_at->format('d')}}</span>
													<span class="month">{{trans('all.short-month.'.$latestBlogs[$i]->created_at->format("M"))}}</span>
												</div>
												<h4><a href="blog-post.html">{{$latestBlogs[$i]->title}}</a></h4>
												<p>&nbsp;{{$latestBlogs[$i]->description}} <a href="http://preview.oklerthemes.com/" class="read-more">&nbsp;{{trans('all.read-more')}} <i class="icon icon-angle-right"></i></a></p>
											</article>
										</div>
									@if($i%2!=0)
									</div>
									@endif
								@endfor
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<h2>{{trans('all.home-page.what-client-say')}}</h2>
						<div class="row">
							<div class="owl-carousel push-bottom" data-plugin-options='{"items": 1, "autoHeight": true}'>
								@foreach($latestFeedBacks as $feedBack)
								<div>
									<div class="col-md-12">
										<blockquote class="testimonial">
										<p>{{$feedBack->content}}</p>
										</blockquote>
										<div class="testimonial-arrow-down"></div>
										<div class="testimonial-author">
											<div class="img-thumbnail img-thumbnail-small">
												<img src="{{ asset('img/no-avatar.jpg') }}" alt="">
											</div>
											<p><strong>{{$feedBack->name}}</strong><span>{{$feedBack->email}}</span></p>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
@stop