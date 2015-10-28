<?php
/**
 * Template Name: Reports page
 */

the_post();

?>
<?php get_template_part('templates/page', 'header'); ?>

<div class="row">
  <div class="col-sm-4">
    <?php

    $get_description = get_post(get_post_thumbnail_id())->post_excerpt;
    the_post_thumbnail('large');
    if (!empty($get_description)) { //If description is not empty show the div
      echo '<div class="img-caption">' . get_post(get_post_thumbnail_id())->post_excerpt . '</div>';
    }

    if (is_page(array('How to apply'))) {
      wpb_list_child_pages();
    }

    ?>
  </div>
  <div class="col-sm-8">
    <?php the_content(); ?>

    <div class="report-downloads">
      <?php

      $years = $wpdb->get_results("SELECT YEAR(post_date) AS year FROM wp_posts WHERE post_type = 'report' AND post_status = 'publish' GROUP BY year ORDER BY post_date DESC");

      foreach ($years as $year) {
        echo '<h2>' . $year->year . '</h2>';

        $query = new WP_Query(array(
          'post_type' => 'report',
          'orderby' => 'post_date',
          'order' => 'DESC',
          'posts_per_page' => -1,
          'year' => $year->year,
        ));

        echo '<ul>';
        while ($query->have_posts()) {
          $query->the_post();
          $report_url = get_post_meta(get_the_ID(), 'report-upload', true);
          $report_title = get_the_title();

          echo '<li>';

          // Link to report
          echo sprintf('<a href="%1$s" title="Download %2$s">%2$s</a>', esc_attr($report_url), esc_html($report_title));

          // Get file meta details
          $attachment_id = get_attachment_id_from_src($report_url);
          $attachment_path = get_attached_file($attachment_id);
          $docsize = size_format(filesize($attachment_path));
          $filetype = wp_check_filetype($attachment_path);
          echo sprintf(' <span class="file-meta">%s, %s</span>', strtoupper($filetype['ext']), $docsize);

          echo '</li>';
        }
        echo '</ul>';
      }

      // Reset The Loop – cleaning up after ourselves, because nobody likes a mess
      wp_reset_postdata();

      ?>
    </div>


  </div>
</div>
