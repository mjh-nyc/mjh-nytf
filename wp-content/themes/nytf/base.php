<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <?php
    //if(is_home()): ?>
    	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtNLJ_O8LmI6fTJqkNXM62pb5bjPVr8lk"></script>
    <?php //endif;
  ?>
  <?php
  	$bgs = array("blue", "purple", "violet");
  	$rand_key = array_rand($bgs, 1);
  	$theme_uri = get_template_directory_uri();
  	$rand_bg = $theme_uri.'/dist/images/secondary-header-'.$bgs[$rand_key].'.jpg';
  ?>
  
  <meta property="og:title" content="<?php bloginfo('name'); ?>"/>
  <meta property="og:url" content="<?php bloginfo('url'); ?>"/>
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
  <meta property="og:type" content="website"/>
  <meta property="og:description" name="description" content="<?php bloginfo('description'); ?>">
  <meta property="og:image" content="<?php echo $theme_uri.'/dist/images/nycamp-for-facebook.jpg'; ?>" />
  
  <body <?php body_class(); ?> style="background-image:url('<?php echo $rand_bg; ?>');" id="top">

    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php get_template_part('templates/nav'); ?>
    <?php
      	if(!is_home()):
      		do_action('get_header');
      		get_template_part('templates/header');
      	endif;
      ?>
    <!--<div class="wrap <?php if(is_home()):echo 'homepage'; else: echo 'container'; endif; ?>" role="document">-->

    <div class="wrap push <?php if(is_home()):echo 'homepage'; endif; ?>" role="document">
      <div <?php if(!is_home()):echo 'class="content"'; endif; ?>>
        <main class="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
