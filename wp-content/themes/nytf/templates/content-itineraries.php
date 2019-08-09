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

<div class="container itineraries-map">
	<div class="prompt">
		<?php //_e('Sign in to your Google account to save the places you want to visit and create your own map!','sage'); ?>
	</div>
	<div class="map">
		<?php
		if( have_rows('itineraries') ):
			//if thre are itineraries, push then into array that we can use later
			$itineraries = array();
			while( have_rows('itineraries') ): the_row();
				$map = get_sub_field('map');
				$title = get_sub_field('title');
				$description = get_sub_field('description');
				$url = get_sub_field('url');
				$itinerary_type = get_sub_field('itinerary_type');
				
				$stop =  array (
      				'title' => $title,
      				'description' => $description,
      				'url' => $url,
      				'map' => $map
    			);
				$itineraries[$itinerary_type][] = $stop;
			endwhile;
			//print_r($itineraries);
		endif;
		
		?>
		<?php
		//Google JS API functions are in main.js, this just creates the data arrays
		//contrsut positions array
		if (!empty($itineraries)):
			$itinerary_types = array_keys($itineraries);
			echo '<script>';
			echo 'var features = [';
			for($i = 0; $i < count($itineraries); $i++) {
    			foreach($itineraries[$itinerary_types[$i]] as $key => $itinerary_item_array) {
        			$pos = $key+1;
        			echo '{
            			position: new google.maps.LatLng('.$itinerary_item_array["map"]["lat"].', '.$itinerary_item_array["map"]["lng"].'),
            			type: "'.$itinerary_types[$i].'",
            			labelContent: "'.$pos.'"
          			},';
    			}
			}
			echo '];';
			echo '</script>';
		endif;
		
		//construct info window array
		if (!empty($itineraries)):
			$itinerary_types = array_keys($itineraries);
			echo '<script>';
			echo 'var contentStrings = [';
			for($i = 0; $i < count($itineraries); $i++) {
    			foreach($itineraries[$itinerary_types[$i]] as $key => $itinerary_item_array) {
        			// vars
					$title = $itinerary_item_array["title"];
					$description = $itinerary_item_array["description"];
					$description = (strlen($description) > 150) ? substr($description,0,150).'... <a href="#stop-'.$itinerary_types[$i].'--'.$key.'">More &#8594;</a>' : $description;
					$url = $itinerary_item_array["url"];
					echo '"<div class=\'map-info\'><span class=\'title\'>'.addslashes($title).'</span><p>'.addslashes($description).'</p>';
					if ($url):
						echo '<p><a href=\''.$url.'\' target=\'_blank\'>'.__('View website','sage').'</a></p>';
					endif;
				
					echo '</div>",';
    			}
			}
			echo '];';
			echo '</script>';
		endif;
		
		
		/*if( have_rows('itineraries') ):
			echo '<script>';
			
			echo 'var contentStrings = [';
			while( have_rows('itineraries') ): the_row();
				// vars
				$title = get_sub_field('title');
				$description = get_sub_field('description');
				$description = (strlen($description) > 150) ? substr($description,0,150).'... <a href="#stop--'.$counter.'" class="scroll" data-location="stop--'.$counter.'">More &#8594;</a>' : $description;
				$url = get_sub_field('url');
				echo '"<div class=\'map-info\'><span class=\'title\'>'.addslashes($title).'</span><p>'.addslashes($description).'</p>';
				if ($url):
					echo '<p><a href=\''.$url.'\' target=\'_blank\'>'.__('View website','sage').'</a></p>';
				endif;
				
				echo '</div>",';
				
			endwhile;
			echo '];';
			
			echo '</script>';
		endif;*/
		
		?>
		<div id="googlemap"></div>
	</div>
</div>

<div class="container">
	<div class="page-content itinerary-list">
		<?php 
		if (!empty($itineraries)):
			$itinerary_types = array_keys($itineraries);
			for($i = 0; $i < count($itineraries); $i++) {
    			// Category title
    			echo '<div class="row">';
    				echo '<div class="col-md-8 offset-md-2">';
    					echo '<h2 class="itinerary-type">';
    						if ($itinerary_types[$i] == "culture"):
    							echo __('LGBT Culture &amp; History','sage');
    						else:
    							echo $itinerary_types[$i];
    						endif;
    					echo '</h2>';
    				echo '</div>';
    			echo '</div>';
    			// End category title
    			
    			//Loop through each item in this category
    			foreach($itineraries[$itinerary_types[$i]] as $key => $itinerary_item_array) {
    				$pos = $key+1;
        			echo '<div class="row" id="stop-'.$itinerary_types[$i].'--'.$key.'">';
        				echo '<div class="col-md-1 offset-md-1"><span class="marker '.$itinerary_types[$i].'">'.$pos.'</span></div>';
        				echo '<div class="col-md-8">';
        					echo '<h3 style="padding-bottom:0">';
        					if ($itinerary_item_array["url"]):
								echo '<a href="'.$itinerary_item_array["url"].'" target="_blank">'.$itinerary_item_array["title"].'</a>';
							else:
								echo $itinerary_item_array["title"];
							endif;
							echo '</h3>';
        					echo $itinerary_item_array["description"];
        				echo '</div>';
        			echo '</div>';
    			}
    			
			}
		endif; ?>
	</div>
</div>
