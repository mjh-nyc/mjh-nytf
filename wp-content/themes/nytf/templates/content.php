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
    				if (get_field('event_start_date')) {
    					echo '<div class="entry-meta">';
    					echo '<strong>';
				            if (get_field('event_end_date')) {
				              echo cleanDateOutput(get_field('event_start_date'),get_field('event_end_date'));
				            } else{
				              echo get_field('event_start_date');
				            }
				            if (get_field('event_type') == 'onetime') {
				            	echo '<br>';
				            	echo get_field('event_start_time');
				            }
				            if (get_field('event_end_time')) {
				                echo '&#8211;';
				                echo get_field('event_end_time');
				            }
			            echo '</strong>';
			            echo '</div>';
    				}
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
