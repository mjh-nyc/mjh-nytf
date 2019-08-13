<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page-header'); ?>
  <article <?php post_class(); ?>>
    <?php $post_format = get_post_format(); ?>
    <div class="featured-content<?php if ($post_format != "gallery"): echo " container"; endif; ?>">
    	
    	<?php
    	if ($post_format == "gallery"):
    		include( locate_template( 'templates/slider.php' ) );
    	endif; ?>
    	
    	<?php
    	if ($post_format == "video"):
    		include( locate_template( 'templates/video.php' ) );
    	endif; ?>
    	
    </div>
    
    <div class="container">
    	<?php include( locate_template( 'templates/content-main.php' ) ); ?>
	</div>
  </article>
<?php endwhile; ?>
