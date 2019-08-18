<?php
/*
Template Name: Homepage
*/
?>

<?php while (have_posts()) : the_post(); ?>
 	<div id="news-banner" class="container-fluid">
		<img src="<?php echo get_post_meta( $post->ID, "banner-image", true ); ?>" alt="">
		<div class="news-banner-text">
			<h1><?php echo get_post_meta( $post->ID, "banner_heading", true ); ?></h1>
			<p><?php echo get_post_meta( $post->ID, "banner-sub-heading", true ); ?></p>
		</div>
	</div>
 	<div class="row">
 		<div class="col-md-3 min-col">
 			<div class="quick-links side-item">
 				<ul>
 					<li><a href="<?php echo get_permalink( get_post_meta( $post->ID, "quick-link-1-page", true )); ?>"><?php echo get_post_meta( $post->ID, "quick-link-1", true ); ?> ></a></li>
 					<li><a href="<?php echo get_permalink( get_post_meta( $post->ID, "quick-link-2-page", true )); ?>"><?php echo get_post_meta( $post->ID, "quick-link-2", true ); ?> ></a></li>
 					<li><a href="<?php echo get_permalink( get_post_meta( $post->ID, "quick-link-3-page", true )); ?>"><?php echo get_post_meta( $post->ID, "quick-link-3", true ); ?> ></a></li>
 					<li><a href="<?php echo get_permalink( get_post_meta( $post->ID, "quick-link-4-page", true )); ?>"><?php echo get_post_meta( $post->ID, "quick-link-4", true ); ?> ></a></li>
 				</ul>
 			</div>
 			<div class="about side-item">
 				<h2>Who are we?</h2>
 				<p><?php echo get_post_meta( $post->ID, "sidebar-text-p1", true ); ?></p>
 				<p><?php echo get_post_meta( $post->ID, "sidebar-text-p2", true ); ?></p>
 			</div>
 			<div class="links side-item">
 				<h2>Related links</h2>
 				<ul>
 					<li><a href="<?php echo get_post_meta( $post->ID, "related-link-1", true ); ?>"><?php echo get_post_meta( $post->ID, "related-1", true ); ?></a></li>
 					<li><a href="<?php echo get_post_meta( $post->ID, "related-link-2", true ); ?>"><?php echo get_post_meta( $post->ID, "related-2", true ); ?></a></li>
 					<li><a href="<?php echo get_post_meta( $post->ID, "related-link-3", true ); ?>"><?php echo get_post_meta( $post->ID, "related-3", true ); ?></a></li>
 					<li><a href="<?php echo get_post_meta( $post->ID, "related-link-4", true ); ?>"><?php echo get_post_meta( $post->ID, "related-4", true ); ?></a></li>
 				</ul>
 			</div>
 		</div>
 		<div class="col-md-9 max-col">
			<div class="intro main-item">	
				<h2><?php echo get_post_meta( $post->ID, "welcome-title", true ); ?></h2>
				<p><?php echo get_post_meta( $post->ID, "welcome-text", true ); ?></p>
				<a href="<?php echo get_permalink( get_post_meta( $post->ID, "welcome-link", true )); ?>" class="float-right em-link">Learn more about us ></a>
			</div>
			<div class="news main-item">
				<h2>Latest news</h2>
					<ul>
						<?php
						// Get meta value containing array of entries
						$latest_news_args = array(
						'post_type' => 'post',
						'posts_per_page' => 3
						);
						$latest_news_query = new WP_Query( $latest_news_args );
						// Iterate over entries and display
						while ( $latest_news_query->have_posts() ) : $latest_news_query->the_post();
						?>
							<li>
								<div class="news-details">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="news-meta">
										<time class="published" datetime="<?php echo get_the_time( 'c' ); ?>"><?php echo get_the_date(); ?></time>
									</div>
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="home-news-img-wrapper">
											<?php the_post_thumbnail('large'); ?>
										</div>
									<?php endif; ?>
									<?php the_excerpt(); ?>
								</div>
							</li>
							<?php
								endwhile;
								wp_reset_postdata();
							?>
					</ul>
					<a href="/layobservers/news/" class= "float-right larger-link-size">More news ></a>
				</div>
				<?php
					$video = get_post_meta($post->ID, 'home-video', true);
					if (!empty($video)):
				?>
				<div class="media main-item video-container">
					<h2>Latest media</h2>
					<div class="videoWrapper">
					  <?php echo wp_oembed_get($video); ?>
					</div>
			</div>
      <?php endif; ?>
  	</div>
	</div>
<?php endwhile; ?>