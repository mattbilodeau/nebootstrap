<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)

// Shortcodes
require_once('library/shortcodes.php');


// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

// Custom Backend Footer
add_filter('admin_footer_text', 'wp_bootstrap_custom_admin_footer');
function wp_bootstrap_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://320press.com" target="_blank">320press</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.';
}

// adding it to the admin area
add_filter('admin_footer_text', 'wp_bootstrap_custom_admin_footer');

// Set content width
if ( ! isset( $content_width ) ) $content_width = 580;

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'wpbs-featured', 780, 300, true );
add_image_size( 'wpbs-featured-home', 970, 311, true);
add_image_size( 'wpbs-featured-carousel', 970, 400, true);

/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function wp_bootstrap_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Main Sidebar',
    	'description' => 'Used on every page BUT the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Homepage Sidebar',
    	'description' => 'Used only on the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
      'id' => 'footer1',
      'name' => 'Footer 1',
      'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer2',
      'name' => 'Footer 2',
      'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer3',
      'name' => 'Footer 3',
      'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));
    
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function wp_bootstrap_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="comment-author vcard clearfix">
				<div class="avatar col-sm-3">
					<?php echo get_avatar( $comment, $size='75' ); ?>
				</div>
				<div class="col-sm-9 comment-text">
					<?php printf('<h4>%s</h4>', get_comment_author_link()) ?>
					<?php edit_comment_link(__('Edit','wpbootstrap'),'<span class="edit-comment btn btn-sm btn-info"><i class="glyphicon-white glyphicon-pencil"></i>','</span>') ?>
                    
                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert-message success">
          				<p><?php _e('Your comment is awaiting moderation.','wpbootstrap') ?></p>
          				</div>
					<?php endif; ?>
                    
                    <?php comment_text() ?>
                    
                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                    
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

// Display trackbacks/pings callback function
function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php 

}

/************* SEARCH FORM LAYOUT *****************/

/****************** password protected post form *****/

add_filter( 'the_password_form', 'custom_password_form' );

function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<div class="clearfix"><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . '<p>' . __( "This post is password protected. To view it please enter your password below:" ,'wpbootstrap') . '</p>' . '
	<label for="' . $label . '">' . __( "Password:" ,'wpbootstrap') . ' </label><div class="input-append"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'wpbootstrap' ) . '" /></div>
	</form></div>
	';
	return $o;
}

/*********** update standard wp tag cloud widget so it looks better ************/

add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}

// filter tag clould output so that it can be styled by CSS
function add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";

    foreach( $tags as $tag ) {
    	$tagn[] = preg_replace($regex, "('$1$2 label tag-'.get_tag($2)->slug.'$3')", $tag );
    }

    $taglinks = implode('</a>', $tagn);

    return $taglinks;
}

add_action( 'wp_tag_cloud', 'add_tag_class' );
add_filter( 'wp_tag_cloud','wp_tag_cloud_filter', 10, 2) ;
function wp_tag_cloud_filter( $return, $args ) {
  return '<div id="tag-cloud">' . $return . '</div>';
}

// Enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );


