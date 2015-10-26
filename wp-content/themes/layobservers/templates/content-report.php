<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="page-header">
      <h1 class="entry-title"><?php the_title(); ?></h1>
      </div>
  </header>

  <div class="row">

    <div class="col-sm-4">

        <div class="post-meta">
          <time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
        </div>
    </div>

    <div class="col-sm-8">

      <div class="entry-content">

          <?php the_content(); ?>

                  <div class="download-report">
        
          <?php $fname = get_post_meta(get_the_ID(),'report-upload',true);  ?>

          <a class="" href="<?php echo $fname; ?>"><?php the_title(); ?></a> <span class="file-size">PDF, 
                <?php 

                  $attachment_id = get_attachment_id_from_src($fname);

                  $myfile = filesize( get_attached_file( $attachment_id ) ); 

                  $docsize = size_format($myfile);

                  echo $docsize;
                  
                  ?>
              </span>
       </div>

              

      </div>

    </div>

  </div>

    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
  </article>
<?php endwhile; ?>
