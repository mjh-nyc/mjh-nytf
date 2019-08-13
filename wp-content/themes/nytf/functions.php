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


/**
 * Return featured image of post src only
 *
 * @return string
 */
function featuredImageSrc($size='large',$id=false)
{
    $image = "";
    if (!$id){
        $id = get_the_ID();
    }
    if (has_post_thumbnail( $id ) ) {
        $thumb_id = get_post_thumbnail_id($id);
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, $size, true);
        $image = $thumb_url_array[0];

    } 
    if (!$image) {
        //use default image entered under social in theme options
        $image = get_field('social','option');
    }
    return $image;
}
/**
 * Return featured image of post
 *
 * @return html
 */
function featuredImage($size='large',$id=false)
{
    $image = "";
    if (!$id){
        $id = get_the_ID();
    }
    if (has_post_thumbnail( $id ) ) {
        $image = get_the_post_thumbnail( $id, $size );
    }
    return $image;
}

 /**
 * Return featured image alt, pass post ID
 *
 * @return string
 */
function featuredImageAlt($id=false)
{
    $image_alt = "";
    if ($id) {
        $post_thumbnail_id = get_post_thumbnail_id($id);
        $image_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true);
    }
    return $image_alt;
}


/**
 * Return the post categories in a string
 *
 * @return string
 */
function postTermsString($id=false, $taxonomy = '')
{
    $terms = postTerms($id, $taxonomy);
    $term_string = '';
    if(!empty($terms)){
        foreach ($terms as $key=> $term){
            if($key > 0){
                $term_string.=", ";
            }
            $term_string.=$term->name;
        }
    }
    return $term_string;
}

/**
 * Return the post terms
 *
 * @return array
 */
function postTerms($id=false, $taxonomy = '')
{
    if (!$id){
        $id = get_the_ID();
    }
    return get_the_terms($id,$taxonomy);
}

/**
 * Used by various functions to truncate the string to specified number of words
 *
 * @return string
 */
function truncateString($string, $limit=5) {
    if ($string) {
        if (str_word_count($string, 0) > $limit) {
              $words = str_word_count($string, 2);
              $pos = array_keys($words);
              $string = substr($string, 0, $pos[$limit]) . '...';
          }
          return $string;
    }
}

/**
 * Compares start and end date and cleans output if same day
 *
 * @return string
 */
function cleanDateOutput($start_date, $end_date){
    if( empty($end_date) ){
        return $start_date;
    }
    $start_date_day = date('Y-m-d', strtotime($start_date));
    $end_date_day = date('Y-m-d', strtotime($end_date));
    if($start_date_day == $end_date_day ){
        $date_output = $start_date;
    }else{
        $date_output = date('M j', strtotime($start_date))." &#8211; ".date('M j, Y', strtotime($end_date));
    }
    return $date_output;
}


/**
 * Evaluate if an event is PAST, returns true if past, requires start and end dates
 *
 * @return bool
 */
function evalEventStatus($start_date, $end_date){
    return evalDateStatus($start_date, $end_date);
}
/**
 * Evaluate if date is in the past
 *
 * @return bool
 */
function evalDateStatus($start_date, $end_date){
    //convert to timestamp 
    $start_date = strtotime($start_date);
    $end_date = strtotime($end_date);
    date_default_timezone_set('America/New_York');
    $now = strtotime('yesterday 11:59:59');
    if (!$start_date && !$end_date) {
        return false;
    } elseif($start_date == $end_date || !$end_date){
       //just look at the start date
        if ($now > $start_date) {
            return true; //passed
        } else {
            return false;
        }
    } else {
       //if the end date is in the future, this is not a past event
        //use the end date for comparison
        if ($now > $end_date) {
            return true; //passed

        } else {
            return false;
        }
    }
}
