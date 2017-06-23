<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title">
      <?php $file = get_post_meta($post->ID, "report-upload"); ?>
      <?php if($post->post_type == 'report' && !empty($file[0])): ?>
	    <a href="<?= $file[0]; ?>"><?php the_title(); ?></a>
	  <?php else: ?>
	    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	  <?php endif; ?>
    </h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>

  <hr/>
</article>

