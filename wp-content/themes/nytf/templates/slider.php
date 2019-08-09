<!-- Slider main container -->
<div class="swiper-container">
 	<!-- Additional required wrapper -->
	<div class="swiper-wrapper">
    	<!-- Slides -->
        <?php
        //assumes current post/page
        $images = get_field('images');
        if( $images ):
        	foreach( $images as $image ):
        		echo '<div class="swiper-slide" style="background-image:url('.$image['sizes']['large'].')">';
        			echo '<div class="sr-only">';
        				echo $image['alt'];
        			echo '</div>';
        			if (!empty($image['caption'])):
        				echo '<div class="caption"><p>';
        					echo $image['caption'];
        				echo '</p></div>';
        			endif;
        		echo '</div>';
        	endforeach;
        endif;
        ?>
    </div>
    <!-- If we need pagination -->
	<div class="swiper-pagination"></div>
</div>
<!-- //Slider main container -->