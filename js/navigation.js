/**

 * File navigation.js.

 *

 * Handles toggling the navigation menu for small screens and enables TAB key

 * navigation support for dropdown menus.

 */



(function ($, root, undefined) {

	
	$('.sub-menu').parent().append( "<div class='sub-menu-arrow'><i class='fas fa-angle-up'></i></div>");
	$(window).on('load resize',function () {

		

		'use strict';

		//Code will only execute if toggle is set to 'display:block'



		if ($('.menu-toggle').css('display') == 'block' ){

			$('.menu-toggle').removeClass('toggled');

		

			/*------------- Sub Menu Arrows -----------*/


			$('.sub-menu').css('display','none');


			

			/*------------- Left Side Menu -----------*/



			// Adds classes and sets style for children of divs that have the'left-menu-container' class



			const leftContainer = $('.left-menu-container').find('.menu').parent();

			leftContainer.find('.menu').css('display','block');

			leftContainer.find('.menu').parent().prepend("<button class='left-menu-close'>X</button>");					

			leftContainer.addClass('left-menu');



			// leftWidth based on width of .left-menu on css sheet



			const leftWidth = $('.left-menu').width();			

			leftContainer.css('left',-leftWidth);

			leftContainer.parent().find('.menu-toggle').addClass('left-toggle');



			// Close Button



			$('.left-menu-close').click(function() {

				const container = $(this).parent();

				$('.menu-toggle').removeClass('toggled');
				container.css('left',-leftWidth);

			});

		} else if ($('.menu-toggle').css('display') == 'none') {

			const leftContainer = $('.left-menu-container').find('.menu').parent();
			leftContainer.find('.menu').css('display','block');					
			leftContainer.removeClass('left-menu');
			
			$('.sub-menu').css('display','block');

			$('.menu-menu-1-container').css('display','block');
		}
			/*------------ Main Click Logic -------------*/



			$('.menu-toggle').click(function() {
				
								$(this).addClass('toggled');
				
								//Check for Classes added above
				
								if($(this).hasClass('left-toggle')){				
				
									const container = $(this).parent().find('.menu').parent();
				
									
				
									if($(this).hasClass('toggled')) {
				
										container.css('left',0);
				
									} else {
				
										container.css('left',-leftWidth);
				
									}
				
				
				
								} else {
				
									// Normal Slide Action
				
									$(this).parent().find('.menu').slideToggle(300);
									$('.sub-menu').css('display','none');
				
								}
				
							});

	});

	$('.sub-menu-arrow').click(function() {
		
						$(this).toggleClass('open-arrow');
		
						$(this).toggleClass('toggled');
		
						$(this).parent().find('.sub-menu').first().slideToggle(300);
		
		
		
					});

})(jQuery, this);