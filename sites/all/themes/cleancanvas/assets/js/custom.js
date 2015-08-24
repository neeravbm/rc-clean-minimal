/******** Portfolio page ***********/
(function ($) {
  Drupal.behaviors.cleancanvas = {
    attach: function (context, settings) {
	    var $container = $('#gallery_container'),
						$filters = $("#filters a");
	
			$container.imagesLoaded( function(){
					$container.isotope({
							itemSelector : '.photo',
							masonry: {
									columnWidth: 100
							}
					});
			});
			// filter items when filter link is clicked
			$filters.click(function() {
					$filters.removeClass("active");
					$(this).addClass("active");
					var selector = $(this).data('filter');
					$container.isotope({ filter: selector });
					return false;
			});
			
			// Coming Soon
			var currentDate = new Date(),
				finished = false,
				availiableExamples = {
						set35daysFromNow: 35 * 24 * 60 * 60 * 1000,
						set5minFromNow  : 5 * 60 * 1000,
						set1minFromNow  : 1 * 60 * 1000
				};
			$('div#clock').countdown(availiableExamples.set35daysFromNow + currentDate.valueOf(), callback);
			
			// Flex
				if ($(".flexslider").length) {
						$('.flexslider').flexslider();
				}
				
			// Add class form-control in text-field
			$("input[type='text']").addClass('form-control');
			$("input[type='password']").addClass('form-control');

	  }
	}
})(jQuery);


function callback(event) {
	$this = $(this);
	$this.find('div#'+event.type).html(event.value);
	switch(event.type) {
			case "seconds":
			case "minutes":
			case "hours":
			case "days":
			case "weeks":
			case "daysLeft":
			case "finished":
	}
}     
