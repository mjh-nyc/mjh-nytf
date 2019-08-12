<nav id="menu" class="nav-primary panel">
  <div class="nav-primary-wrapper clearfix">
    <?php
    if (has_nav_menu('primary_navigation_right')) :
    wp_nav_menu(['theme_location' => 'primary_navigation_right', 'menu_class' => 'nav']);
    endif;
    ?>
    <div class="nav-social">
      <?php
      /*$social = get_field('social_media_channels','option');
      $hashtag = get_field('hashtag','option');
      $donate_link = get_field('donate_link','option');
      if($social){
        foreach($social as $social_channel){
          $social_channel_name = $social_channel['channel_name'];
          $social_channel_url = $social_channel['url'];
          echo '<a href="'.$social_channel_url.'" target="_blank" aria-label="Open our '.$social_channel_url.' page in new window"><i class="fa fa-'.strtolower($social_channel_name).'" aria-hidden="true"><span class="sr-only">'.$social_channel_name.'</span></i></a>';
        }
      }*/
      ?>

    </div>
  </div>
</nav>