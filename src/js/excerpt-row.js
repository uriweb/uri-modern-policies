( function( $ ) {

	$( document ).ready( initExcerpter );

	function initExcerpter() {

		// Hide all of the excerpt rows
		$( 'tr.excerpt' ).toggleClass( 'excerpt-hidden' );

		$( 'table.policies-table thead tr' ).eq( 0 ).append( '<th></th>' );

		// Add an toggler widget to each row
		$( 'td.policy' ).each(

			function() {

				var excerpt = $( this ).parents( 'tr' ).next();

				if ( $( excerpt ).hasClass( 'excerpt' ) ) {

					$( this ).parent( 'tr' ).append( '<td><span class="excerpt-toggler">details</span></td>' ).click(
						function() {
							var cols;
							$( excerpt ).toggleClass( 'excerpt-hidden' );
						}
					);

					// Since we added a td, increase the colspan of the excerpt row by one
					cols = $( 'td', excerpt ).attr( 'colspan' ) * 1;
					$( 'td', excerpt ).attr( 'colspan', cols + 1 );

				}
			}
		);

	}

})( jQuery );
