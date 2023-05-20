<?php 
/**
 *  Theme functions
 * @package argotest
 */

/** Theme support */
add_image_size('featured-l', 1200 , 900, false, array( 'jpeg_quality' => 100 ));
add_image_size('acf-image', 1200 , 900, false,array( 'jpeg_quality' => 100 ) );
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'video' ) );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
 /*end theme suport*/

 /*styles*/

  add_action('wp_enqueue_scripts', 'argo_theme_scripts');
function argo_theme_scripts()
{
  wp_register_style( 'argo-style', get_stylesheet_uri(), [], filemtime(get_template_directory() . '/style.css'), 'all' );

  wp_enqueue_style( 'tailwind', get_template_directory_uri() . '/assets/tailwind.css' );
  wp_enqueue_style('argo-style');

}

 /*end styles*/


 /*Register post type*/
 function argo_register_cpts() {

	/**
	 * Post Type: Team members.
	 */

	$labels = [
		"name" => esc_html__( "Team members", "argotest" ),
		"singular_name" => esc_html__( "Team member", "argotest" ),
		"archives" => esc_html__( "Team members", "argotest" ),
	];

	$args = [
		"label" => esc_html__( "Team members", "argotest" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => "team-members",
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "team-members", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "team-members", $args );
}

add_action( 'init', 'argo_register_cpts' );

 /*end register post type*/

 /* register acf block */
 add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/team-member-detail' );
    register_block_type( __DIR__ . '/blocks/team-member-grid' );
}
 /* end register acf block */

 function remove_wysiwyg_auto_p_tags($value, $post_id, $field) {
    if ($field['type'] === 'wysiwyg') {
        remove_filter('acf_the_content', 'wpautop'); 
        remove_filter('acf_the_content', 'shortcode_unautop'); 
    }
    return $value;
}
add_filter('acf/format_value', 'remove_wysiwyg_auto_p_tags', 10, 3);

remove_filter('acf_the_content', 'wpautop');