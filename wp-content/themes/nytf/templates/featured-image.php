<div class="featured-image">
	<?php
	// Check if the post has a Post Thumbnail assigned to it.
	if ( has_post_thumbnail() ) {
    	the_post_thumbnail('large');
    	echo '<div class="featured-image-caption">';
    	echo get_post(get_post_thumbnail_id())->post_excerpt;
    	echo '</div>';
	} 
	?>
	</div>
</div>