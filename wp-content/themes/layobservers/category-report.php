<?php
/* 
Template Name: Category report archive
*/
?>


<div class="page-header">
	<?php the_title( '<h1>', '</h1>' ); ?>
</div>

<div class="archive-links">
	<ul>
		<?php

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$year = $post->post_name;

		$args = array( 
			'posts_per_page' => 30, 
			'paged' => $paged,
			'report_year' => $year, 
			'order'=> 'ASC', 
			'orderby' => 'title',
			'post_type' => 'report' );

		    $postslist = new WP_Query( $args );

		    if ( $postslist->have_posts() ) :
		        while ( $postslist->have_posts() ) : $postslist->the_post(); 
		    		if(get_post_meta(get_the_ID(),'report-upload',true)):

                        $fname = get_post_meta(get_the_ID(),'report-upload',true);

                        echo '<li><h4><a href="';
                        echo get_post_meta(get_the_ID(),'report-upload',true);
                        echo '" target="_blank">';
                             the_title();
                        echo '</a> ';

                        $attachment_id = get_attachment_id_from_src($fname);
                        $attachment_path = get_attached_file($attachment_id);

                        $docsize = size_format(filesize($attachment_path));
                        $filetype = wp_check_filetype($attachment_path);

                        echo '<span class="file-meta">';
                        echo strtoupper($filetype['ext']) . ', ';
                        echo $docsize;
                        echo '</span>';


                        echo '</h4>';
                        echo '</li>';
				    endif;
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