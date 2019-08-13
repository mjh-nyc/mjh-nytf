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
					if ($subtitle) {
						echo '<h4>';
						echo $subtitle;
						echo '</h4>';
					}
				?>
				<?php
					$header_buttons = get_field('header_buttons');
					if ($header_buttons) {
						echo '<div class="header-buttons">';
						foreach ($header_buttons as $button):
							echo '<a href="'.$button['header_button_url'].'" class="button '.$button['header_button_class'].'">'.$button['header_button_label'].'</a>';
						endforeach;
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
</div>