// Disable jump in 'read more' link
add_filter( 'the_content_more_link', 'remove_more_jump_link' );
function remove_more_jump_link( $link ) {
	$offset = strpos($link, '#more-');
	if ( $offset ) {
		$end = strpos( $link, '"',$offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Add the Meta Box to the homepage template
function add_homepage_meta_box() {  
	global $post;

	// Only add homepage meta box if template being used is the homepage template
	// $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : "");
	$post_id = $post->ID;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

	if ( $template_file == 'page-homepage.php' ){
	    add_meta_box(  
	        'homepage_meta_box', // $id  
	        'Optional Homepage Tagline', // $title  
	        'show_homepage_meta_box', // $callback  
	        'page', // $page  
	        'normal', // $context  
	        'high'); // $priority  
    }
}

add_action( 'add_meta_boxes', 'add_homepage_meta_box' );

// Field Array  
$prefix = 'custom_';  
$custom_meta_fields = array(  
    array(  
        'label'=> 'Homepage tagline area',  
        'desc'  => 'Displayed underneath page title. Only used on homepage template. HTML can be used.',  
        'id'    => $prefix.'tagline',  
        'type'  => 'textarea' 
    )  
);  

// The Homepage Meta Box Callback  
function show_homepage_meta_box() {  
  global $custom_meta_fields, $post;

  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );
    
  // Begin the field table and loop
  echo '<table class="form-table">';

  foreach ( $custom_meta_fields as $field ) {
      // get value of this field if it exists for this post  
      $meta = get_post_meta($post->ID, $field['id'], true);  
      // begin a table row with  
      echo '<tr> 
              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
              <td>';  
              switch($field['type']) {  
                  // text  
                  case 'text':  
                      echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" /> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
                  break;
                  
                  // textarea  
                  case 'textarea':  
                      echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="80" rows="4">'.$meta.'</textarea> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
                  break;  
              } //end switch  
      echo '</td></tr>';  
  } // end foreach  
  echo '</table>'; // end table  
}  

// Save the Data  
function save_homepage_meta( $post_id ) {  

    global $custom_meta_fields;  
  
    // verify nonce  
    if ( !isset( $_POST['wpbs_nonce'] ) || !wp_verify_nonce($_POST['wpbs_nonce'], basename(__FILE__)) )  
        return $post_id;

    // check autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    // check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
    }
  
    // loop through fields and save the data  
    foreach ( $custom_meta_fields as $field ) {
        $old = get_post_meta( $post_id, $field['id'], true );
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta( $post_id, $field['id'], $new );
        } elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id, $field['id'], $old );
        }
    } // end foreach
}
add_action( 'save_post', 'save_homepage_meta' );

// Add thumbnail class to thumbnail links
function add_class_attachment_link( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a','<a class="thumbnail"',$html );
    return $html;
}
add_filter( 'wp_get_attachment_link', 'add_class_attachment_link', 10, 1 );

// Add lead class to first paragraph
function first_paragraph( $content ){
    global $post;

    // if we're on the homepage, don't add the lead class to the first paragraph of text
    if( is_page_template( 'page-homepage.php' ) )
        return $content;
    else
        return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
}
add_filter( 'the_content', 'first_paragraph' );

// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

	 global $wp_query;
	 $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	 $class_names = $value = '';
	
		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			$class_names = "dropdown ";
		}
	
		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		
		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
       
   	$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

   	$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
   	$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
   	$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
   	$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

   	// if the item has children add these two attributes to the anchor tag
   	// if ( $args->has_children ) {
		  // $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    // }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
    $item_output .= $args->link_after;

    // if the item has children add the caret just before closing the anchor tag
    if ( $args->has_children ) {
    	$item_output .= '<b class="caret"></b></a>';
    }
    else {
    	$item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
  } // end start_el function
        
  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
      
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
        $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }        
}

add_editor_style('editor-style.css');

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );

function add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
    $classes[] = "active";
	}
  
  return $classes;
}

