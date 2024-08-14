jQuery( document ).ready( function () {
	jQuery( '.search-icon' ).click( function () {
		jQuery( '.search-box' ).toggleClass( 'active' );
	} );

	jQuery( '.close' ).click( function () {
		jQuery( '.search-box' ).removeClass( 'active' );
	} );

	/******** bx-slider ***********/
	if ( typeof jQuery.fn.bxSlider !== 'undefined' ) {
		jQuery( '.bxslider' ).bxSlider( {
			pagerCustom : '.bx-pager',
			controls    : false,
			auto        : true
		} );

		jQuery( '.carousel-slider' ).bxSlider( {
			minSlides   : 5,
			maxSlides   : 8,
			slideWidth  : 133,
			slideMargin : 7,
			pager       : false
		} );

		jQuery( '.blog .gallery-images, .archive .gallery-images, .search .gallery-images, .single-post .gallery-images' ).bxSlider( {
			mode           : 'fade',
			speed          : 1500,
			auto           : true,
			pause          : 3000,
			adaptiveHeight : true,
			nextText       : '',
			prevText       : '',
			pager          : false
		} );
	}

	jQuery( '.category-toggle-block' ).click( function () {
		jQuery( '.category-menu' ).slideToggle();
	} );

	jQuery( '#site-navigation .menu-toggle' ).click( function () {
		jQuery( '#site-navigation .menu' ).slideToggle( 'slow' );
	} );

	jQuery( '#site-navigation .menu-item-has-children' ).append( '<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>' );

	jQuery( '#site-navigation .sub-toggle' ).click( function () {
		jQuery( this ).parent( '.menu-item-has-children' ).children( 'ul.sub-menu' ).first().slideToggle( '1000' );
		jQuery( this ).children( '.fa-angle-right' ).first().toggleClass( 'fa-angle-down' );
	} );

	// scroll up setting
	jQuery( '#scroll-up' ).hide();
	jQuery( function () {
		jQuery( window ).scroll( function () {
			if ( jQuery( this ).scrollTop() > 800 ) {
				jQuery( '#scroll-up' ).fadeIn();
			} else {
				jQuery( '#scroll-up' ).fadeOut();
			}
		} );
		jQuery( 'a#scroll-up' ).click( function () {
			jQuery( 'body,html' ).animate( {
				scrollTop : 0
			}, 1400 );
			return false;
		} );
	} );

	/* FitVids Setting */
	jQuery( '.fitvids-video' ).fitVids();

	// Featured image pop up.
	if ( typeof jQuery.fn.magnificPopup !== 'undefined' ) {
		jQuery( '.image-popup' ).magnificPopup( { type : 'image' } );
	}

	// For sticky menu.
	if ( typeof jQuery.fn.sticky !== 'undefined' ) {
		var wpAdminBar = jQuery( '#wpadminbar' );
		if ( wpAdminBar.length ) {
			jQuery( '.bottom-header-wrapper' ).sticky( {
				topSpacing : wpAdminBar.height(),
				zIndex     : 999
			} );
		} else {
			jQuery( '.bottom-header-wrapper' ).sticky( {
				topSpacing : 0,
				zIndex     : 999
			} );
		}
	}

	// For ticker setting.
	if ( typeof jQuery.fn.tickerme !== 'undefined' ) {
		jQuery( '#typing' ).tickerme( {
			fade_speed : 1500,
			duration   : 5000,
		} );
	}


} );
jQuery( document ).on( 'click', '#site-navigation .menu li.menu-item-has-children > a', function ( event ) {
	var menuClass = jQuery( this ).parent( '.menu-item-has-children' );
	if ( ! menuClass.hasClass( 'focus' ) ) {
		menuClass.addClass( 'focus' );
		event.preventDefault();
		menuClass.children( '.sub-menu' ).css( {
			'display' : 'block'
		} );
	}
} );

( function() {
	var container, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Get all the link elements within the menu.
	links = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )();
