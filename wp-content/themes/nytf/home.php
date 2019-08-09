<?
//*** Homepage ***/
?>

<div class="home-wrapper">
    <section id="welcome" class="fullscreen welcome" style="background-image:url('<?php the_field('initial_background', 'option'); ?>'); color:<?php the_field('text_color', 'option'); ?>">
        <div class="container">
        	<div class="row">
        		<div class="col-md-12">
            <?php
        				do_action('get_header');
      					get_template_part('templates/header');
      				?>
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-2">
      				&nbsp;
      			</div>
      			<div class="col-md-10">
      				<h1><?php the_field('welcome_screen_message', 'option'); ?></h1>
      				<p><?php the_field('welcome_screen_message_subheader', 'option'); ?></p>
      				<div class="buttons">
      					<?php the_field('buttons', 'option'); ?>
              </div>
      			</div>
      		</div>
      		<div class="row discover">
      			<div class="scroll-prompt">
      				<a href="javascript:void(0);" class="scroll no-style no-shadow" data-location="map" data-offset="0"><span class="bounce">&#8595;</span>Discover</a>
      			</div>
      		</div>
    	</div>
    </section>
	<section id="map" class="fullscreen map">
		<div id="googlemap"></div>
		<div class="container">
			<h2><?php the_field('directions_header', 'option'); ?></h2>
			<div class="directions row">
				<div class="col-md-4 public">
					<?php the_field('public_transit', 'option'); ?>
				</div>
				<div class="col-md-8 parking">
					<?php the_field('parking', 'option'); ?>
				</div>

			</div>
		</div>
	</section>


	<section id="instagram" class="fullscreen instagram">
        <div class="container">
        	<div class="row insta-header">
        		<div class="col-md-6">
        			<h2><?php _e('Your Stories','sage'); ?></h2>
        		</div>
        		<div class="col-md-6 share">
        			<i class="fa fa-instagram" aria-hidden="true"></i> <a href="https://www.instagram.com/explore/tags/nycaidsmemorial/" target="_blank"><?php _e('<span>Share your story using</span> #nycaidsmemorial','sage'); ?> &#8594;</a>

        		</div>
        	</div>
        </div>
        <div class="rows">
            <div id="instafeed">
            	<div class="instaSwiper-container">
                <div class="instaSwiper-pagination"></div>
                <ul class="instagram-lite instaSwiper-wrapper"></ul>
            	</div>
            </div>
        </div>
    </section>

	<?php
		// check if the repeater field has rows of data
		//this area prints the custom feature blocks, controll via WP backend under Homepage Options
		if( have_rows('features','option') ):
			// loop through the rows of data
			while ( have_rows('features','option') ) : the_row();

				$feature_title = get_sub_field('feature_title');
				$feature_description = get_sub_field('feature_description');
				$feature_button_link = get_sub_field('feature_button_link');
				$feature_background_image = get_sub_field('feature_background_image');
				if (!empty($feature_background_image)):
					$image_exists = ' image';
				else:
					$image_exists = '';
				endif;

				echo '<section class="fullscreen" style="background-image:url(\''.$feature_background_image.'\'); justify-content: flex-end;">';
				echo '<div class="container">';
				echo '<div class="content'.$image_exists.'">';
				echo '<h2>'.$feature_title.'</h2>';
				echo '<p>'.$feature_description.'</p>';
				echo '<a class="button hollow" href="'.$feature_button_link.'">'.__("Learn more &#8594;","sage").'</a>';
				echo '</div>';
				echo '</div>';
				echo '</section>';


			endwhile;
		endif;
	?>

	<!--<section class="resources">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2><?php _e("Learn more about HIV & AIDS","sage"); ?></h2>
					<a href="#" class="button white"><?php _e("Find Resources","sage"); ?></a>
				</div>
				<div class="col-md-6">
					<h2><?php _e("Help keep us strong! Donate.","sage"); ?></h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent elementum neque mauris, id pharetra purus hendrerit non. Quisque sit amet facilisis turpis.</p>
					<a href="#" class="button hollow"><?php _e("Donate Now!","sage"); ?></a>

				</div>
			</div>
		</div>
	</section>-->

	<section id="helpers">
		<div class="content prefooter">
			<div class="left">
				<h2><?php _e("Learn more about HIV & AIDS","sage"); ?></h2>
				<a href="/resources/" class="button white"><?php _e("Find Resources","sage"); ?></a>
			</div>
			<div class="right">
				<h2><?php _e("Help keep us strong. Donate.","sage"); ?></h2>
				<p><?php _e("Become a Friend of the NYC AIDS Memorial by making a secure online donation.","sage"); ?></p>
				<a href="https://gaycenter.org/aidsmemorialpark" class="button hollow" target="_blank"><?php _e("Donate Now!","sage"); ?></a>

			</div>
		</div>
	</section>

</div>




