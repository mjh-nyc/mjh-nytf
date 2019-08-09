<?php
if (get_field('images')):
	echo '<div class="featured-content">';
	include( locate_template( 'templates/slider.php' ) );
	echo '</div>';
endif;

if (get_field('embed_code')):
	
	echo '<div class="featured-content container">';
	include( locate_template( 'templates/video.php' ) );
	echo '</div>';
endif;

if (has_post_thumbnail()):
	echo '<div class="featured-content container">';
	include( locate_template( 'templates/featured-image.php' ) );
	echo '</div>';
endif; ?>

<div class="container">
	<?php include( locate_template( 'templates/content-main.php' ) ); ?>
</div>