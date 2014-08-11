@extends(Config::get('view.master'))
@section('content')
				<div class="container">

					<div class="row">
						<div class="col-md-9">
							<div class="blog-posts single-post">

								<article class="post post-large blog-single-post">
								<!--
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
								-->

									<div class="post-date">
										<span class="day">{{$blogDetail->created_at->format('d')}}</span>
										<span class="month">{{$blogDetail->created_at->format('M')}}</span>
									</div>

									<div class="post-content">

										<h2><a href="{{route('view-blog', array($blogDetail->id, Str::slug($blogDetail->title)))}}">{{$blogDetail->title}}</a></h2>

										<div class="post-meta">
											<span><i class="icon icon-user"></i> {{trans('all.author')}}: {{$blogDetail->getAuthor()}}</span>
											<span><i class="icon icon-comments"></i> <a href="blog-post.html#">{{count($blogDetail->comments)}} {{trans('all.services-page.comment')}}</a></span>
										</div>

										{{$blogDetail->content}}

										<div class="post-block post-comments">
											<h3><i class="icon icon-comments"></i>{{trans('all.services-page.comment')}} ({{count($blogDetail->comments)}})</h3>

											<ul class="comments">
												@foreach($blogDetail->comments as $comment)
												<li>
													<div class="comment">
														<div class="img-thumbnail">
															<img class="avatar" alt="" src="{{asset('img/holder.png')}}">
														</div>
														<div class="comment-block">
															<div class="comment-arrow"></div>
															<span class="comment-by">
																<strong>{{$comment->name}}</strong>
															</span>
															<p>{{$comment->content}}</p>
															<span class="date pull-right">{{$comment->created_at->format('d/m/Y')}}</span>
														</div>
													</div>
												</li>
												@endforeach
											</ul>

										</div>

										<div class="post-block post-leave-comment">
											<h3>{{trans('all.leave-a-comment')}}</h3>

											<form class="ajax-submit-form" action="{{route('post-comment')}}" method="post">
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<div class="input-group">
																<label>{{trans('all.full-name')}} *</label>
																<input type="text" value="" maxlength="100" class="form-control" name="full_name" id="name">
															</div>
														</div>
														<div class="col-md-6">
															<div class="input-group">
																<label>{{trans('all.email')}} *</label>
																<input type="email" value="" maxlength="100" class="form-control" name="email" id="email">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<div class="input-group">
																<label>{{trans('all.services-page.comment')}} *</label>
																<textarea maxlength="5000" rows="10" class="form-control" name="content" id="comment"></textarea>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<div class="input-group">
																<label>{{HTML::image(Captcha::img(), 'Captcha image')}}</label>
																
																{{Form::text('captcha')}}
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<input type="submit" value="{{trans('all.submit')}}" class="btn btn-primary btn-lg" data-loading-text="Loading...">
													</div>
												</div>
												{{ Form::hidden('blog_id', $blogDetail->id) }}
											</form>
										</div>

									</div>
								</article>

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