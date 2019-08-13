<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation_right' => __('Primary Navigation', 'sage'),
    'footer_navigation' => __('Footer Navigation', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  add_image_size( 'gallery-image', 600, 400, TRUE );



  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['gallery', 'video']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  /*register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);*/

  register_sidebar([
    'name'          => __('Footer: Contact', 'sage'),
    'id'            => 'sidebar-footer-contact',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
  
  /*register_sidebar([
    'name'          => __('Footer: Legal', 'sage'),
    'id'            => 'sidebar-footer-legal',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);*/
  
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
    is_page(),
    is_single(),
    is_search(),
    is_archive()
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);



/* CUSTOM ADJUSTS */
//Logo support
function theme_prefix_setup() {

  add_theme_support( 'custom-logo', array(
    'height'      => 65,
    'width'       => 330,
    'flex-width' => true,
    'flex-height' => true,
    'header-text' => array( 'site-title', 'site-description' ),
  ) );

}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\theme_prefix_setup' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl',__NAMESPACE__ . '\\my_login_logo_url' );

function my_login_logo_url_title() {
    return get_option('blogname');
}
add_filter( 'login_headertitle',__NAMESPACE__ . '\\my_login_logo_url_title' );

//change the default WP login screen logo
function my_login_logo() {

  $custom_logo_id = get_theme_mod( 'custom_logo' );
  $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
  ?>
    <style type="text/css">
        .login {
          background-color: #ccc;
        }
        #login {
      width:50%  !important;
    }
    .login h1 a {
      background-image: url('<?php echo $logo[0]; ?>') !important;
      background-size:100% auto !important;
      width:261px !important;
      height:auto
        }
    @media (max-width: 768px) {
      #login { width:100%;}
      .login h1 a {
        width:240px !important;
      }
    }
    </style>
<?php }
add_action( 'login_enqueue_scripts',__NAMESPACE__ . '\\my_login_logo', 1 );


/*Security measures*/
if(function_exists('remove_action')) {
  remove_action('wp_head', 'wp_generator');
}

// Redefine password from name and email, globally
add_filter( 'wp_mail_from', __NAMESPACE__ . '\\wpse_new_mail_from' );
function wpse_new_mail_from( $old ) {
    return get_option('admin_email');
}

add_filter('wp_mail_from_name', __NAMESPACE__ . '\\wpse_new_mail_from_name');
function wpse_new_mail_from_name( $old ) {
    return get_option('blogname');
}
//end


//Unset the tag body class as it conflicts with bootstrap css
function bs4_remove_tag_body_class( $classes ) {
    if ( false !== ( $class = array_search( 'tag', $classes ) ) ) {
        unset( $classes[$class] );
    }
    return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\\bs4_remove_tag_body_class' );


//Remove emoji scripts introduced by WP 4.2
function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', __NAMESPACE__ . '\\disable_emojicons_tinymce' );

}
add_action( 'init', __NAMESPACE__ . '\\disable_wp_emojicons' );



// Register custom post types
function nytf_create_post_types() {
    // Register events
  $event_labels = array(
    'name' => 'Events',
      'singular_name' => 'Event',
      'add_new' => 'Add New Event',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'new_item' => 'New Event',
      'all_items' => 'All Events',
      'view_item' => 'View Event',
      'search_items' => 'Search Events',
      'not_found' =>  'No Events Found',
      'not_found_in_trash' => 'No Events Found in Trash', 
      'parent_item_colon' => '',
      'menu_name' => 'Events',
    );
  register_post_type( 'event', array(
    'labels' => $event_labels,
        'menu_icon' => 'dashicons-calendar-alt',
    'has_archive' => true,
    'public' => true,
    'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
    'exclude_from_search' => false,
    'capability_type' => 'post',
    'rewrite' => array( 'slug' => 'events' ),
    )
  );
  register_event_category();


}
add_action( 'init',  __NAMESPACE__ . '\\nytf_create_post_types' );

function register_event_category(){
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x( 'Event Categories', 'taxonomy general name', 'sage' ),
    'singular_name'     => _x( 'Event Category', 'taxonomy singular name', 'sage' ),
    'search_items'      => __( 'Search Event Categories', 'sage' ),
    'all_items'         => __( 'All Event Categories', 'sage' ),
    'parent_item'       => __( 'Parent Event Category', 'sage' ),
    'parent_item_colon' => __( 'Parent Event Category:', 'sage' ),
    'edit_item'         => __( 'Edit Event Category', 'sage' ),
    'update_item'       => __( 'Update Event Category', 'sage' ),
    'add_new_item'      => __( 'Add New Event Category', 'sage' ),
    'new_item_name'     => __( 'New Event Category Name', 'sage' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'event-category' ),
  );

  register_taxonomy( 'event_category', array( 'event' ), $args );
}