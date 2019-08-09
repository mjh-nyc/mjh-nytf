<?php if (!empty_content($post->post_content)) { ?>
	<div class="container">
		<div class="page-content row">
			<div class="col-md-9 offset-md-2">
				<?php the_content(); ?>	
			</div>
		</div>
	</div>
<?php } ?>
<div class="timeline-list container">
	<?php
	$args = array(
		'posts_per_page'   => -1,
		'category_name'    => 'timeline',
		'orderby'          => 'meta_value_num',
		'order'            => 'ASC',
		'meta_key'         => 'year',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_status'      => 'publish'
	);
	// The Query
	$the_query = new WP_Query( $args );
	// The Loop
	if ( $the_query->have_posts() ) {
		echo '<div class="page-content">';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				echo '<div class="row">';
					echo '<div class="col-md-2 offset-md-2">';
					echo '<h2>';
						echo get_field( "year" );
					echo '</h2>';
					echo '</div>';
					echo '<div class="col-md-7 timeline-content">';
						if (get_field('images')):
							echo '<div class="featured-content">';
							include( locate_template( 'templates/slider.php' ) );
							echo '</div>';
						endif;
						if (has_post_thumbnail()):
							echo '<a href="'.get_the_post_thumbnail_url().'" data-lity data-lity-desc="'.get_the_title().'">';
							the_post_thumbnail(array(300,300), array('class' => 'alignleft'));
							echo '</a>';
						endif;
						the_content();
						if (get_field( "source" )) {
							echo '<div class="source">';
								echo __('Source:','sage');
								if (get_field( "source_url" )) {
									echo ' <a href="'.get_field( "source_url" ).'" target="_blank">';
								}
								echo get_field( "source" );
								if (get_field( "source_url" )) {
									echo '</a>';
								}
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			}
		echo '</div>';
		/* Restore original Post Data */
		wp_reset_postdata();
		} else {
			// no posts found
		}
	?>
</div>