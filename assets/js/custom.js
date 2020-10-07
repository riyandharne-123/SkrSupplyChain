/* Global jQuery */

/* Contents
// ------------------------------------------------>
     1. wow animation
     2. Menu Mobile
     3. Cart
     4. Search
     5. Owl Slider
     6. Light Box
     7. Fixed Header
*/

(function ($) {
	"use strict";





	/* ------------------  2. Menu Mobile ------------------ */
	var $menu_show = $('.mobile-toggle'),
		$menu = $('header #menu-main'),
		$list = $("ul.nav-menu li a")

	$menu_show.on("click", function () {
		$menu.slideToggle();
	});
	$list.on("click", function () {
		var submenu = this.parentNode.getElementsByTagName("ul").item(0);
		if (submenu != null) {
			event.preventDefault();
			$(submenu).slideToggle();
		}
	});

}(jQuery));
