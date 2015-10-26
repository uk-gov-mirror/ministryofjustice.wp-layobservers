<?php
/*
Template Name: Job vacancies
*/
?>


<?php while (have_posts()) : the_post(); ?>

<?php get_template_part('templates/page', 'header'); ?>

<div class="row vacancies">

<div class="col-sm-5 col-sm-push-7">

<?php the_content(); ?>

</div>

<div class="col-sm-7 col-sm-pull-5">

<div class="job-sort">

<form role="search" method="get" class="search-form form-inline vs-search" action="">
  <label class="sr-only"><?php _e('Search for:', 'roots'); ?></label>
  <div class="input-group">
    <input type="search" value="<?php echo get_search_query(); ?>" name="vs" class="search-field form-control" placeholder="<?php _e('Search vacancies', 'roots'); ?>">
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><?php _e('', 'roots'); ?><img src="<?php bloginfo('template_directory'); ?>/assets/img/search-icon.png"></button>
    </span>
  </div>
</form>

<h4 class="sort-by">Sort by: <a href="<?php echo get_permalink(1653) ?>?sort=close">Closing Date</a> <a href="<?php echo get_permalink(1653) ?>?sort=title">Prison</a> </h4>

</div>

<?php

$sort = get_query_var( 'sort' );
if(!empty($sort)){
  if($sort == 'title') {
    $orderby = array(
      'order' => 'ASC',
      'orderby' => 'title',
      //'meta_key' => 'closing-date'
    );
  } elseif($sort == 'close') {
    $orderby = array(
      'orderby' => 'meta_value',
      'meta_key' => 'closing-date',
      'order' => 'ASC'
    );
  }
}
$args = array(
  'post_type' => 'job',
  'posts_per_page' => -1,
);
if(!empty($orderby)) {
  $args = array_merge($args, $orderby);
}
$vs = get_query_var( 'vs' );
if(!empty($vs)){
  $search = array(
    's' => esc_sql($vs)
  );
  $args = array_merge($args, $search);
}
$query = new WP_Query($args);
$query2 = $query;
?>


<?php if ($query2->have_posts()) : ?>
  <?php $locations = array(); ?>
  <?php while ($query2->have_posts()) : $query2->the_post(); ?>
    <?php $location = get_field( 'map', get_the_ID() ); ?>
    <?php if( !empty( $location ) ): ?>
      <?php $location['title'] = get_the_title(); ?>
      <?php $location['id'] = get_the_ID(); ?>
      <?php $locations[] = $location; ?>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>

<?php if( !empty($locations) ): ?>
  <a href="#" class="view-map">View on a map</a>
  <div class="acf-map">
    <?php foreach($locations as $location): ?>
      <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
        <h5><?php echo $location['title']; ?></h5>
        <p><a href="#" onclick="return jumpToVacancy(<?php echo $location['id']; ?>)">Click here for more info</a></p>
      </div>
  <?php endforeach; ?>
  </div>
<?php endif; ?>






<?php if (!$query->have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<div class="vacancies-list panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <?php while ($query->have_posts()) : $query->the_post(); ?>
    <?php get_template_part('templates/vacancy'); ?>
  <?php endwhile; ?>
</div>

<?php if ($query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>

</div>

</div>

<?php endwhile; ?>
