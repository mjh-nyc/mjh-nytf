<nav id="menu" class="nav-primary panel">
  <div class="nav-primary-wrapper clearfix">
    <?php
    if (has_nav_menu('primary_navigation_right')) :
    wp_nav_menu(['theme_location' => 'primary_navigation_right', 'menu_class' => 'nav']);
    endif;
    ?>
    <div class="nav-social">
      <?php
      $social = get_field('social_media_channels','option');
      $hashtag = get_field('hashtag','option');
      $donate_link = get_field('donate_link','option');
      if($social){
        foreach($social as $social_channel){
          $social_channel_name = $social_channel['channel_name'];
          $social_channel_url = $social_channel['url'];
          echo '<a href="'.$social_channel_url.'" target="_blank" aria-label="Open our '.$social_channel_url.' page in new window"><i class="fa fa-'.strtolower($social_channel_name).'" aria-hidden="true"><span class="sr-only">'.$social_channel_name.'</span></i></a>';
        }
      }
      ?>
      <?php 
      if($hashtag){ ?>
        <div class="nav-hashtag">
          <a href="https://instagram.com/<?php echo $hashtag; ?>" target="_blank" class="long"><span><?php echo $hashtag; ?></span></a>
        </div>
      <?php } ?>

      <?php 
      if($donate_link){ ?>
        <div class="nav-donate">
          <a href="<?php echo $donate_link; ?>" target="_blank" class="long donate"><span>Donate Now</span></a>
        </div>
      <?php } ?>

    </div>
  </div>
<!--<div class="fadeout"></div>-->
</nav>

<div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking: false">
<button data-remodal-action="close" class="remodal-close"></button>
<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="//nycaidsmemorial.us13.list-manage.com/subscribe/post?u=df8ecd1ea2b2e2ea6c945170e&amp;id=6b2c4928aa" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
<div id="mc_embed_signup_scroll">
<h2>Subscribe to our mailing list</h2>
<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<div class="mc-field-group">
<label for="mce-FNAME">First Name </label>
<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
</div>
<div class="mc-field-group">
<label for="mce-LNAME">Last Name </label>
<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
</div>
<div id="mce-responses" class="clear">
<div class="response" id="mce-error-response" style="display:none"></div>
<div class="response" id="mce-success-response" style="display:none"></div>
</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_df8ecd1ea2b2e2ea6c945170e_6b2c4928aa" tabindex="-1" value=""></div>
<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
</div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->
</div>

