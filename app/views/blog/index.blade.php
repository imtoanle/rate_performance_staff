@extends(Config::get('view.master'))
@section('content')

				<div class="container">

					<div class="row">
						<div class="col-md-9">
							<div class="blog-posts">
								@foreach($allBlogs as $blog)
								<article class="post post-medium">
									<div class="row">

										<div class="col-md-5">
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
										<div class="col-md-7">

											<div class="post-content">

												<h2><a href="{{route('view-blog', array($blog->id, Str::slug($blog->title)))}}">{{$blog->title}}</a></h2>
												<p>{{$blog->description}}</p>

											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="post-meta">
												<span><i class="icon icon-calendar"></i> {{$blog->created_at->format('d M Y')}} </span>
												<span><i class="icon icon-user"></i> {{trans('all.author')}}: {{$blog->getAuthor()}} </span>
												<span><i class="icon icon-comments"></i> <a href="blog-medium-image.html#">12 Comments</a></span>
												<a href="{{route('view-blog', array($blog->id, Str::slug($blog->title)))}}" class="btn btn-xs btn-primary pull-right">{{trans('all.read-more')}}...</a>
											</div>
										</div>
									</div>

								</article>
								@endforeach

								{{ $allBlogs->links(Config::get('view.pagination-lg')) }}

							</div>
						</div>

						<div class="col-md-3">
							<aside class="sidebar">

								<form>
									<div class="input-group">
										<input class="form-control" placeholder="{{trans('all.search')}}..." name="s" id="s" type="text">
										<span class="input-group-btn">
											<button type="submit" class="btn btn-primary btn-lg"><i class="icon icon-search"></i></button>
										</span>
									</div>
								</form>

								<hr />
								<div class="tabs">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#popularPosts" data-toggle="tab"><i class="icon icon-star"></i> {{trans('all.popular')}}</a></li>
										<li><a href="#recentPosts" data-toggle="tab">{{trans('all.recent')}}</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="popularPosts">
											<ul class="simple-post-list">
												@foreach($popularBlogs as $blog)
												<li>
													<div class="post-image">
														<div class="img-thumbnail">
															<a href="{{route('view-blog', array($blog->id, Str::slug($blog->title)))}}">
																<img class="img-rounded img-responsive" src="{{asset('img/holder.png')}}" width="50px">
															</a>
														</div>
													</div>
													<div class="post-info">
														<a href="{{route('view-blog', array($blog->id, Str::slug($blog->title)))}}">{{$blog->title}}</a>
														<div class="post-meta">
															 {{$blog->created_at->format('d M Y')}}
														</div>
													</div>
												</li>
												@endforeach
											</ul>
										</div>
										<div class="tab-pane" id="recentPosts">
											<ul class="simple-post-list">
												@foreach($recentBlogs as $blog)
												<li>
													<div class="post-image">
														<div class="img-thumbnail">
															<a href="{{route('view-blog', array($blog->id, Str::slug($blog->title)))}}">
																<img class="img-rounded img-responsive" src="{{asset('img/holder.png')}}" width="50px">
															</a>
														</div>
													</div>
													<div class="post-info">
														<a href="{{route('view-blog', array($blog->id, Str::slug($blog->title)))}}">{{$blog->title}}</a>
														<div class="post-meta">
															 {{$blog->created_at->format('d M Y')}}
														</div>
													</div>
												</li>
												@endforeach
											</ul>
										</div>
									</div>
								</div>

							</aside>
						</div>
					</div>

				</div>

@stop