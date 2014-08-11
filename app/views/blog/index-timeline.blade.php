@extends(Config::get('view.master'))
@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="blog-posts">

				<section class="timeline">
					<div class="timeline-body">
						
						<?php 
							$direct = 'left';
							$current_month = $allBlogs[0]->created_at->format('M Y'); 
						?>
						<div class="timeline-date">
							<h3>{{$current_month}}</h3>
						</div>
						@foreach($allBlogs as $blog)
						
						@if($current_month != $blog->created_at->format('M Y'))
						<div class="timeline-date">
							<h3>{{$blog->created_at->format('M Y')}}</h3>
						</div>
						<?php $current_month = $blog->created_at->format('M Y');
						$direct = 'left'; ?>
						@endif
						<article class="timeline-box {{$direct}} post post-medium">
						<?php $direct = $direct == 'left' ? 'right' : 'left'; ?>
							<div class="row">

								<div class="col-md-12">
									<div class="post-image">
										<div class="owl-carousel" data-plugin-options='{"items":1}'>
											<div>
												<div class="img-thumbnail">
													<img class="img-responsive" src="img/blog/blog-image-1.jpg" alt="">
												</div>
											</div>
											<div>
												<div class="img-thumbnail">
													<img class="img-responsive" src="img/blog/blog-image-2.jpg" alt="">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">

									<div class="post-content">
										<h4><a href="blog-post.html">{{$blog->title}}</a></h4>
										<p>{{$blog->description}}</p>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="post-meta">
										<span><i class="icon icon-calendar"></i> {{$blog->created_at->format('d M Y')}} </span><br>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
									<div class="post-meta">
										<span><i class="icon icon-user"></i> {{trans('all.author')}}: <a href="blog-timeline.html#">John Doe</a> </span>
										<span><i class="icon icon-comments"></i> <a href="blog-timeline.html#">12 Comments</a></span>
									</div>
								</div>
								<div class="col-md-4">
									<a href="{{route('view-blog', array($blog->id, Str::slug($blog->title)))}}" class="btn btn-xs btn-primary pull-right">{{trans('all.read-more')}}...</a>
								</div>
							</div>

						</article>
						@endforeach

						<div class="timeline-date">
							<h3><a href="blog-timeline.html#">Load More...</a></h3>
						</div>

					</div>

				</section>

			</div>
		</div>

	</div>

</div>

@stop
