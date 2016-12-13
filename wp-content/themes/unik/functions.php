<?php
/*
Theme Function file
*/

/* theme supports */
function unik_theme_setup(){
	if ( ! isset( $content_width ) ){ $content_width = 768; }
	load_theme_textdomain( 'unik', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "custom-background");
	add_theme_support( 'post-thumbnails' ); //supports featured image
	register_nav_menus( array('primary' => __( 'Header Menu','unik' )) );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-width' => true,
	) );
	}
add_action('after_setup_theme', 'unik_theme_setup');

//including customizer
require( get_template_directory().'/customizer.php');

// widgets function
function unik_widgets_init() {
	register_sidebar( array(
		'name'          => __('Sidebar Widget Area','unik'),
		'id'            => 'unik_sidebar_widget',
		'before_widget' => '<div class="col-md-12 col-sm-6 blog-sidebar"><div class="sb-widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="sb-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __('Footer Widget Area','unik'),
		'id'            => 'unik_footer_widget',
		'before_widget' => '<div class="footer-widget col-md-3 col-sm-6">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="fw-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'unik_widgets_init' );

//theme default values
function unik_default_value(){
	$unik_option=array(
			'site_color'=>'#0098ff',
			'header_social'=>'off',
			'footer_social'=>'off',
			'social_icon_1'=>'',
			'social_icon_2'=>'',
			'social_icon_3'=>'',
			'social_icon_4'=>'',
			'social_icon_link_1'=>'',
			'social_icon_link_2'=>'',
			'social_icon_link_3'=>'',
			'social_icon_link_4'=>'',
			'icon_color_1'=>'',
			'icon_color_2'=>'',
			'icon_color_3'=>'',
			'icon_color_4'=>'',
			'footer_link_1'=>'',
			'footer_link_2'=>'',
			'footer_link_3'=>'',
			'footer_link_4'=>'',
			'footer_text_1'=>'',
			'footer_text_2'=>'',
			'footer_text_3'=>'',
			'footer_text_4'=>'',
			'footer_credit'=>'',
			'footer_company'=>'',
			'footer_company_link'=>'',
		);
	return apply_filters( 'unik_options', $unik_option );
}
function unik_options() {
    return wp_parse_args(get_theme_mod( 'unik_options'), unik_default_value());    
}
	
// theme style and scripts
function unik_add_style(){
	//js
	if( (is_front_page() && get_option('show_on_front')=='posts') || is_home()){
	wp_enqueue_script('unik-masonry',  get_template_directory_uri() . '/js/unik-masonry.js');
	}
	wp_enqueue_script('masonry');
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js',array('jquery') );
	wp_enqueue_script('unik-theme-script',  get_template_directory_uri() . '/js/theme-script.js');
	 
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	//css
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style('fontAwesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style('unik-stylesheet', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'unik_add_style' );
add_action('wp_footer','unik_custom_css');
function unik_custom_css(){
require( get_template_directory().'/custom/color-css.php');
}

/* navigation functions */
	function unik_post_pagination() { ?>
	<div class="unik-pagination">
	<div class="page-pre" >
	<?php next_post_link('%link',__('New Post','unik')); ?>
	</div>
	<div class="page-next" >
	<?php previous_post_link('%link',__('Old Post','unik')); ?>
	</div>
	</div>	
<?php 
	}
if ( ! function_exists( 'unik_paging_nav' ) ) :
function unik_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<div id="pagination">
			<?php if ( get_previous_posts_link() ) : ?>
			<div class="page-pre"><?php previous_posts_link( __('New Posts','unik') ); ?></div>
			<?php endif; ?>
			<?php if ( get_next_posts_link() ) : ?>
			<div class="page-next"><?php next_posts_link( __('Older Posts','unik') ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	
	<?php
}
endif;

// comment function
if ( ! function_exists( 'unik_comment' ) ) :
function unik_comment($comment, $args, $depth){
$GLOBALS['comment'] = $comment;
	//get theme data
	global $comment_data;
	//translations
	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : 
	__('Reply','unik'); ?>
    <li>
		<div class="comment-wrapper">
	<div class="comment-author">
            <?php echo get_avatar($comment,$size = '60'); ?><?php comment_author();?>
	</div>
	<div class="unik-comment"><?php comment_text() ; ?>
	<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'unik' ); ?></em>
				<br/>
				<?php endif; ?>
	</div>
	<div class="comment-actions">
		<span class="comment-date"><?php if ( ('d M  y') == get_option( 'date_format' ) ) : ?>				
				<?php comment_date('F j, Y');?>
				<?php else : ?>
				<?php comment_date(); ?>
				<?php endif; ?>
				<?php _e('at','unik');?>&nbsp;<?php comment_time('g:i a'); ?>
		</span>
		<?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
	</div>
	</li>		
<?php
}
endif;

// menu setup	
function unik_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'unik_page_menu_args' );

 
function unik_fallback_page_menu( $args = array() ) {

	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_args', $args );

	$menu = '';

	$list_args = $args;

	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = __('Home','unik');
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
			$class = 'class="current_page_item"';
		$menu .= '<li ' . $class . '><a href="' .   esc_url( home_url('/')) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}

	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$list_args['walker'] = new unik_walker_page_menu;
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

	if ( $menu )
		$menu = '<ul class="'. esc_attr($args['menu_class']) .'">' . $menu . '</ul>';

	$menu = '<div class="' . esc_attr($args['container_class']) . '">' . $menu . "</div>\n";
	$menu = apply_filters( 'wp_page_menu', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}
class unik_walker_page_menu extends Walker_Page{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class='dropdown-menu'>\n";
	}
	function start_el( &$output, $page, $depth=0, $args = array(), $current_page = 0 ) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		extract($args, EXTR_SKIP);
		$css_class = array('page_item', 'page-item-'.$page->ID);
		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'current_page_item';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}

		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';

		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;

			$output .= " " . mysql2date($date_format, $time);
		}
	}
}

class unik_nav_walker extends Walker_Nav_Menu {	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		if ($args->has_children && $depth > 0) {
			$classes[] = 'dropdown-submenu';
		} else if($args->has_children && $depth === 0) {
			$classes[] = 'dropdown';
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';	
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($args->has_children) ? '<b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) ) 
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array($this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array($this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'end_el'), $cb_args);
	}
}
function unik_nav_menu_css_class( $classes ) {
	if ( in_array('current-menu-item', $classes ) OR in_array( 'current-menu-ancestor', $classes ) )
		$classes[]	=	'active';

	return $classes;
}
add_filter( 'nav_menu_css_class', 'unik_nav_menu_css_class' );

/* breadcrumb function  */
	function unik_breadcrumbs() {
    $delimiter = ' / ';
    $home = __('Home', 'unik' );
    $before = '<li>';
    $after = '</li>';
    echo '<ul class="breadcrumbs">';
    global $post;
    $homeLink = home_url();
    echo '<li><a href="' . $homeLink . '">' . $home . '</a></li>' . $delimiter . ' ';
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before .  __("Archive by category","unik").' "' . single_cat_title('', false) . '"' . $after;
    } elseif (is_day()) {
        echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
        echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            echo $before . get_the_title() . $after;
        }
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . __('Search results for "','unik')  . get_search_query() . '"' . $after;
    } elseif (is_tag()) {        
		echo $before . __('Tag "','unik') . single_tag_title('', false) .'"'. $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . __('Articles posted by "','unik') . $userdata->display_name .'"'. $after;
    } elseif (is_404()) {
        echo $before . __("Error 404","unik") . $after;
    } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
    }
    echo '</ul>';
	}
?>