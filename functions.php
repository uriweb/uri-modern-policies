<?php
/**
 * URI Modern Policies functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uri-modern-policies
 */

/**
 * Enqueue scripts and styles.
 */
function uri_modern_policies_enqueues() {

	$parent_style = 'uri-modern-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

// wp_enqueue_style( 'uri-modern-policies-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'uri-modern-policies-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), strtotime( 'now' ) );

	wp_enqueue_script( 'uri-modern-policies-excerpter', get_stylesheet_directory_uri() . '/js/policies-script.min.js', array(), wp_get_theme()->get( 'Version' ), true );

}
add_action( 'wp_enqueue_scripts', 'uri_modern_policies_enqueues' );



/**
 * Redirect traffic from posts to a search result (no bookmarkable posts)
 */
function uri_modern_policies_redirect_posts_to_search() {

  if ( is_single() && 'post' == get_post_type() ) {
  
  	// redirect to a search result
  	// use the default wp search query string
  	// unless search and filter is installed, in which case, use that.
  	$qs = '?s=';
  	if ( function_exists( 'activate_search_filter' ) || class_exists( 'SearchAndFilter' ) ) {
	  	$qs = '?_sf_s=';
  	}
  
		$title = get_the_title();
		$url = get_site_url() . '?_sf_s=' . urlencode( $title );
		wp_redirect( $url );
		exit;

  }
}
add_action( 'template_redirect', 'uri_modern_policies_redirect_posts_to_search' );



/**
 * Template Parts with Display Posts Shortcode.
 *
 * @see https://www.billerickson.net/template-parts-with-display-posts-shortcode
 *
 * @param string $output current output of post.
 * @param array  $atts original attributes passed to shortcode.
 * @return string $output
 */
function uri_modern_policies_dps_template_part( $output, $atts ) {

	// Return early if our "layout" attribute is not "policies"
	if ( empty( $atts['layout']  ) || 'policies' !== $atts['layout'] ) {
		return $output;
	}

	ob_start();
	get_template_part( 'template-parts/dps', $atts['layout'] );
	$new_output = ob_get_clean();

	$output = $new_output;
	if ( ! empty( $new_output ) ) {
		$output = $new_output;
	}
	return $output;
}
add_action( 'display_posts_shortcode_output', 'uri_modern_policies_dps_template_part', 10, 2 );




/**
 * Customize opening outer markup of Display Posts Shortcode
 *
 * @see https://displayposts.com/2019/01/04/use-section-element-for-wrapper/
 *
 * @param str $output string, the original opening markup.
 * @return $output string, the modified opening markup
 */
function uri_modern_policies_dps_open( $output, $atts ) {

	if ( ! empty( $atts['layout']  ) && 'policies' === $atts['layout'] ) {
		$output = '<table class="policies-table">
				<thead>
				<tr>
					<th>Policy</th>
					<th>Category</th>
					<th>Procedure</th>
				</tr>
				</thead>
			<tbody>
		';
	}

	return $output;
}
add_filter( 'display_posts_shortcode_wrapper_open', 'uri_modern_policies_dps_open', 10, 2 );

/**
 * Customize closing outer markup of Display Posts Shortcode
 *
 * @see https://displayposts.com/2019/01/04/use-section-element-for-wrapper/
 *
 * @param str $output string, the original closing markup.
 * @return $output string, the modified closing markup
 */
function uri_modern_policies_dps_close( $output, $atts ) {
	if ( ! empty( $atts['layout']  ) && 'policies' === $atts['layout'] ) {
		$output = '</tbody></table>';
	}
	return $output;
}
add_filter( 'display_posts_shortcode_wrapper_close', 'uri_modern_policies_dps_close', 10, 2 );


