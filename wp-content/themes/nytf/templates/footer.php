<?php
  $announcement = get_field('announcement','option');
  $announcement_button_label = get_field('announcement_button_label','option');
  $announcement_button_url = get_field('announcement_button_url','option');
?>
<footer class="content-info push">
  <section class="announcement">
    <div class="container">
      <div class="row ">
        <div class="col-md-2">
         
        </div>
        <div class="col-md-8 announcement-content">
          <p><?php echo $announcement; ?></p>
          <?php echo '<a href="'.$announcement_button_url.'" class="button red">'.$announcement_button_label.'</a>'; ?>
        </div>
        <div class="col-md-2">
          
        </div>
      </div>
    </div>
  </section>
  <div class="footer-wrapper contact">
      <div class="container primary">
        <?php dynamic_sidebar('sidebar-footer-contact'); ?>
        <?php dynamic_sidebar('sidebar-footer-legal'); ?>
        <section class="widget social">
          <?php 
            $social_media_channels = get_field('social_media_channels', 'option');
            if ($social_media_channels) {
              foreach($social_media_channels as $channel){
                echo '<a href="'.$channel['url'].'"><i class="fa fa-'.strtolower($channel['channel_name']).'"></i><span class="sr-only">'.$channel['channel_name'].'</span></a>';
              }
            }
          ?>
        </section>
      </div>
  </div>
  <div class="footer-wrapper legal">
      <div class="container secondary">
        <?php wp_nav_menu( array( 'theme_location' => 'footer_navigation', 'container_class' => 'footer-navigation-links' ) ); ?>
        <div class="legal-copy">
          &#169; <?php echo date("Y"); ?> <?php echo get_bloginfo( 'name' ); ?>. <?php _e('All Rights Reserved.','sage'); ?> 
        </div>
      </div>
  </div>
</footer>
<script type="text/javascript">
   adroll_adv_id = "YBQKWER64JH3LMQMBX5D5P";
   adroll_pix_id = "LCQXWFZ4MRBJDJZK7GBSGK";

   (function () {
       var _onload = function(){
           if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
           if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
           var scr = document.createElement("script");
           var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
           scr.setAttribute('async', 'true');
           scr.type = "text/javascript";
           scr.src = host + "/j/roundtrip.js";
           ((document.getElementsByTagName('head') || [null])[0] ||
               document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
       };
       if (window.addEventListener) {window.addEventListener('load', _onload, false);}
       else {window.attachEvent('onload', _onload)}
   }());
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '142489974-1', 'auto');
  ga('send', 'pageview');

</script>