<?php
/*
Template Name: Job vacancies
*/

the_post();
?>

<?php get_template_part('templates/page', 'header'); ?>

<div class="row vacancies">

  <div class="col-sm-5 col-sm-push-7">
    <?php the_content(); ?>
  </div>

  <div class="col-sm-7 col-sm-pull-5">
    <div class="job-sort">
      <form role="search" method="get" class="search-form form-inline vs-search" action="">
        <label for="search" class="sr-only"><?php _e('Search for:', 'roots'); ?></label>
        <div class="input-group">
          <input id="search" type="search" value="<?php if (isset($_GET['vs'])) {
            echo esc_attr($_GET['vs']);
          } ?>" name="vs" class="search-field form-control" placeholder="<?php _e('Search vacancies', 'roots'); ?>">
          <span class="input-group-btn">
            <button type="submit" class="search-submit btn btn-default"><img
                src="<?php bloginfo('template_directory'); ?>/assets/img/search-icon.png"
                alt="Search Vacancies"></button>
          </span>
        </div>
      </form>
      <h4 class="sort-by">
        Sort by:
        <a href="?sort=close">Closing Date</a>
        <a href="?sort=title">Prison</a>
      </h4>
    </div>

    <?php

    // Setup query arguments
    $args = array(
      'post_type' => 'job',
      'posts_per_page' => -1,
    );

    // Sort order
    $sort = get_query_var('sort');
    if (!empty($sort)) {
      if ($sort == 'title') {
        $orderby = array(
          'order' => 'ASC',
          'orderby' => 'title',
        );
      } elseif ($sort == 'close') {
        $orderby = array(
          'orderby' => 'meta_value',
          'meta_key' => 'closing-date',
          'order' => 'ASC'
        );
      }
    }
    if (!empty($orderby)) {
      $args = array_merge($args, $orderby);
    }

    // Search query
    $vs = get_query_var('vs');
    if (!empty($vs)) {
      $search = array(
        's' => esc_sql($vs)
      );
      $args = array_merge($args, $search);
    }

    // Perform the query
    $query = new WP_Query($args);

    // Build an array of locations for plotting to the map
    if ($query->have_posts()) {
      $locations = array();
      while ($query->have_posts()) {
        $query->the_post();
        $location = get_field('map', get_the_ID());
        if (!empty($location)) {
          $location['title'] = get_the_title();
          $location['id'] = get_the_ID();
          $locations[] = $location;
        }
      }
    }
    $query->rewind_posts();

    ?>
    <?php if (!empty($locations)): ?>
      <a href="#" class="view-map">View on a map</a>
      <div class="acf-map">
        <?php foreach ($locations as $location): ?>
          <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
            <h5><?php echo $location['title']; ?></h5>
            <p><a href="#" onclick="return jumpToVacancy(<?php echo $location['id']; ?>)">Click here for more info</a>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if (!$query->have_posts()) : ?>
      <div class="alert alert-warning">
        <?php _e('Sorry, no vacancies were found.', 'roots'); ?>
      </div>
    <?php endif; ?>

    <div class="vacancies-list panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <?php

      while ($query->have_posts()) {
        $query->the_post();
        get_template_part('templates/vacancy');
      }

      ?>
    </div>

  </div>

</div>
