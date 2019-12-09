 <?php
    do_action('get_header');
    get_header();
  ?>
  <div class="wrap container" role="document">
    <div class="content row">
      <main class="main" role="main">
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->
      <?php if (roots_display_sidebar()) : ?>
      <?php endif; ?>
    </div><!-- /.content -->
  </div><!-- /.wrap -->

 <?php get_footer(); ?>