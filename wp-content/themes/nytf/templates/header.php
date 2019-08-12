<header class="banner push">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
                    <?php
                        if ( has_custom_logo() ) {
                            echo '<img src="' . esc_url( $logo ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                        } else {
                            echo get_bloginfo( 'name' );
                        } ?>
            </div>
            <div class="col-xs-3 menu menu-area">
                <div class="hamburger-wrapper menu-wrapper">
                    <a id="menulink" href="#" class="no-style menu-link">
                        <i class="fa fa-bars hamburger"><span class="sr-only"><?php _e( 'Menu', 'sage' ); ?></span></i>
                    </a>
                </div>

                <div class="signup-wrapper menu-wrapper">
                    
                </div>
            </div>
        </div>
    </div>
</header>