<?php
$show_secondary_nav = false;
$show_uploads = false;
$col1 = 2;
$col2 = 8;
$col3 = 2;

//are there attachments?
if( have_rows('files') ):
	$show_uploads = true;
endif;

if (is_child(get_the_ID()) || is_ancestor(get_the_ID())):
	$show_secondary_nav = true;
	//pass the parent ID to the submenu function
	$parent_id = wp_get_post_parent_id( get_the_ID() );
	if ($parent_id == 0) {
		//this is the parent, use its id
		$parent_id = get_the_ID();
	} 
	$pages = get_submenu($parent_id);
endif;

if ($show_uploads || $show_secondary_nav):
	$col1 = 4;
	$col2 = 8;
	$col3 = 0;
endif;



?>

<div class="row page-content">
	<div class="col-md-<?php echo $col1; ?>">
		<?php if ($show_secondary_nav):
			//there are secondary links, print them here
			echo "<h3>In this section:</h3>";
			//print toplevel page
			echo '<h4><a href="'.get_the_permalink($parent_id).'">';
			echo get_the_title($parent_id);
			echo '</a></h4>';
			echo '<ul class="submenu">';
			foreach ( $pages as $page ) {
   				$page_title = $page->post_title;
   				$page_permalink = get_the_permalink($page->ID);
   				echo '<li><a href="'.$page_permalink.'">';
   				echo $page_title;
   				echo '</a></li>';
			}
			echo '</ul>';
		
		endif; ?>
		
		<?php if ($show_uploads):
			echo '<div class="file-uploads">';
			echo '<i class="fa fa-cloud-download" aria-hidden="true"></i>';
			echo '<ul class="files">';
			
			while( have_rows('files') ): the_row();
				// vars
				$file_link = get_sub_field('file_upload');
				$description = get_sub_field('file_description');
				echo '<li>';
				echo '<a href="'.$file_link.'">';
				echo $description;
				echo '</a>';
				echo '</li>';
			endwhile;
			
			echo '</ul>';
			echo '</div>';
		endif; ?>
	</div>
	<div class="col-md-<?php echo $col2; ?>">
    	<div class="entry-content">
    		<?php
    		//if it's an event, also add location (if any)
    		if ( get_post_type() =='event'){
    			if (get_field('event_has_location')) {
          			echo '<h3>'.__('Event location:', 'sage').'</h3>';
          			echo '<div class="event-location item">';
          				echo '<div>';
          					 echo get_field('event_location');
          				echo '</div>';
						echo '<div>';
          					echo get_field('event_street');
          					echo '<span style="display: block;">';
          					echo get_field('event_secondary_street');
          					echo '</span>';
          				echo '</div>';
          				echo '<div>';
            				echo get_field('event_city').', '.get_field('event_state').' '.get_field('event_zip_code');
            			echo '</div>';
            		echo '</div>';
          		}
          	}
        	?>
    		<?php the_content(); ?>
    	</div>
    </div>
    <?php if ($col3 > 0): ?>
    	<div class="col-md-2">&nbsp;</div>
    <?php endif; ?>
</div>