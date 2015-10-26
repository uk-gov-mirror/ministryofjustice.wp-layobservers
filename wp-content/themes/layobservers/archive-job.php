<?php
$sort = get_query_var( 'sort' );
if(!empty($sort)){
  if($sort == 'date') {
    $orderby = array(
      'order' => 'DESC',
      'orderby' => 'meta_value',
      'meta_key' => 'closing-date'
    );
  }
}
$args = array(
  'post_type' => 'job',
  'posts_per_page' => -1,
  'orderby' => 'title',
  'order' => 'ASC',
);
if(!empty($orderby)) {
  $args = array_merge($args, $orderby);
}
$query = new WP_Query($args);

?>


<?php get_template_part('templates/page', 'header'); ?>

<h4 class="sort-by">Sort by: <a href="/job">Prison</a> <a href="/job/?sort=date">Closing Date</a></h4>
<hr>
<?php if (!$query->have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while ($query->have_posts()) : $query->the_post(); ?>
  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>

<?php if ($query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>