// enqueue styles
if( !function_exists("theme_styles") ) {  
    function theme_styles() { 
        // This is the compiled css file from LESS - this means you compile the LESS file locally and put it in the appropriate directory if you want to make any changes to the master bootstrap.css.
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/bootstrap.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'bootstrap' );

        // For child themes
        wp_register_style( 'wpbs-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'wpbs-style' );
    }
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

// enqueue javascript
if( !function_exists( "theme_js" ) ) {  
  function theme_js(){
  
    wp_register_script( 'bootstrap', 
      get_template_directory_uri() . '/library/js/bootstrap.min.js', 
      array('jquery'), 
      '1.2' );
  
    wp_register_script( 'wpbs-scripts', 
      get_template_directory_uri() . '/library/js/scripts.js', 
      array('jquery'), 
      '1.2' );
  
    wp_register_script(  'modernizr', 
      get_template_directory_uri() . '/library/js/modernizr.full.min.js', 
      array('jquery'), 
      '1.2' );
  
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('wpbs-scripts');
    wp_enqueue_script('modernizr');
    
  }
}
add_action( 'wp_enqueue_scripts', 'theme_js' );





if ( ! function_exists( 'zenAgency_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function zenAgency_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on zenAgency, use a find and replace
	 * to change 'zenAgency' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'zenAgency', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'zenAgency' ),
		'mobile' => esc_html__( 'Mobile Menu', 'zenAgency' ),
		'subpage' => esc_html__( 'Subpage Menu', 'zenAgency' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'zenAgency_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // zenAgency_setup
add_action( 'after_setup_theme', 'zenAgency_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zenAgency_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zenAgency_content_width', 640 );
}
add_action( 'after_setup_theme', 'zenAgency_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zenAgency_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'zenAgency' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header Right', 'zenagency' ),
		'id'            => 'header-right',
		'description'   => 'Zen Agency header right section',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Banner', 'zenagency' ),
		'id'            => 'home-banner',
		'description'   => 'Zen Agency Home Banner section',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Content', 'zenagency' ),
		'id'            => 'homepage-content',
		'description'   => 'Zen Agency Home Content section',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget 1', 'zenagency' ),
		'id'            => 'footer-widget-1',
		'description'   => 'Zen Agency Footer Widget Area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget 2', 'zenagency' ),
		'id'            => 'footer-widget-2',
		'description'   => 'Zen Agency Footer Widget Area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
		register_sidebar( array(
		'name'          => esc_html__( 'Mobile Footer widget', 'zenagency' ),
		'id'            => 'mobile-footer-widget',
		'description'   => 'Zen Agency Mobile Footer Widget Area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'zenAgency_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zenAgency_scripts() {
	
	if (!is_admin()) {
		wp_deregister_script('jquery');
		// load the Google API copy in the footer
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.11.3');
		wp_register_script('zepto', 'http://cdn.jsdelivr.net/zepto/1.0rc1/zepto.min.js', false, '1.11.3');
		// Compiled and minified JavaScript -->
		wp_register_script('materialize', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js', false, '1.11.3');
		wp_register_script('generator', get_bloginfo( 'stylesheet_directory' ) . '/js/social-generator.js', false, '1.11.3');
				wp_register_script('bxslider', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.bxslider.min.js', false, '1.11.3');

        wp_register_script('init', get_bloginfo( 'stylesheet_directory' ) . '/js/init.js', false, '1.11.3');
		wp_enqueue_script('jquery');
		wp_enqueue_script('zepto');
		wp_enqueue_script('scrollfire'); 
		wp_enqueue_script('materialize');
		wp_enqueue_script('bxslider');
		wp_enqueue_script('init');
		wp_enqueue_script('generator');
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zenAgency_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


// CUSTOM POST TYPES
require get_template_directory() . '/inc/custom-post-types.php';
 
 //* Add support for custom header
	/** Push $args into theme support array */
get_theme_support( 'custom-header' );

add_theme_support( 'custom-header', array(
	'flex-height'     => true,
	'width'           => 800,
	'height'          => 142,
	'header-selector' => '.site-title a',
	'header-text'     => false,

) );

// Add Custom Image Sizes
add_action( 'after_setup_theme', 'setup_image_sizes' );
function setup_image_sizes() {
    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'home-post-thumbnail', 300,200, false, array( center, center ) );
	add_image_size('certifications-thumbnail', 150,150, false, array(center, center));
	add_image_size( 'case-studies-thumbnail', 200,200, false, array( center, center ) );
	add_image_size( 'case-studies-full', 600,600, false, array( center, center ) );
	add_image_size( 'partners-thumbnail', 444,150, false, array( left, center ) );
	add_image_size( 'team-thumbnail', 300,300, false, array( center, center ) );
    }
}

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
 
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'     => 'Theme Options',
        'menu_title'    => 'Theme Options',
        'menu_slug'     => 'theme-options',
        'capability'    => 'edit_posts',
        'redirect'        => true
    ));
	acf_add_options_sub_page(array(
        'page_title'     => 'Home Page Options',
        'menu_title'    => 'Home Page',
        'parent_slug'    => 'theme-options',
    ));
	acf_add_options_sub_page(array(
        'page_title'     => 'Theme Footer Options',
        'menu_title'    => 'Footer',
        'parent_slug'    => 'theme-options',
    ));
    

}

function case_studies_slider_func(  )  {
	/*
		* Case Studies Slider
	*/
	
	
	$case_studies_slides = get_field('case_studies_relationship');
	if( $case_studies_slides ): 
	?>
    <div id="casestudies_carousel" class="carousel slide">
        <div class="carousel-inner">	
        <?php
            $count = 0;
            foreach( $case_studies_slides as $case_studies_slide ) {
                ?>
                <div class="item <?php if ($count == 0) { echo "active"; }?>">
                	<div class="carousel-caption">
                    <a href="<?php echo the_permalink( $case_studies_slide->ID ); ?>" > <?php
                    echo get_the_post_thumbnail( $case_studies_slide->ID ,'certifications-thumbnail', array('class' => 'alignleft') );
                    ?></a>
                    
                        <h3><a href="<?php echo the_permalink( $case_studies_slide->ID ); ?>"> <?php echo get_the_title($case_studies_slide->ID); ?></a>
                        </h3>
                        <p><?php echo get_the_excerpt( $case_studies_slide->ID );?></p>
                        <p><a href="<?php echo the_permalink( $case_studies_slide->ID ); ?>" class="read-casestudy">READ THE  CASE STUDY</a></p>
                    </div>
                </div>
                <?php 
                $count++;
            }
              ?>
        </div>
 <?php 
 	if ($count > 1) {
		?>       
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
<?php } ?>    
    </div>    
<?php
	endif;
}

function case_studies_slider_func_old(  )  {
	/*
		* Case Studies Slider
	*/

	$case_studies_slides = get_field('case_studies_relationship');
	if( $case_studies_slides ): 
	?>
<div id="casestudies_carousel" class="carousel slide">
  <div class="carousel-inner">
    <?php
    $count = 0;
    foreach( $case_studies_slides as $case_studies_slide ) { ?>
    <div class="item <?php if ($count == 0) { echo "active"; }?>">
      <div class="carousel-caption">
        <a href="<?php echo the_permalink( $case_studies_slide->ID ); ?>" > <?php
          echo get_the_post_thumbnail( $case_studies_slide->ID ,'certifications-thumbnail', array('class' => 'alignleft') );
        ?></a>
        <h3><a href="<?php echo the_permalink( $case_studies_slide->ID ); ?>"> <?php echo get_the_title($case_studies_slide->ID); ?></a></h3>
        <p><?php echo get_the_excerpt( $case_studies_slide->ID );?></p>
        <p><a href="<?php echo the_permalink( $case_studies_slide->ID ); ?>" class="read-casestudy">READ THE  CASE STUDY</a></p>
      </div>
    </div>
    <?php
    $count++;
    }
    ?>
  </div>
 <?php 
 	if ($count > 1) { ?>
  <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
<?php } ?>
</div>
<?php
	endif;
}
 
function certifications_func( ) {
	/*
		* certifications
	*/
	
	$certification = get_field('certifications_and_qualification_relationship');
	$certification_title = get_field('certifications_and_qualification_relationship_title');
	if ($certification_title == "") $certification_title = 'CERTIFICATIONS & <span style="color: #fe0000;">QUALIFICATIONS</span>';
	if( $certification ): 
	?>
<section id="certifications_wrapper" class="certifications">
	<div class="text-center">
		<div class="row">
			<div class="col-md-12">
				<h1><?php echo $certification_title ?></h1>
			</div>
		</div>
		<div class="row">
		
		<?php 
		foreach( $certification as $p ): // variable must NOT be called $post (IMPORTANT) ?>
			<div class="col-xs-6 col-md-2">
				<a href="<?php echo get_permalink( $p->ID ); ?>" class="thumbnail"><?php echo get_the_post_thumbnail( $p->ID ,'certifications-thumbnail'); ?></a>
			</div>
		<?php endforeach; ?>
		</div>
	<?php endif; ?>
	</div>
</section>
<?php
}

function partners_func( $atts ) {
/*
	* Partners
*/
?>
<section  id="partners_wrapper">
  <div class="row partners">
    <?php
		$partners = new WP_Query(array( 'post_type' => 'case_studies', 'posts_per_page' => 4 ) );
		while ( $partners->have_posts() ) : $partners->the_post(); $count++;
		?>
          <article class="partners-wrap col-md-6">
        <div class="col-md-12">
        <?php
			// Must be inside a loop.
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('partners-thumbnail', array('class' => 'alignleft'));
			}
			else {
				echo '<img width="444" height="150" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/placeholder-thumbnail.jpg" class="aligncenter wp-post-image" alt="Zen Agency Placeholder" />';
			}
			?>
           </div>
           <div class="col-md-7 border-right">
        <h5> 
          <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
        </h5>
        <p><?php echo the_excerpt(); ?></p>
      		</div>
            <div class="col-md-5"><a href="<?php echo the_permalink(); ?>" class="view-project-details">VIEW PROJECT DETAILS</a></div>
    </article>
    <?php 
	  if ( 0 == $count%2 ) {
        ?><div class="border-bottom border-<?php echo $count+0 ?>"></div><?php
    }
   endwhile; wp_reset_postdata();?>
  </div>
</section>
<?php
}

function more_services_func_thumbnail($ppid) {
        $more_services = get_field('more_services_footer_section', 'option');
        if($more_services):
                ?>

<div class="container" id="services">
	<div class="row">
		<div class="text-center">
			<h1>More <span style="color: #ed2324;">Services</span></h1>
		</div>
	</div>
	<div class="row">
		<?php		
		
                if( have_rows('service_tab_repeater', 'option')): $i = -1;
                        while( have_rows('service_tab_repeater', 'option')) : the_row(); $i++;
                                $title = get_sub_field('title');
                                $content = get_sub_field('content');
                                $icon  = get_sub_field('icon');
                                $eurl = get_sub_field('enterprise_link');
                                $surl = get_sub_field('small_business_link');
                                $pid = "";
                                if ($ppid == 8) $purl = $eurl;     // parent post id == 8 enterprise
                                elseif ($ppid == 10) $purl = $surl;        // parent post_id == 10   small business
                                $active = "";
                                ?>
		<div class="col-md-2 col-xs-1">
			<a style="border: 0px;" href="<?php echo $purl; ?>" class="thumbnail <?php echo $active ?>">
				<img src="<?php echo $icon ?>" class="img-responsive" />
				<div class="caption text-center">
					<h5><?php echo $title;?></h5>
				</div>
			</a>
		</div>
<?php
                                endwhile; endif; wp_reset_postdata();?>
	</div>
</div>
                <?php
        endif;
}

function more_services_func($ppid) {
	$more_services = get_field('more_services_footer_section', 'option');
	if($more_services):
		?>
		<div class="container" id="services">
			<ul class="nav nav-pills nav-justified">
            	<li class="text-center">
                	<h5>More <span style="color: #ed2324;">Services</span></h5>
                </li>
		<?php
		if( have_rows('service_tab_repeater', 'option')): $i = -1;
			while( have_rows('service_tab_repeater', 'option')) : the_row(); $i++;
				$title = get_sub_field('title');
				$content = get_sub_field('content');
				$icon  = get_sub_field('icon');
				$eurl = get_sub_field('enterprise_link');
				$surl = get_sub_field('small_business_link');
				$pid = "";
				if ($ppid == 8) $purl = $eurl;	// parent post id == 8 enterprise
				elseif ($ppid == 10) $purl = $surl;	// parent post_id == 10   small business
				$active = "";
				?>
				<li class="<?php echo $active ?>">
					<a href="<?php echo $purl; ?>" class="btn btn-primary">
						<img src="<?php echo $icon ?>"/>
						<h5><?php echo $title;?></h5>
					</a>
				</li>
				<?php
				endwhile; endif; wp_reset_postdata();?>
			</ul>
			<div class="clear"></div>
			</div>
		</div>	
		<?php
	endif;
}
// print_rr makes debugging easier
if(!function_exists('print_rr')) {
    function print_rr($array,$comment = FALSE) {
        echo '<pre style="position:fixed; top:0px;">';
        print_r($array);
        echo '</pre>';
    }
}
// Show which template Wordpress is pulling on the page
/*add_filter( 'template_include', 'portfolio_page_template', 99 );
function portfolio_page_template( $template ) {
    global $wp_query;
    print_rr($template);
    return $template;
}*/

function ShortTitle($text) {
			// Change to the number of characters you want to display
	$chars_limit = 60;
	$chars_text = strlen($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	
		// If the text has more characters that your limit,
		//add ... so the user knows the text is actually longer
	
	if ($chars_text > $chars_limit) {
			$text = $text."...";
	}
	return $text;
}

function ShortExcerpt($text) {
		// Change to the number of characters you want to display
	$chars_limit = 300;
	$chars_text = strlen($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	
		// If the text has more characters that your limit,
		//add ... so the user knows the text is actually longer
	
	if ($chars_text > $chars_limit) {
		$text = $text."...";
	}
	return $text;
}

?>
