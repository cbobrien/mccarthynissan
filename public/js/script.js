$(function() {

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	var navHeight = 70;

	$(window).scroll(function() {
		if ($(this).scrollTop() > navHeight) {  
	    	$('.navbar').addClass('scrolled');	    	
		}
		else {
		    $('.navbar').removeClass('scrolled');		  
		}
	}); 

	$('.navbar-nav .new-car-link').click(function() {		
		$('.navbar-brand').addClass('active');	
	});

	$(document).on('click', '.yamm .dropdown-menu', function(e) {		
	   	e.stopPropagation()
	})

	//stop rev slider when mega menu visible
	$('.yamm-fw > a').on('click', null, function(e) {		
	   	if(!$('.mm-outer').is(':visible'))
    		$('.banner').revpause();
    	else
    		$('.banner').revresume();
	});

	$('.banner').on('click', null, function(e) {		
		if($('.mm-outer').is(':visible'))
    		$('.banner').revresume();
	});

	$("#date").datepicker({'format':'yyyy-mm-dd'});
	$(".date-picker").datepicker("yyyy-mm-dd");

	function adjustNav(isResizing) {

		isResizing = typeof isResizing !== 'undefined' ? isResizing : false;

		var vWidth = $(window).width();

		var displayValue = vWidth < 1200 ? 'block' : 'none';
		$('#more-links').css('display', displayValue);

		//number of items in top nav		
		var numTopItems = getNumTopItems();
		
		//if the windows is being resized
		if (isResizing) {

			//get num items in dropdown
			var numDropItems = $('.more-links-dropdown > li').length;

			if (vWidth >= 1200) {
				//if there > 0 items in dropdown, move all of them to top nav
				if (numDropItems > 0) {
					var dropDownItems = $('.more-links-dropdown > li');
					var indexNum = numTopItems - 1;
					$('.navbar-nav > li:eq(' + indexNum + ')').after(dropDownItems);
				}
			}

			if (vWidth > 972 && vWidth < 1200) {
				//if there is nothing in the dropdown, add last 3 top items to dropdown
				if (numDropItems == 0) {
					moveMenuItems('navbar-nav', 'more-links-dropdown', 3);
				}
				//if there are 6 items in the dropdown, move first 3 to top nav
				if (numDropItems == 6) {
					moveItemsToTopNav('more-links-dropdown', 'navbar-nav', 3);
				}
				//if there are 3 items in the dropdown, this is correct
			}

			if (vWidth >= 750 && vWidth <= 972) {
				//if there are 0 items in the dropdown, move last 6 top items to dropdown
				if (numDropItems == 0) {
					moveMenuItems('navbar-nav', 'more-links-dropdown', 6);
				}
				//if there are 3 items in the dropdown, move last 3 top items to dropdown
				if (numDropItems == 3) {
					moveMenuItems('navbar-nav', 'more-links-dropdown', 3);
				}
				//if there are 6 items in the dropdown, this is correct
			}
		}

		if(!isResizing) {

			//items to remove from top nav
			var itemCount = 0; 

			if (vWidth > 992 && vWidth < 1200) {
				itemCount = 3;
			}

			if (vWidth >= 750 && vWidth <= 992) {			
				itemCount = 6;
			}

			moveMenuItems('navbar-nav', 'more-links-dropdown', itemCount);

		}


		function moveMenuItems(srcMenu, destMenu, itemCount) {
			for (var i = 1; i <= itemCount; i++) {
				var menuItem = $('.' + srcMenu + ' > li').filter(srcMenu == 'navbar-nav' ? ':not(".more-links")' : '').eq(numTopItems - i);				
				menuItem.remove();
				$('.' + destMenu).prepend(menuItem);
			}
		}

		function moveItemsToTopNav(srcMenu, destMenu, itemCount) {

			console.log('top items: ' + numTopItems);

			var menuItems = $('.more-links-dropdown > li:lt(3)');

			eqNum = getNumTopItems() - 1;
			console.log($('.navbar-nav > li:eq(' + eqNum + ')'));
			$('.navbar-nav > li:eq(' + eqNum + ')').after(menuItems);
		}


		function getNumTopItems() {
			return $('.navbar-nav > li').filter(':not(".more-links")').length;
		}

	}

	adjustNav();

	$(window).resize(function() {
		adjustNav(true);
	});


	if($('.new-car-nav').length) {

		var carMenuOffset = $('.new-car-nav').offset().top;
		var menuMustMoveBack = false;

		$(window).scroll(function() {

			var scrollTop = $(window).scrollTop();//
		    var elementOffset = $('.new-car-nav').offset().top;
		    var	distance = (elementOffset - scrollTop);

		    if(distance <= 70) {
		    	$('.new-car-nav').addClass('fixed');
		    	$('.navbar').removeClass('scrolled');
		    	if($(window).width() > 500) $('.car-name').show();
		    	$('.new-car-container').addClass('extra-padding');
		    	menuMustMoveBack = true;
		    }

		    if(menuMustMoveBack) {
		    	var distance2 = (carMenuOffset - scrollTop);
		    	if(distance2 > 70) {
		    		$('.new-car-nav').removeClass('fixed');
		    		$('.car-name').hide();
		    		$('.new-car-container').removeClass('extra-padding');
		    		menuMustMoveBack = false;
		    	}
		    }

   		})
	}

	$('.navbar-toggle').click(function() {
	    if ($(this).css('transform') == 'none') {
	        $(this).css('transform','rotate(90deg)');
	    }
	    else {
	        $(this).css('transform','');
	    }
	});

	$('.more-links-dropdown .dropdown .dropdown-toggle').click(function(e) {
		var dealers = $(this).next('.dealerships').toggleClass('dealerships-menu-dropped').next('span').toggle();
		return false;		
	});


	//accordion
	$('.copy-accordion').find('h4').first().addClass('active');

	$('.copy-accordion').find('h4').click(function() {
	    $(this).toggleClass('active');
	    $(this).next().slideToggle('fast');
	    $('.copy-accordion h4').not($(this)).removeClass('active');
	    $('.copy-accordion > div').not($(this).next()).slideUp('fast');
    });

	//colour picker 
	$('.colour-picker a').click(function(){
		var item = $(this).attr('data-item');
		$('.picker-pic-item').hide();
		$('.colour-picker a').removeClass('active');
		$(this).addClass('active');
		$('#picker-item-' + item).show();
	});

	$('.intro').on('click', function() {
		$('.intro').not($(this)).slideDown();
		$(this).slideUp();
		$('.content').not($(this).next()).slideUp();
		$(this).next('.content').slideDown();
	});

	$('.view-hover').hover(function() {
		// console.log('ddddd');
	});


	$('#modalEnquire').on('show.bs.modal', function(e) {
	    var vid = $(e.relatedTarget).data('vid');
	    var car_name = $(e.relatedTarget).data('car-name');
	    var enquiry_type = $(e.relatedTarget).data('enquiry-type');
	    var dealer_id = $(e.relatedTarget).data('dealer-id');

	    $(e.currentTarget).find('input[name="vid"]').val(vid);
	    $(e.currentTarget).find('input[name="enquiryType"]').val(enquiry_type);
	    $(e.currentTarget).find('.enquiry-car-name').text(car_name);
	    $(e.currentTarget).find('#dealership_id').val(dealer_id);
	});

	$('#modalEnquire').on('hide.bs.modal', function(e) {	    
    	$('#enquireForm .form-group, #enquireSend').css('opacity', 1);
    	$('#enquireForm .form-group input').val('');
        $('#enquireForm .ajax-message').text('').removeClass('alert-success alert-danger alert');
	});


	$('#modalSpecial').on('show.bs.modal', function(e) {
	    var special_id = $(e.relatedTarget).data('special-id');
	    var special_name = $(e.relatedTarget).data('special-name');
	    $(e.currentTarget).find('input[name="specialId"]').val(special_id);	  
	    $(e.currentTarget).find('.special-name').text(special_name);
	});

	$('#modalSpecial').on('hide.bs.modal', function(e) {	    
    	$('#specialForm .form-group, #specialSend').css('opacity', 1);
    	$('#specialForm .form-group input').val('');
        $('#specialForm .ajax-message').text('').removeClass('alert-success alert-danger alert');
	});

	$('#modalPromotion').on('show.bs.modal', function(e) {
	    var promotion_id = $(e.relatedTarget).data('promotion-id');
	    var promotion_name = $(e.relatedTarget).data('promotion-name');
	    $(e.currentTarget).find('input[name="promotionId"]').val(promotion_id);	  
	    $(e.currentTarget).find('.promotion-name').text(promotion_name);
	});

	$('#modalPromotion').on('hide.bs.modal', function(e) {	    
    	$('#promotionForm .form-group, #promotionSend').css('opacity', 1);
    	$('#promotionForm .form-group input').val('');
        $('#promotionForm .ajax-message').text('').removeClass('alert-success alert-danger alert');
	});

	

	// $('.selectpicker').selectpicker();

	// $('.modal button').not('.close, .change-range').on('click', function() {
	// 	$('.modal button.btn-grey-modal').removeClass('selected');
	// 	$(this).addClass('selected');			
	// });

	

	// $('#searchForm').on('submit', function(e) {
	// 	var type = $('#modalSearch #type').val();
	// 	var min = $('#modalSearch #min').val();
	// 	var max = $('#modalSearch #max').val();
	// 	console.log(type);
	// 	var url = '/search/' + type + '/' + min + '/' + max;
	// 	// window.location.href = usrl;
	// 	$(this).attr('action', url);
	// });

	


	$('body').scrollspy({ offset: 140, target: '#navbar-example' });

	var offset = 130;

	$('#navbar-example li a').click(function(event) {
	    event.preventDefault();
	    $($(this).attr('href'))[0].scrollIntoView();
	    scrollBy(0, -offset);
	});

	
});

function numberWithCommas(str) {
    return str.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

