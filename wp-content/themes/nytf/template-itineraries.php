<?php
/**
 * Template Name: Itineraries
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'itineraries'); ?>
<?php endwhile; ?>