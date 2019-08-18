<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url(home_url('/')); ?>">
  <label for="search" class="sr-only"><?php _e('Search for:', 'roots'); ?></label>
  <div class="input-group">
    <input id="search" type="search" value="<?php echo get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search the site', 'roots'); ?>">
    <span class="input-group-btn">
      <button type="submit" value="submit" class="sr-only"><?php _e('', 'roots'); ?><img src="<?php bloginfo('template_directory'); ?>/assets/img/search-icon.png" alt="search"></button>
    </span>
  </div>
</form>