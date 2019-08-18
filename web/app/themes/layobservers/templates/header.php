<header class="banner">
  <div class="container navbar-expand-md navbar navbar-default navbar-static-top flex-wrap">

    <div id="branding" class="flex-fill">
      <a href="<?php echo home_url(); ?>">
        <img alt="Lay Observers homepage" src="<?php bloginfo('template_directory'); ?>/assets/img/lo-logo.svg"
             class="logo-svg"/>
      </a>
    </div>

    <div id="searchform" class="align-self-start flex-fill flex-shrink-0">
      <?php get_search_form(); ?>
    </div>

    <nav id="navbar-collapse" class="navbar-collapse col-sm-12 collapse">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
      endif;
      ?>
    </nav>
  </div>
</header>
