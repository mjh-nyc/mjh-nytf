<div class="container">
	<div class="row page-content">
		<div class="col-md-2">&nbsp;</div>
		<div class="col-md-8">
			<article <?php post_class(); ?>>
  			<header>
   		 	<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    			<?php //get_template_part('templates/entry-meta'); ?>
 		 	</header>
 		 	<div class="entry-summary">
    			<?php the_excerpt(); ?>
  			</div>
			</article>
		</div>
		<div class="col-md-2">&nbsp;</div>
	</div>
</div>
