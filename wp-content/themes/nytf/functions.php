<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


/* The options page feature provides a set of functions to add extra admin pages to edit ACF fields */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Homepage',
		'menu_title'	=> 'Homepage',
		'menu_slug' 	=> 'homepage-options',
		'capability'	=> 'edit_posts',
        'position'      => '10.5',
        'icon_url'      => 'dashicons-excerpt-view',
		'redirect'		=> false
	));	

    acf_add_options_page(array(
        'page_title'    => 'Social',
        'menu_title'    => 'Social',
        'menu_slug'     => 'social',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-megaphone',
        'redirect'      => false
    )); 

    /*// add parent
    $parent = acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'redirect'      => false
    ));
    
    
    // add sub page
    acf_add_options_sub_page(array(
        'page_title'    => 'Social Settings',
        'menu_title'    => 'Social',
        'parent_slug'   => $parent['menu_slug'],
    ));*/
}

/*Security measures*/
if(function_exists('remove_action')) {
	remove_action('wp_head', 'wp_generator');
}


// Redefine password from name and email, globally
add_filter( 'wp_mail_from', 'wpse_new_mail_from' );
function wpse_new_mail_from( $old ) {
    return get_option('admin_email');
}

add_filter('wp_mail_from_name', 'wpse_new_mail_from_name');
function wpse_new_mail_from_name( $old ) {
    return get_option('blogname');
}
//end

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return get_option('blogname');
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

//change the default WP login screen logo
function my_login_logo() { ?>
    <style type="text/css">
        #login {
			width:50%  !important;
		}
		.login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/dist/images/nycamp-logo.png) !important;
            padding-bottom: 30px !important;
			background-size:100% auto !important;
			width:340px !important;
			height:130px !important;
        }
		@media (max-width: 768px) {
		  #login { width:100%;}
		  .login h1 a {
		  	width:240px !important;
		  }
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo', 1 );



// Check if page is direct child
function is_child( $post_id ) { 
	
    if( is_page() && (wp_get_post_parent_id( $post_id ) > 0) ) {
       return true;
    } else { 
       return false; 
    }
}

// Check if page is an ancestor
function is_ancestor( $post_id ) {
   $children = get_pages( array( 'child_of' => $post_id ) );
    if( count( $children ) == 0 ) {
        return false;
    } else {
        return true;
    }
}

//get the subnav page links
function get_submenu($parent) {
	$args = array(
		'sort_order' => 'asc',
		'sort_column' => 'post_title',
		'hierarchical' => 1,
		'exclude' => '',
		'include' => '',
		'meta_key' => '',
		'meta_value' => '',
		'authors' => '',
		'child_of' => $parent,
		'parent' => -1,
		'exclude_tree' => '',
		'number' => '',
		'offset' => 0,
		'post_type' => 'page',
		'post_status' => 'publish'
	); 
	$pages = get_pages($args);
	return $pages;
}

//Get Next / Prev # Posts in Relation to Current Post
//http://wordpress.stackexchange.com/questions/14502/get-next-prev-3-posts-in-relation-to-current-post
function get_post_siblings( $limit, $date ) {
    global $wpdb, $post;

    if( empty( $date ) )
        $date = $post->post_date;

    //$date = '2009-06-20 12:00:00'; // test data

    $limit = absint( $limit );
    if( !$limit )
        return;

    $p = $wpdb->get_results( "
    (
        SELECT 
            p1.post_title, 
            p1.post_date,
            p1.ID
        FROM 
            $wpdb->posts p1 
        WHERE 
            p1.post_date < '$date' AND 
            p1.post_type = 'post' AND 
            p1.post_status = 'publish' 
        ORDER by 
            p1.post_date DESC
        LIMIT 
            $limit
    )
    UNION 
    (
        SELECT 
            p2.post_title, 
            p2.post_date,
            p2.ID 
        FROM 
            $wpdb->posts p2 
        WHERE 
            p2.post_date > '$date' AND 
            p2.post_type = 'post' AND 
            p2.post_status = 'publish' 
        ORDER by
            p2.post_date ASC
        LIMIT 
            $limit
    ) 
    ORDER by post_date ASC
    " );
    $i = 0;
    $adjacents = array();
    /*for( $c = count($p); $i < $c; $i++ ) {
        if( $i < $limit )
            $adjacents['prev'][] = $p[$i];
        else
            $adjacents['next'][] = $p[$i];
    }*/

    return $p;
}

//remove "Category" prefix from archives pages
add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_category() || is_tag() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});

//API key for teh ACF pro plugin backend tools
add_filter('acf/settings/google_api_key', function () {
    return 'AIzaSyAtNLJ_O8LmI6fTJqkNXM62pb5bjPVr8lk';
});

//http://blog.room34.com/archives/5360
function empty_content($str) {
    return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
}
