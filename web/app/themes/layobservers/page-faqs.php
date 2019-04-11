<?php
/*
Template Name: FAQs page
*/
?>


<?php while (have_posts()) :
the_post(); ?>
<?php get_template_part('templates/page', 'header'); ?>

<div class="row">
  <div class="col-sm-4 min-col">

    <?php
    $get_description = get_post(get_post_thumbnail_id())->post_excerpt;
    echo '<div class="page-img-wrapper">';
    the_post_thumbnail('large');
    echo '</div>';
    if (!empty($get_description)) {//If description is not empty show the div
      echo '<div class="img-caption">' . get_post(get_post_thumbnail_id())->post_excerpt . '</div>';
    }
    ?>

    <?php endwhile; ?>

  </div>

  <div class="col-sm-8 max-col">

    <?php the_content(); ?>


    <?php
    $args = array(
      'post_type' => 'faq',
      'orderby' => 'menu_order',
      'order' => 'ASC',
      'posts_per_page' => 20
    );
    $the_query = new WP_Query($args);
    ?>

    <div class="card-group" id="accordion" role="tablist" aria-multiselectable="true">

      <?php if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

        <div class="card card-default">
          <div class="card-heading" role="tab" id="headingOne">
            <h4 class="card-title">
              <a data-toggle="collapse" href="#collapse<?php the_ID(); ?>" aria-expanded="true"
                 aria-controls="collapse<?php the_ID(); ?>">
                <?php the_title(); ?>
              </a>
            </h4>
          </div>
          <div id="collapse<?php the_ID(); ?>" class="card-collapse collapse" role="tabpanel"
               data-parent="#accordion" aria-labelledby="heading<?php the_ID(); ?>">
            <div class="card-body">
              <?php the_content(); ?>
            </div>
          </div>
        </div>

      <?php endwhile; else: ?>

        <p>No questions here yet.</p>

      <?php endif; ?>
      <?php wp_reset_postdata(); ?>

    </div><!--end of the accordion wrap-->

  </div>
</div>


</div>

</div>

