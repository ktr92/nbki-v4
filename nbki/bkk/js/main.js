$(document).ready(function () {
	
	try {
		$('.mainslider__slider').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 3000,
			arrows: false,
			dots: true,
			/*	prevArrow: $('.products__left'),
			  nextArrow: $('.products__right'),*/

		});


	} catch (err) {

	}

	$("input[type=tel]").mask("+7 (999) 999-99-99");
	$("input[name=date]").mask("99.99.9999");
	$("input[name=paspcode]").mask("999-999");
	$("input[name=paspnomb]").mask("9999 999999");
	
	
	$('span.dateicon').on('click',  function() {
		var input = $(this).siblings('input[data-select=datepicker]');
		var val = $(this).siblings('input[data-select=datepicker]').val();
				var date = val ? $.datePicker.defaults.dateParse(val) : null;
				var widget = $.datePicker.api.show({
					views: {
						month: {
							show: val ? date : '',
							selected: val ? [ date ] : []
						}
					},
					element: input
				});
				input.data('widget', widget);
	});
	
	
	(function($) {
		$(function() {

		  $('ul.tabs__caption_js').on('click', 'li:not(.active)', function() {
			$(this).addClass('active').siblings().removeClass('active')
			  .closest('div.tabs').find('div.tabs__content_js').removeClass('active').eq($(this).index()).addClass('active');
		  });
		});
		})(jQuery);

});


$(function () {

	$('.mobile__search').click(function (event) {

		$('.b-search-box').animate({
			width: 'toggle'
		}, 320).addClass('b-search-box--is-active');
	});

	$('.search-close').click(function (event) {

		$('.b-search-box').animate({
			width: 'toggle'
		}, 0).removeClass('b-search-box--is-active');
	});

	$('#topmenu').click(function (event) {
		$(this).toggleClass('active');
		$('.allmenu').toggleClass('expand');
	});

	$('.mainmenu__mobile').click(function (event) {
		$(this).toggleClass('active');
		$('.mainmenu > ul').slideToggle();
	});
	
	$('.btn_blue_clients').click(function (event) {
		$(this).toggleClass('active');
		$('.clients__menu').slideToggle();
	});
	
/* 	$('.btn_blue_clients').click(function (event) {
		$(this).toggleClass('active');
		$('.clients__menu').slideToggle();
	}); */
	
	$('#mobilemenu').click(function (event) {
		$(this).toggleClass('active');
		$('.menumobile').slideToggle();
	});
	
	$('#menumobile__btn').click(function (event) {
		$(this).toggleClass('active');
		$('.menumobile').slideToggle();
	});
	
	$('li.menumobile__parent a').click(function (event) {
		event.preventDefault();
		$(this).parent().toggleClass('active');
		$(this).parent().find('ul').slideToggle();
	}); 
	
	
	/*$('.lkproduct__name').click(function (event) {
		$(this).parent().toggleClass('expand');
		$(this).siblings('.lkproduct__show').toggle();
		
	});
	
	
	$('.lkproduct').hover(function (event) {
		$(this).find('.lkproduct__content').toggleClass('expand');
		$(this).find('.lkproduct__show').toggle();
		
	});*/
	
	$('.showhide').click(function (event) {
		event.preventDefault();
		$(this).parent().find('p').slideToggle();		
		$(this).toggleClass('clicked');
		
		var title = 'Читать далее';
		if($(this).hasClass('clicked')){
		   title = 'Скрыть';
		}
		$(this).text(title);
		
		
	});
	

	
		
	$('.accordion__caption li').click(function (event) {
		$('.accordion__content').not($(this).next()).hide().removeClass('active');
		$('.accordion__caption li').not($(this)).removeClass('active');
		$(this).toggleClass('active');
		 $([document.documentElement, document.body]).animate({
			scrollTop: $(this).offset().top
		}, 400);
		$(this).next('.accordion__content').slideToggle();
	});
	
	
	$(".toggle-password").click(function() {
	 
	  var input = $($(this).siblings('input'));
	  if (input.attr("type") == "password") {
		input.attr("type", "text");
	  } else {
		input.attr("type", "password");
	  }
	});
		

});







