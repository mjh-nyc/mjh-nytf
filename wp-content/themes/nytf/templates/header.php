<header class="banner <?php if(!is_home()): echo "push"; endif; ?>">
    <div class="container">
        <div class="row">
            <div class="col-xs-9 search-area">
                <div class="search-form-overlay">
                    <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                        <label for="search-field" class="sr-only">Search for:</label>
                        <input type="search" id="search-field" class="search-field" name="s" title="I’m looking for..." onfocus="if(this.value == 'I’m looking for...') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'I’m looking for...'; }" value="I’m looking for..." />
                    </form>
                </div>
                <a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/dist/images/nycamp-logo.png'; ?>" alt="<?php bloginfo('name'); ?>"></a>
            </div>
            <div class="col-xs-3 menu menu-area">
                <div class="hamburger-wrapper menu-wrapper">
                    <a id="menulink" href="#" class="no-style menu-link">
                        <i class="fa fa-bars hamburger"><span class="sr-only"><?php _e( 'Menu', 'sage' ); ?></span></i>
                    </a>
                </div>

                <div class="signup-wrapper menu-wrapper">
                    <a id="signuplink" data-remodal-target="modal" href="#" class="no-style">
                        <span class="signup"><?php _e( 'Sign up', 'sage' ); ?></span>
                    </a>
                </div>
                <?php
                    $donate_link = get_field('donate_link','option');
                    if ($donate_link) { ?>
                        <div class="donatelink-wrapper menu-wrapper">
                            <a id="donatelink" href="<?php echo $donate_link; ?>" target="_blank" class="no-style"><span class="donate"><?php _e( 'Donate', 'sage' ); ?></span></a>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
    </div>
</header>