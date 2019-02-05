<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri-modern
 */

$colspan = 3;

if ( $GLOBALS['URI_MODERN_POLICIES_TABLE_UPDATED'] || $GLOBALS['URI_MODERN_POLICIES_TABLE_CREATED'] ) {
	$colspan++;
}



?>

	<tr>
		<td class="policy">
		<?php
			$title = get_the_title();
			$policy = uri_modern_get_field( 'policy' );
			if ( $policy ) {
			echo '<a href="' . $policy . '">';
			}
			echo $title;
			if ( $policy ) {
			echo '</a>';
			}
		?>
		</td>
		
		<td class="category">
		<?php
			// the_category(',');
			$cats = array();
			$categories = get_the_category();
			foreach ( $categories as $c ) {
			$cats[] = $c->name;
			}
			echo implode( ',', $cats );
		?>
		</td>

		<?php
			$format = $GLOBALS['URI_MODERN_POLICIES_DATE_FORMAT'];
			if ( $GLOBALS['URI_MODERN_POLICIES_TABLE_UPDATED'] ) {
			echo '<td class="created">' . get_the_modified_date( $format ) . '</td>';
			}
			if ( $GLOBALS['URI_MODERN_POLICIES_TABLE_CREATED'] ) {
			echo '<td class="created">' . get_the_date( $format ) . '</td>';
			}
		?>


		<td class="procedure">
		<?php
			$procedure = uri_modern_get_field( 'procedure' );
			if ( $procedure ) {
			echo '<a href="' . $procedure . '">';
			echo 'Procedure';
			echo '</a>';
			}
		?>
		</td>
	</tr>
	<tr class="excerpt">
		<td colspan="<?php echo $colspan; ?>>">
		<?php
			$excerpt = get_the_excerpt();
			echo $excerpt;
		?>
		</td>
	</tr>

