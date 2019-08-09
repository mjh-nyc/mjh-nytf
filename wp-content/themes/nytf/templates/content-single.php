<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header class="container">
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php //get_template_part('templates/entry-meta'); ?>
    </header>  
    
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
    	
    	<?php
    	if ($post_format == ""):
    		include( locate_template( 'templates/featured-image.php' ) );
		endif; ?>
		
    	
    </div>
    
    <div class="container">
    	<?php include( locate_template( 'templates/content-main.php' ) ); ?>
	</div>
	
	<div class="container related">
		<h3><?php _e("Read on:","sage"); ?></h3>
		<div class="row">
			<?php 
			$siblings = get_post_siblings( 3, $post->post_date );
			//print_r($siblings);
			$i = 1;
			foreach ( $siblings as $sibling ) {
				echo '<div class="col-md-4">';
				echo '<a href="'.get_the_permalink($sibling->ID).'">';
				echo $sibling->post_title;
				echo '</a>';
				echo '</div>';
				if ($i++ == 3) break;
			}
			?>
		</div>
	</div>
	
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
