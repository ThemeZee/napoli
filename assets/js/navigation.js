/**
 * Navigation Menu Plugin
 *
 * Copyright 2016 ThemeZee
 * Free to use under the GPLv2 and later license.
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Author: Thomas Weichselbaumer (themezee.com)
 *
 * @package Napoli
 */

(function($) {

	/**--------------------------------------------------------------
	# Add Desktop Dropdown Animation
	--------------------------------------------------------------*/
	$.fn.addDropdownAnimation = function() {

		/* Add dropdown animation for desktop navigation menu */
		$( this ).find( 'ul.sub-menu' ).css( { display: 'none' } );
		$( this ).find( 'li.menu-item-has-children' ).hover( function() {
			$( this ).find( 'ul:first' ).css( { visibility: 'visible', display: 'none' } ).slideDown( 300 );
		}, function() {
			$( this ).find( 'ul:first' ).css( { visibility: 'hidden' } );
		} );

		/* Make sure menu does not fly off the right of the screen */
		$( this ).find( 'li ul.sub-menu li.menu-item-has-children' ).mouseenter( function() {
			if ( $( this ).children( 'ul.sub-menu' ).offset().left + 250 > $( window ).width() ) {
				$( this ).children( 'ul.sub-menu' ).css( { right: '100%', left: 'auto' } );
			}
		});

		// Add menu items with submenus to aria-haspopup="true".
		$( this ).find( 'li.menu-item-has-children' ).attr( 'aria-haspopup', 'true' ).attr( 'aria-expanded', 'false' );

		/* Properly update the ARIA states on focus (keyboard) and mouse over events */
		$( this ).find( 'li.menu-item-has-children > a' ).on( 'focus.aria mouseenter.aria', function() {
			$( this ).parents( '.menu-item' ).attr( 'aria-expanded', true ).find( 'ul:first' ).css( { visibility: 'visible', display: 'block' } );
		} );

		/* Properly update the ARIA states on blur (keyboard) and mouse out events */
		$( this ).find( 'li.menu-item-has-children > a' ).on( 'blur.aria  mouseleave.aria', function() {

			if( ! $( this ).parent().next( 'li' ).length > 0 && ! $( this ).next('ul').length > 0 ) {

				$( this ).closest( 'li.menu-item-has-children' ).attr( 'aria-expanded', false ).find( '.sub-menu' ).css( { display: 'none' } );

			}

		} );

	};

	/**--------------------------------------------------------------
	# Reset Desktop Dropdown Animation
	--------------------------------------------------------------*/
	$.fn.resetDropdownAnimation = function() {

		/* Reset desktop navigation menu dropdown animation on smaller screens */
		$( this ).find( 'ul.sub-menu' ).css( { display: 'block' } );
		$( this ).find( 'li ul.sub-menu' ).css( { visibility: 'visible', display: 'block' } );
		$( this ).find( 'li.menu-item-has-children' ).unbind( 'mouseenter mouseleave' );

		$( this ).find( 'li.menu-item-has-children ul.sub-menu' ).each( function() {
			$( this ).hide();
			$( this ).parent().find( '.submenu-dropdown-toggle' ).removeClass( 'active' );
		} );

		/* Remove ARIA states on mobile devices */
		$( this ).find( 'li.menu-item-has-children > a' ).unbind( 'focus.aria mouseenter.aria blur.aria  mouseleave.aria' );

	};

	/**--------------------------------------------------------------
	# Add submenus dropdowns for mobile menu
	--------------------------------------------------------------*/
	$.fn.addMobileSubmenu = function() {

		/* Add dropdown toggle for submenus on mobile navigation */
		$( this ).find('li.menu-item-has-children').prepend('<span class=\"submenu-dropdown-toggle\"></span>');
		$( this ).find('li.page_item_has_children').prepend('<span class=\"submenu-dropdown-toggle\"></span>');

		/* Add dropdown animation for submenus on mobile navigation */
		$( this ).find('.submenu-dropdown-toggle').on('click', function(){
			$( this ).parent().find('ul:first').slideToggle();
			$( this ).toggleClass('active');
		});

	};

	/**--------------------------------------------------------------
	# Setup Navigation Menus
	--------------------------------------------------------------*/
	$( document ).ready( function() {

		/* Variables */
		var main_menu = $('.main-navigation-menu'),
			header_menu = $('.header-navigation-menu'),
			menu_wrap = $('.main-navigation-menu-wrap');

		/* Add Listener for screen size */
		if(typeof matchMedia == 'function') {
			var mq = window.matchMedia('(max-width: 60em)');
			mq.addListener(widthChange);
			widthChange(mq);
		}
		function widthChange(mq) {

			if (mq.matches) {

				/* Reset desktop navigation menu dropdown animation on smaller screens */
				main_menu.resetDropdownAnimation();
				header_menu.resetDropdownAnimation();

				/* Copy header navigation items to main navigation on mobile screens */
				header_menu.appendTo( menu_wrap ).addClass('mobile-header-menu');

			} else {

				/* Add dropdown animation for desktop navigation menu */
				main_menu.addDropdownAnimation();
				header_menu.addDropdownAnimation();

				/* Copy Header Navigation back to original spot */
				$('.mobile-header-menu').removeClass('mobile-header-menu').appendTo( $('#header-navigation') );

			}

		}

		/* Add Menu Toggle Button for mobile navigation */
		$("#main-navigation").before('<button id=\"main-navigation-toggle\" class=\"main-navigation-toggle\"></button>');

		/* Add dropdown slide animation for mobile devices */
		$('#main-navigation-toggle').on('click', function(){
			menu_wrap.slideToggle();
			$( this ).toggleClass('active');
		});

		/* Add submenus for mobile navigation menu */
		main_menu.addMobileSubmenu();
		header_menu.addMobileSubmenu();

	} );

}(jQuery));
