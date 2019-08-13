<?php use Roots\Sage\Titles; ?>
<?php 
//see if there's a featured image
$f = featuredImageSrc();
?>
<div class="full-width"<?php if($f): echo ' style="background-image: url('.$f.');"'; endif; ?>>
	<div class="container header">
		<div class="row">
			<div class="col-md-10"<?php if($f): echo ' style="color: '.get_field('header_text_color').';"'; endif; ?>>
				<h1 class="entry-title"><?php echo Titles\title(); ?></h1>
				<?php
					$subtitle = get_field('subtitle');
					if ($subtitle && (!is_archive() && !is_search())) {
						echo '<h4>';
						echo $subtitle;
						echo '</h4>';
					}
				?>
				<?php
					if (!is_archive() && !is_search()):
						$header_buttons = get_field('header_buttons');
						if ($header_buttons) {
							echo '<div class="header-buttons">';
							foreach ($header_buttons as $button):
								echo '<a href="'.$button['header_button_url'].'" class="button '.$button['header_button_class'].'">'.$button['header_button_label'].'</a>';
							endforeach;
							echo '</div>';
						}
					endif;
					//for events, print event details
					if (get_post_type() == 'event' && !is_archive() && !is_search()):
						echo '<div class="event-details">';
						//this is not working on godaddy
						//get_template_part( 'templates/content-event-details');
						getEventDetails();
						echo '</div>';
					endif;
				?>
			</div>
		</div>
	</div>
</div>