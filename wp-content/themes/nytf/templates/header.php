<header class="banner push">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
                    <?php
                        if ( has_custom_logo() ) {
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                            echo '<img src="' . esc_url( $image[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
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