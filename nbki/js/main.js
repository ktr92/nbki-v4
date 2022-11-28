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
	
	try {
		$('.landingpartners__slider').slick({
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 3000,
			arrows: true,
			dots: false,
			prevArrow: $('.landingpartners__left'),
			nextArrow: $('.landingpartners__right'),
			responsive: [
				{
				  breakpoint: 991,
				  settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					
				  }
				},
				{
				  breakpoint: 767,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					
				  }
				},
				{
				  breakpoint: 480,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					
				  }
				},
			]
		});


	} catch (err) {

	}
	new WOW().init();
		
	$(".lktitletop_row").on("click", "a", function(e) {
        e.preventDefault();
        var i = $(this).attr("href"),
            t = $(i).offset().top;
        $("body,html").animate({
            scrollTop: t
        }, 400)
    })
	
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
		
	(function($) {
		$(function() {

		  $('ul.tabs__captionforms').on('click', 'li:not(.active)', function() {
			  if (!($(this).hasClass('expt'))) {
				$(this).addClass('active').siblings().removeClass('active')
				  .closest('div.tabs').find('div.tabs__content_js').removeClass('active').eq($(this).index()+1).addClass('active');
			  }
			  });
			
			  
		});
		})(jQuery);
		
	
});


$(function () {
	
	$('.landingmenu').click(function (event) {
		$(this).toggleClass('active');
		$('.headerlanding__menu').slideToggle();
	});
	$('.mobilemenu19').click(function (event) {
		$(this).toggleClass('active');
		$('.menu19').slideToggle();
	});
	

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
	
	$('.metro__metka a').click(function (event) {
		event.preventDefault();
		$(this).parent().parent().find('.metro__tooltip').slideToggle();
		
	}); 
	$('.metro__close').click(function (event) {
		event.preventDefault();
		$(this).parent().slideToggle();
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
		/* $([document.documentElement, document.body]).animate({
			scrollTop: $(this).offset().top
		}, 400);*/
		$(this).next('.accordion__content').slideToggle();
	});
	
	$('.pageaccordion__title').click(function (event) {
		$('.pageaccordion__content').not($(this).next()).hide().removeClass('active');
		$('.pageaccordion__title').not($(this)).removeClass('active');
		$(this).toggleClass('active');		 
		$(this).next('.pageaccordion__content').slideToggle();
	});
	$('.pageaccordion2__title').click(function (event) {
		$('.pageaccordion2__content').not($(this).next()).hide().removeClass('active');
		$('.pageaccordion2__title').not($(this)).removeClass('active');
		$(this).toggleClass('active');	
		$('.pageaccordion2__item').not($(this).parent()).removeClass('active');
		$(this).parent().toggleClass('active');			
		$(this).next('.pageaccordion2__content').slideToggle();
	});
	$('.pageaccordion3__title').click(function (event) {
		
		$(this).toggleClass('active');		 
		$(this).next('.pageaccordion3__content').slideToggle();
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






