<?php include("_includes/header.php"); ?>

	<!-- Press Section -->
	<section id="press">
		<div id="blogpost">
			<h1>~  Latest posts ~</h1>
			<h2>What we've written</h2>
			<div id="post-slider">
				<!-- Post slider control -->
				<ul class="slidecontrols">
					<li><a href="#post-content" class="post-next"><i class="fa fa-chevron-right"></i></a></li>
					<li><a href="#post-content" class="post-prev"><i class="fa fa-chevron-left"></i></a></li>
				</ul>
				<!-- End post slider control -->
				<!-- Post slider -->
				<ul class="slider" id="post-content">
					{% for post in site.posts %}
					<li class="slide">
						<article>
						<ul>
							
							<li>
								<a href="{{ post.url }}">{{ post.title }}</a>
								<p>{% if excerpt and post.excerpt %}
								{{ post.excerpt }}
								<p> <a href="{{ post.url }}/#more" class="more-link"><span class="readmore">Read the rest of this entry »</span></a></p>
								{% else %}
								{{ post.content | mark_excerpt }}
								{% endif %}</p>
								{% unless page.tags == empty %}
								<ul class="tag_box inline">
									<li><i class="icon-tags"></i></li>
									{% assign tags_list = page.tags %}
									{% include JB/tags_list %}
								</ul>
								{% endunless %}
							</li>
							
						</ul>
						</article>
						<p><a href="{{ post.url }}" class="btn btn-outline-white btn-big">Read blog post</a></p>
					</li>  {% endfor %}
				</ul>
				<!-- End Post slider -->
			</div>			
		</div>
		
	</section>
	<!-- End of Press Section -->

<?php include("_includes/footer.php"); ?>