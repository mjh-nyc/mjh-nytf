<?
//*** Homepage ***/
?>

<div class="home-wrapper">
    <section id="welcome" class="fullscreen welcome" style="background-image:url('<?php the_field('initial_background', 'option'); ?>'); color:<?php the_field('text_color', 'option'); ?>">

        <div class="container">
        	
      		<div class="row welcome-content-wrapper">
      			<div class="col-md-12 welcome-content">
      				<?php 
      					$press_quote = get_field('press_quote', 'option');
      					$text_color = get_field('text_color', 'option');			
      					$welcome_screen_message = get_field('welcome_screen_message', 'option');
      					$welcome_screen_message_subheader = get_field('welcome_screen_message_subheader', 'option');
      					$buttons = get_field('buttons','option');

      					if ($press_quote) {
      						echo '<p style="color:'.$text_color.'">'.$press_quote.'</p>';
      					}
      					if ($welcome_screen_message) {
      						echo '<h1 style="color:'.$text_color.'">'.$welcome_screen_message.'</h1>';
      					}
      					if ($welcome_screen_message_subheader) {
      						echo '<h3 style="color:'.$text_color.'">'.$welcome_screen_message_subheader.'</h3>';
      					}
      				?>
      				<?php
      					if ($buttons) {
      						echo '<div class="buttons">';
      							foreach($buttons as $button){
      								echo '<a href="' . $button['button_url'] . '" class="button '.$button['button_class'].'">'.$button['button_text'].'</a>';
      							}
      						echo '</div>';
      					}
      				?>
      					
              	
      			</div>
      		</div>
      		<div class="row discover">
      			<div class="scroll-prompt">
      				<a href="javascript:void(0);" class="scroll no-style no-shadow" data-location="map" data-offset="0"><span class="bounce">&#8595;</span>Discover</a>
      			</div>
      		</div>
    	</div>
    </section>
	
    <section id="about-us" class="about-us">
    	<?php 
			$about_us_header = get_field('about_us_header', 'option');
			$about_us = get_field('about_us', 'option');
			$about_us_link = get_field('about_us_link', 'option');
			$newsletter_signup_header = get_field('newsletter_signup_header', 'option');
			$newsletter_teaser = get_field('newsletter_teaser', 'option');
		?>
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6">
    				<?php
    					if ($about_us_header) {
    						echo '<h3>'.$about_us_header.'</h3>';
    					}
    					if ($about_us) {
    						echo '<p>'.$about_us.'</p>';
    					}
    					if ($about_us_link) {
    						echo '<a href="'.$about_us_link.'" class="button black">Learn more</a>';
    					}
    				?>
    			</div>
    			<div class="col-md-6">
    				<?php
    					if ($newsletter_signup_header) {
    						echo '<h3>'.$newsletter_signup_header.'</h3>';
    					}
    					if ($newsletter_teaser) {
    						echo '<p>'.$newsletter_teaser.'</p>';
    					}
    					
    				?>
    			</div>
    			
    		</div>
    	</div>

    </section>

    <!-- FEATURES SECTION -->
    <section class="features">
		<div class="container-fluid">
		    <?php
				// check if the repeater field has rows of data
				//this area prints the custom feature blocks, controlled via WP backend under Homepage
				$i = 1;
				if( have_rows('features','option') ):
					// loop through the rows of data
					while ( have_rows('features','option') ) : the_row();

						$feature_title = get_sub_field('feature_title');
						$feature_description = get_sub_field('feature_description');
						$feature_buttons = get_sub_field('feature_buttons');
						$feature_image = get_sub_field('feature_image');

						
						echo '<div class="row feature-row">';
							echo '<div class="col-md-6 feature-img" style="background-image:url(\''.$feature_image['sizes']['large'].'\'); '.($i % 2 == 0 ? 'order:2' : '').'">';
								echo '<div>';
									echo '<p class="sr-only">'.$feature_image['alt'].'</p>';
						
								echo '</div>';
							echo '</div>';
							echo '<div class="col-md-6 feature-content '.($i % 2 == 0 ? 'left' : 'right').'" style="'.($i % 2 == 0 ? 'order:1' : '').'">';
								echo '<div class="feature-content-wrapper">';
									echo '<h2>'.$feature_title.'</h2>';
									echo '<p>'.$feature_description.'</p>';
									echo '<div class="feature-buttons">';
										if( $feature_buttons ):
											foreach ($feature_buttons as $button):
												echo '<a href="'.$button['feature_button_url'].'" class="button '.$button['feature_button_class'].'">'.$button['feature_button_text'].'</a>';
											endforeach;
										endif;
									echo '</div>';
								echo '</div>';

							echo '</div>';
						echo '</div>';
							
						$i++;
					endwhile;
				endif;
			?>
		</div>
	</section>

	<section class="events">
		<div class="container">
			<div class="events heading row">
				<h2><?php echo get_field('featured_events_header', 'option'); ?></h2>
			</div>
			<div class="events listing row">
				<?php

					function upcomingEvents() {
						$total_posts = 3;
				        $currentDate = strtotime('yesterday 11:59');
				        $pParamHash = array('post_type' => 'event','posts_per_page' => $total_posts);
				        $pParamHash['meta_query'] =  array(
				            'relation'      => 'AND',
				             array(
				                'relation'      => 'OR',
				                '0'=> array(
				                    'key'	 	=> 'event_start_date',
				                    'value'	  	=> date('Y-m-d H:i:s', $currentDate),
				                    'type'		=> 'DATETIME',
				                    'compare' 	=> '>',
				                ),
				                '1'=> array(
				                    'relation'      => 'AND',
				                    '0'=> array(
				                        'key'	 	=> 'event_end_date',
				                        'value'	  	=> date('Y-m-d H:i:s', $currentDate),
				                        'type'		=> 'DATETIME',
				                        'compare' 	=> '>',
				                    ),
				                    '1'=> array(
				                        'key'	 	=> 'event_type',
				                        'compare' 	=> '=',
				                        'value'     => 'ongoing'
				                    )
				                ),
				            )
				        );
				        $eventsHash = $events = array();
				        // check if the featured_events repeater field has event to pull out
				        if( have_rows('featured_events_repeater','option') ){
				            $eventIdHash = array();
				            $eventsRepeater = get_field('featured_events_repeater','option');
				            foreach($eventsRepeater as $featureEvent){
				                $eventIdHash[] = $featureEvent['event_item'];
				            }
				            $pParamHash['post__in'] = $eventIdHash;
				            $events = new WP_Query($pParamHash);
				            if(empty($events->posts)){
				                unset($pParamHash['post__in']);
				            }else{
				                foreach($events->posts as $event_posts){
				                    $eventsHash[] = $event_posts;
				                }
				                $pParamHash['posts_per_page'] = $total_posts - $events->post_count;
				                unset($pParamHash['post__in']);
				            }
				            unset($events);
				            $pParamHash['post__not_in'] = $eventIdHash;
				        }

				        // if posts per page is still above 0, add on remainder events of total events to display
				        if( $pParamHash['posts_per_page'] > 0  ){
				            $pParamHash['meta_key']	= 'event_start_date';
				            $pParamHash['orderby']	= 'meta_value';
				            $pParamHash['order']	= 'ASC';
				            $events = new WP_Query( $pParamHash);
				            if($events->posts){
				                foreach($events->posts as $event_posts){
				                    $eventsHash[] = $event_posts;
				                }
				            }
				        }
				        if( !empty( $eventsHash ) ) {
				            return eventSortByTime($eventsHash);
				        } else {
				        	return false;
				        }
				    }

			        function eventSortByTime($eventsHash) {
				        $events = $eventsHash;
				        if(!empty($events)){
				            $eventHash = array();
				            foreach($events AS $event){
				                $event_type = get_field( "event_type", $event->ID );
				                switch($event_type){
				                    // Always set date/time keys to zero since it is top of the list
				                    case 'recurring':
				                        $eventHash[0][0][] = $event;
				                    break;
				                    // Set array hash to date and time for the keys, then sort by time key
				                    case'onetime':
				                        $event_start_date = get_field( "event_start_date", $event->ID );
				                        $event_start_time = get_field( "event_start_time", $event->ID );
				                        if(empty($event_start_time)){
				                            $event_start_time=0;
				                        }
				                        $eventHash[strtotime($event_start_date)][strtotime($event_start_time)][]= $event;
				                        ksort($eventHash[strtotime($event_start_date)]);
				                    break;
				                    // Set array hash to date only for the keys, then sort by time key, which is set to zero for ongoing
				                    case'ongoing':
				                        $event_start_date = get_field( "event_start_date", $event->ID );
				                        $eventHash[strtotime($event_start_date)][0][]= $event;
				                        ksort($eventHash[strtotime($event_start_date)]);
				                    break;
				                }
				            }
				            // Set up posts hash
				            $eventsPostsHash = array();
				            foreach($eventHash AS $key => $eventsSorted){
				                foreach($eventsSorted AS $eventsSortedTime){
				                    if(count($eventsSortedTime) > 1){
				                        foreach($eventsSortedTime As $eventsSortedTimeSame){
				                            $eventsPostsHash[] = $eventsSortedTimeSame;
				                        }
				                    }else{
				                        $eventsPostsHash[] = array_shift($eventsSortedTime);
				                    }
				                }
				            }
				            return $eventsPostsHash;
				        }
				    }

				    //PRINT events if any found
				    $upcoming_events = upcomingEvents();
				    if ($upcoming_events) {
				    	foreach ($upcoming_events as $event) {
				    		echo '<article '; post_class(); echo '>';
				    			set_query_var( 'item_id', $event->ID );
				    			get_template_part( 'templates/content-event-card');
				    			//get_template_part('templates/content-event-card', 'header');
		        				//include $theme_uri.'/templates/content-event-card.php?item_id='.$event->ID;
		      				echo '</article>';
				    	}
				    }
				?>
			</div>
			<div class="events row see-all">
				<a href="/events" class="button black"><?php _e('See all events', 'sage'); ?></a>
			</div>
		</div>
	</section>

	<section class="callout features">
		<div class="container-fluid">
			<div class="row feature-row">
				<?php
				$callout_header = get_field('callout_header','option');
				$callout_description = get_field('callout_description','option');
				$callout_image = get_field('callout_image','option');
				$callout_button_label = get_field('callout_button_label','option');
				$callout_button_url = get_field('callout_button_url','option');
				
				$announcement = get_field('announcement','option');
				$announcement_button_label = get_field('announcement_button_label','option');
				$announcement_button_url = get_field('announcement_button_url','option');
				?>
				<div class="col-md-6 feature-content left">
					<?php 
					if ($callout_header) {
						echo '<div class="feature-content-wrapper">';
							echo '<h2>'.$callout_header.'</h2>';
							echo '<p>'.$callout_description.'</p>';
							if ($callout_button_url && $callout_button_label) {
								echo '<a href="'.$callout_button_url.'" class="button white">'.$callout_button_label.'</a>';
							}
						echo '</div>';
					} ?>
				</div>
				<div class="col-md-6 feature-img right" <?php if ($callout_image): echo 'style="background-image:url('. $callout_image['sizes']['large'].')";'; endif; ?>>

				</div>
			</div>
		</div>
	</section>
	<section class="announcement">
		<div class="container">
			<div class="row ">
				<div class="col-md-6">
					<p><?php echo $announcement; ?></p>
				</div>
				<div class="col-md-6">
					<?php echo '<a href="'.$announcement_button_url.'" class="button red">'.$announcement_button_label.'</a>'; ?>
				</div>
			</div>
		</div>
	</section>
</div>




