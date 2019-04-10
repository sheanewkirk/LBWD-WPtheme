/**







 * File navigation.js.







 *







 * Handles toggling the navigation menu for small screens and enables TAB key







 * navigation support for dropdown menus.







 */















(function ($, root, undefined) {

	'use strict';





	$(document).on('ready',function () {



		let leftContainer = $('.left-menu-container').find('.menu').parent();

		$('.sub-menu').parent().append( "<div class='sub-menu-arrow'><i class='fas fa-angle-up'></i></div>");

		leftContainer.find('.menu').prepend("<button class='left-menu-close'>X</button>");

		function showMenu() {

			const leftContainer = $('.left-menu-container').find('.menu').parent();

			let leftWidth = $(window).width();

			leftContainer.addClass('left-menu');

			$('.menu-toggle').removeClass('toggled');

			// Adds classes and sets style for children of divs that have the'left-menu-container' class

			leftContainer.css('left',-leftWidth);

					

			

			// leftWidth based on width of .left-menu on css sheet

			leftContainer.parent().find('.menu-toggle').addClass('left-toggle');

			leftContainer.find('.menu').css('display','block');

			$('.menu-toggle').removeClass('toggled');

			

			$('.left-menu-close').css('display','block');

			// Adds classes and sets style for children of divs that have the'left-menu-container' class

	

		

				leftContainer.css('left',-leftWidth);			

				leftContainer.addClass('left-menu');

				// leftWidth based on window width

				leftContainer.parent().find('.menu-toggle').addClass('left-toggle');

		}

		function hideMenu() {

			let leftContainer = $('.left-menu-container').find('.menu').parent();

			let leftWidth = $(window).width();

			$('.left-menu-close').css('display','none');				

			leftContainer.removeClass('left-menu');

			$('.sub-menu').css('display','block');

			$('.menu-menu-1-container').css('display','block');

			leftContainer.find('.menu').css('display','block');					

			leftContainer.removeClass('left-menu');

			$('.sub-menu').css('display','block');

			$('.menu-menu-1-container').css('display','block');

		}	

		if ($('.menu-toggle').css('display') == 'block' ){

			showMenu();
			$('.sub-menu').css('display','none');

		} else if ($('.menu-toggle').css('display') == 'none') {

			hideMenu();
			$('.sub-menu').css('display','')

		}


		$(window).on('resize',function () {

			let leftWidth = $( window ).width();	

			if ($('.menu-toggle').css('display') == 'block' ){

				showMenu();
				$('.sub-menu').css('display','none');

			} else if ($('.menu-toggle').css('display') == 'none') {

				hideMenu();
				$('.sub-menu').css('display','');
			}

		});

		$('.left-menu-close').click(function() {

			let leftWidth = $(window).width();

			const container = $('.left-menu-container').find('.menu').parent();



			$('.menu-toggle').removeClass('toggled');

			container.css('left',-leftWidth);

			

		});

		$('.menu-toggle').click(function() {

			

			let leftWidth = $( window ).width();

			$('.left-menu').css('width','100%');

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



			}

			

							

			

		});


		$('.sub-menu-arrow').click(		function() {
			
						$(this).toggleClass('open-arrow');
						$(this).parent().find('.sub-menu').first().slideToggle(300);
			
			
			
					});

	});



})(jQuery, this);