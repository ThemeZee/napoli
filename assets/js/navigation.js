/* global napoliScreenReaderText */
/**
 * Theme Navigation
 *
 * @package Napoli
 */

 (function() {

	// Create dropdown toggle button.
	function createDropdownToggle() {
		var dropdownToggle = document.createElement( 'button' );

		// Add classes and aria attributes.
		dropdownToggle.classList.add( 'dropdown-toggle' );
		dropdownToggle.setAttribute( 'aria-expanded', 'false' );

		// Add icon to dropdown toggle.
		var icon = new DOMParser().parseFromString( napoliScreenReaderText.icon, 'text/html' ).body.firstElementChild;
		dropdownToggle.appendChild( icon);

		// Add screenreader text.
		var screenReaderText = document.createElement( 'span' );
		screenReaderText.classList.add( 'screen-reader-text' );
		screenReaderText.textContent = napoliScreenReaderText.expand;
		dropdownToggle.appendChild( screenReaderText );

		return dropdownToggle.cloneNode(true);
	}

	function initNavigation( containerClass, naviClass, menuToggleClass ) {
		var container  = document.querySelector( containerClass );
		var navigation = document.querySelector( naviClass );

		// Return early if navigation is missing.
		if ( navigation === null || container === null ) {
			return;
		}

		// Enable menuToggle.
		(function() {
			var menuToggle = document.querySelector( menuToggleClass );

			// Return early if menuToggle is missing.
			if ( menuToggle === null ) {
				return;
			}

			// Add an initial value for the attribute.
			menuToggle.setAttribute( 'aria-expanded', 'false' );

			// Menu Toggle click event.
			menuToggle.addEventListener( 'click', function() {
				container.classList.toggle( 'toggled-on' );
				menuToggle.setAttribute( 'aria-expanded', container.classList.contains( 'toggled-on' ) );
			});
		})();

		// Enable dropdownToggles that displays child menu items.
		(function() {

			// Insert dropdown toggles in navigation menu.
			navigation.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' ).forEach( function( menuItem ) {
				menuItem.after( createDropdownToggle() );
			});

			// Set the active submenu dropdown toggle button initial state.
			navigation.querySelectorAll( '.current-menu-ancestor > button' ).forEach( function( activeToggle ) {
				activeToggle.classList.add( 'toggled-on' );
				activeToggle.setAttribute( 'aria-expanded', 'true' );
				activeToggle.querySelector( '.screen-reader-text' ).textContent = napoliScreenReaderText.collapse;
			});

			// Set the active submenu initial state.
			navigation.querySelectorAll( '.current-menu-ancestor > .sub-menu' ).forEach( function( activeSubmenu ) {
				activeSubmenu.classList.add( 'toggled-on' );
			});
	
			// Dropdown Toggles click events.
			navigation.querySelectorAll( '.dropdown-toggle' ).forEach( function( dropdownItem ) {
				dropdownItem.addEventListener( 'click', function() {
					dropdownItem.classList.toggle( 'toggled-on' );
					dropdownItem.setAttribute( 'aria-expanded', dropdownItem.classList.contains( 'toggled-on' ) );
					dropdownItem.querySelector( '.screen-reader-text' ).textContent = dropdownItem.classList.contains( 'toggled-on' ) ? napoliScreenReaderText.collapse : napoliScreenReaderText.expand;
					dropdownItem.nextElementSibling.classList.toggle( 'toggled-on' );
				});
			});
		})();

		// Toggle focus class to allow keyboard navigation.
		(function() {

			function toggleFocusClass( menuItem ) {

				// Loop through all parent elements up to the menus root.
				var parent = menuItem.parentNode;
				while ( ! parent.classList.contains( 'menu' ) ) {

					// Check if we pass any li elements which have submenus.
					if ( parent.classList.contains( 'menu-item-has-children' ) ) {
						parent.classList.toggle( 'focus' );
					}

					parent = parent.parentNode;
				}
			}			

			navigation.querySelectorAll( '.menu-item-has-children a, .page_item_has_children a' ).forEach( function( menuItem ) {
				menuItem.addEventListener( 'focus', function() {
					toggleFocusClass( menuItem );
				});
				menuItem.addEventListener( 'blur', function() {
					toggleFocusClass( menuItem );
				});
			});

		})();
	}

	document.addEventListener( 'DOMContentLoaded', function() {

		// Init Main Navigation.
		initNavigation( '.primary-navigation', '.main-navigation', '.mobile-menu-toggle' );

		// Init Top Navigation.
		initNavigation( '.secondary-navigation', '.header-navigation', '.mobile-menu-toggle' );

	} );

}() );
