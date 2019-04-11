<header class="banner" role="banner">
  <div class="container navbar-expand-md navbar navbar-default navbar-static-top flex-wrap">

    <div id="branding" class="flex-fill">
      <a href="<?php echo home_url(); ?>">
        <img alt="Lay Observers Logo" src="<?php bloginfo('template_directory'); ?>/assets/img/lo-logo.svg"
             class="logo-svg"/>
      </a>
    </div>

    <div id="search" class="align-self-start flex-fill flex-shrink-0">
      <?php get_search_form(); ?>
    </div>

    <div class="navbar-header">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls=".navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <nav class="navbar-collapse col-sm-12 collapse" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
      endif;
      ?>
    </nav>
  </div>
</header>
