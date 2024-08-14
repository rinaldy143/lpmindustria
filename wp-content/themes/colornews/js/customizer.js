/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Site layout
	wp.customize( 'colornews_site_layout', function ( value ) {
		value.bind( function ( layout ) {
			var layout_options = layout;
			if ( layout_options == 'boxed_layout' ) {
				$( 'body' ).addClass( 'boxed-layout' );
				$( 'body' ).removeClass( 'wide' );
			} else if( layout == 'wide_layout' ) {
				$( 'body' ).removeClass( 'boxed-layout' );
				$( 'body' ).addClass( 'wide' );
			}
		});
	});
} )( jQuery );
