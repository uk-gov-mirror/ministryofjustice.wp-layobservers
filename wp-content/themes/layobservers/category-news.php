<?php
/* 
Template Name: Category news archive
*/
?>


<div class="page-header">
	<?php the_title( '<h1>', '</h1>' ); ?>
</div>



<div class="news-archive-links">
	<ul>


<?php

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$year = $post->post_name;

		$args = array( 
			'posts_per_page' => 10, 
			'paged' => $paged,
			'category' => 'news' );

		    $postslist = new WP_Query( $args );

		    if ( $postslist->have_posts() ) :
		        while ( $postslist->have_posts() ) : $postslist->the_post(); 

				 echo '<li>';
		         echo'<div class="img-time-wrapper">';
		         if ( has_post_thumbnail() ) : the_post_thumbnail('large'); 
		         endif;  
				 echo '<time class="published">'; 
		         echo get_the_date();
		         echo '</time>';
		         echo '</div>';
		         echo '<div class="title-excerpt-wrapper">';
		         echo '<h4><a href="';
		         the_permalink();
		         echo '">';
		         the_title();
		         echo '</a></h4>';
		         the_excerpt();
		         echo '</div></li><hr/>';
		             

		         endwhile;  

		         endif;
		?>

	</ul>

</div>

<div class="pagination">
	<?php
	$big = 999999999; // need an unlikely integer

	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $postslist->max_num_pages
	) );
	?>
</div>