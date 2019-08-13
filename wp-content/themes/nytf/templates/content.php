<div class="container page-wrapper">
	<div class="row page-content">
		<div class="col-md-2">&nbsp;</div>
		<div class="col-md-8">
			<article <?php post_class(); ?>>
  			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    			<?php //get_template_part('templates/entry-meta'); ?>
    			<?php
    			//print event details if it's an event
    			if ( get_post_type() =='event'){
    				get_template_part( 'templates/content-event-details');
    			}
    			?>
 		 	<div class="entry-summary">
    			<?php the_excerpt(); ?>
  			</div>
			</article>
		</div>
		<div class="col-md-2">&nbsp;</div>
	</div>
</div>
