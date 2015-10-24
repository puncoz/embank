var top_menu_height = 0;
jQuery(function($) {
$(document).ready(function() {
	
	top_menu_height = $('.navbar').height();
	// scroll spy to auto active the nav item
	$('body').scrollspy({ target: '#navbar-collapse-main', offset: top_menu_height+40 });
	
	// scroll to specific id when click on menu
	$('.navbar .navbar-nav a').click(function(e){
		e.preventDefault(); 
		var linkId = $(this).attr('href');
		scrollTo(linkId);
		if($('.navbar-toggle').is(":visible") == true){
			$('.navbar-collapse').collapse('toggle');
		}
		$(this).blur();
		return false;
	});
	
	// scroll to about
	$('#continue-to-about').click(function(e){
		e.preventDefault();
		scrollTo('#about');
	});
	
	// to stick navbar on top
    $('.main-nav').stickUp({topSpacing:0});
	
	// create a LatLng object containing the coordinate for the center of the map
	var latlng = new google.maps.LatLng(-33.86455, 151.209);
	
	// prepare the map properties
	var options = {
		zoom: 15,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		navigationControl: true,
		mapTypeControl: false,
		scrollwheel: false,
		disableDoubleClickZoom: true
	};
	
	// initialize the map object
	var map = new google.maps.Map(document.getElementById('google_map'), options);
	
	// add Marker
	var marker1 = new google.maps.Marker({
		position: latlng, map: map
	});
	
	// add listener for a click on the pin
	google.maps.event.addListener(marker1, 'click', function() {
		infowindow.open(map, marker1);
	});
	
	// add information window
	var infowindow = new google.maps.InfoWindow({
		content: '<div class="info"><strong>This is my company</strong><br><br>My company address is here<br> 32846 Sydney</div>'
	});
});
});

// scroll animation 
function scrollTo(selectors)
{

    if(!$(selectors).size()) return;
    var selector_top = $(selectors).offset().top - top_menu_height;
    $('html,body').animate({ scrollTop: selector_top }, 'slow');

}