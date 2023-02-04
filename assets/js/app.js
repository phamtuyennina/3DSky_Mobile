var $window = $(window),
    $document = $(document);
$.fn.exists = function() {
    return this.length > 0;
};
NN_FRAMEWORK.tocDetail = function(){
	if ($('.toc-list').exists) {
		$(".toc-list").toc({
            content: "div#toc-content",
            headings: "h2,h3,h4"
        });
        if(!$(".toc-list li").length) $(".meta-toc").hide();
        $('.toc-list').find('a').click(function(){
            var x = $(this).attr('data-rel');
            goToByScroll(x);
        });
	}
};
NN_FRAMEWORK.tabDetail = function(){
	if($('.ul-tabs-pro-detail').exists){
		$('body').on('click', '.ul-tabs-pro-detail li', function(event) {
			 var tabs = $(this).data("tabs");
	        $(".content-tabs-pro-detail, .ul-tabs-pro-detail li").removeClass("active");
	        $(this).addClass("active");
	        $("."+tabs).addClass("active");
		});
	}
};
NN_FRAMEWORK.iconSearch = function(){
	if($('.icon-search').exists){
		$('body').on('click', '.icon-search', function(event) {
			var obj = $(this);
			if(obj.hasClass('active')){
	            obj.removeClass('active');
	            $(".search-grid").stop(true,true).animate({opacity: "0",width: "0px"}, 200);   
	        } else {
	            obj.addClass('active');                            
	            $(".search-grid").stop(true,true).animate({opacity: "1",width: "230px"}, 200);
	        }
	        var el = obj.next().find("input").attr('id');
	        $('#'+el).focus();
	        $('.icon-search i').toggleClass('fa fa-search fa fa-times');
	    });
	}
};
NN_FRAMEWORK.backToTop = function(){
	$('body').on("click",".scrollToTop",function() {
        $('html, body').animate({scrollTop : 0},800);
        return false; 
    });
};
NN_FRAMEWORK.setAlt = function(){
	$('img').each(function(index, element) {
		var obj = $(this);
        if(!obj.attr('alt') || obj.attr('alt')==''){
            obj.attr('alt',WEBSITE_NAME);
        }
    });
};
NN_FRAMEWORK.pageCart = function(){
	if($('.addcart').exists){
		$("body").on("click", ".addcart",function(){
			var obj = $(this);
			var el_input = $(".qty-pro");
	        var mau = ($(".color-pro-detail input:checked").val()) ? $(".color-pro-detail input:checked").val() : 0;
	        var size = ($(".size-pro-detail input:checked").val()) ? $(".size-pro-detail input:checked").val() : 0;
	        var id = obj.data("id");
	        var action = obj.data("action");
	        var qty = (el_input.val()) ? el_input.val() : 1;
	        if(id){
	            $.ajax({
	                url: CONFIG_BASE + 'ajax/ajax_add_cart.php',
	                type: "POST",
	                dataType: 'json',
	                async: false,
	                data: {cmd:'addcart',id:id,mau:mau,size:size,qty:qty},
	                success: function(result){
	                    if(action=='addnow'){
	                        $('.count-cart').html(result.max);
	                        $.ajax({
	                            url: CONFIG_BASE + 'ajax/ajax_popup_cart.php',
	                            type: "POST",
	                            dataType: 'html',
	                            async: false,
	                            success: function(result){
	                                $("#popup-cart .modal-body").html(result);
	                                $('#popup-cart').modal('show');
	                            }
	                        });
	                    }else if(action=='buynow'){
	                        window.location = CONFIG_BASE + "gio-hang";
	                    }
	                }
	            });
	        }
	    });
    }
    if($('.del-procart').exists){
	    $("body").on("click", ".del-procart",function(){
	        if(confirm(LANG['delete_product_from_cart'])){
	            var code = $(this).data("code");
	            var ship = $(".price-ship").val();
	            var endow = $(".price-endow").val();
	            $.ajax({
	                type: "POST",
	                url: CONFIG_BASE + 'ajax/ajax_delete_cart.php',
	                dataType: 'json',
	                data: {code:code,ship:ship,endow:endow},
	                success: function(result){
	                    $('.count-cart').html(result.max);
	                    if(result.max){
	                        $('.price-temp').val(result.temp);
	                        $('.load-price-temp').html(result.tempText);
	                        $('.price-total').val(result.total);
	                        $('.load-price-total').html(result.totalText);
	                        $(".procart-"+code).remove();
	                    }else{
	                        $(".wrap-cart").html('<a href="" class="empty-cart text-decoration-none"><i class="fa fa-cart-arrow-down"></i><p>'+LANG['no_products_in_cart']+'</p><span>'+LANG['back_to_home']+'</span></a>');
	                    }
	                }
	            });
	        }
	    });
    }
    if($('.counter-procart').exists){
	    $("body").on("click", ".counter-procart",function(){
	        var btn = $(this);
	        var input = btn.parent().find("input");
	        var pid = input.data('pid');
	        var code = input.data('code');
	        var old_val = btn.parent().find("input").val();
	        if(btn.text() == "+") quantity = parseFloat(old_val) + 1;
	        else if(old_val > 1) quantity = parseFloat(old_val) - 1;
	        btn.parent().find("input").val(quantity);
	        update_cart(pid,code,quantity);
	    });
	}
	if($('.quantity-procat').exists){
		$("body").on("change", ".quantity-procat",function(){
			var obj = $(this);
        	var quantity = obj.val();
	        var pid = obj.data("pid");
	        var code = obj.data("code");
	        update_cart(pid,code,quantity);
	    });
	}
    if($('.apply-coupon').exists){
	    $("body").on("click", ".apply-coupon", function(){
	        var coupon = $(".code-coupon").val();
	        var ship = $(".price-ship").val();
	        if(coupon=='') {
	            modalNotify(LANG['no_coupon']);
	            return false;
	        }
	        $.ajax({
	            type: "POST",
	            url: CONFIG_BASE + 'ajax/ajax_coupon_cart.php',
	            dataType: 'json',
	            data: {coupon:coupon,ship:ship},
	            success: function(result){
	                $('.price-total').val(result.total);
	                $('.load-price-total').html(result.totalText);
	                $('.price-endowType').val(result.endowType);
	                $('.price-endowID').val(result.endowID);
	                $('.price-endow').val(result.endow);
	                $('.load-price-endow').html(result.endowText);
	                if(result.error!=''){
	                    $(".code-coupon").val("");
	                    modalNotify(result.error);
	                }
	            }
	        });
	    });
    }
    if($('.payments-label').exists){
	    $("body").on("click", ".payments-label", function(){
	    	var obj = $(this);
	        var payments = obj.data("payments");
	        $(".payments-cart .payments-label, .payments-info").removeClass("active");
	        obj.addClass("active");
	        $(".payments-info-"+payments).addClass("active");
	    });
	}
	if($('.color-pro-detail').exists){
		$('body').on('click', '.color-pro-detail', function(event) {
			var obj = $(this);
	        $("a.color-pro-detail").removeClass("active");
	        obj.addClass("active");
	        var id_mau = $("input[name=color-pro-detail]:checked").val();
	        var idpro = obj.data('idpro');
	        $.ajax({
	            url: CONFIG_BASE + 'ajax/ajax_colorthumb.php',
	            type: "POST",
	            dataType: 'html',
	            data: {id_mau:id_mau,idpro:idpro},
	            success: function(result){
	                if(result!=''){
	                    $('.left-pro-detail').html(result);
	                    MagicZoom.start('Zoom-1');
	                    $('.in-arrow-detail').owlCarousel({
							loop: false,
							margin: 5,
							responsiveClass:true,
							dots: false,
							nav: true,
							navText: ['<div class="owlleft"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline></svg></div>','<div class="owlright"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline></svg></div>'],
							autoplay: true,
							autoplayTimeout: 4000,
							smartSpeed: 3000,
							autoplayHoverPause:true,
							autoHeight:false,
							responsive:{
								0:{
									items: 2
								},
								600:{
									items: 3
								},
								1000:{
									items: 4			
								},
								1200:{
									items: 5
								}
							}
						})
	                }
	            }
	        });
	    });
    }
    if($('.color-pro-detail').exists){
		$('body').on('click', '.size-pro-detail', function(event) {
	        $("a.size-pro-detail").removeClass("active");
	        $(this).addClass("active");
	    });
	}
	if($('.quantity-pro-detail').exists){
		$(".quantity-pro-detail span").click(function(){
	        var btn = $(this);
	        var old_val = btn.parent().find("input").val();
	        if(btn.text() == "+"){
	            var newVal = parseFloat(old_val) + 1;
	        }else{
	            if(old_val > 1) var newVal = parseFloat(old_val) - 1;
	            else var newVal = 1;
	        }
	        btn.parent().find("input").val(newVal);
	    });
	}
};

NN_FRAMEWORK.aweOwlPage = function() {
	var owl = $('.owl-carousel.in-page');
  	owl.each( function(){
		var xs_item = $(this).attr('data-xs-items');
		var md_item = $(this).attr('data-md-items');
		var lg_item = $(this).attr('data-lg-items');
		var sm_item = $(this).attr('data-sm-items');	
		var margin=$(this).attr('data-margin');
		var dot=$(this).attr('data-dot');
		var nav=$(this).attr('data-nav');
		var height=$(this).attr('data-height');
		var play=$(this).attr('data-play');
		var loop=$(this).attr('data-loop');
		
		if (typeof margin !== typeof undefined && margin !== false) {    
		} else{
			margin = 30;
		}
		if (typeof xs_item !== typeof undefined && xs_item !== false) {    
		} else{
			xs_item = 1;
		}
		if (typeof sm_item !== typeof undefined && sm_item !== false) {    

		} else{
			sm_item = 3;
		}	
		if (typeof md_item !== typeof undefined && md_item !== false) {    
		} else{
			md_item = 3;
		}
		if (typeof lg_item !== typeof undefined && lg_item !== false) {    
		} else{
			lg_item = 3;
		}

		if (loop == 1) { loop = true; } else{ loop = false; }
		if (dot == 1) { dot = true; } else{ dot = false; }
		if (nav == 1) { nav = true; } else{ nav = false; }
		if (play == 1) { play = true; } else{ play = false; }
		
		$(this).owlCarousel({
			loop: loop,
			margin:Number(margin),
			responsiveClass:true,
			dots:dot,
			nav:nav,
			navText: ['<div class="owlleft"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline></svg></div>','<div class="owlright"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline></svg></div>'],
			autoplay:play,
			autoplayTimeout: 4000,
			smartSpeed: 3000,
			autoplayHoverPause:true,
			autoHeight:false,
			responsive:{
				0:{
					items:Number(xs_item)				
				},
				600:{
					items:Number(sm_item)				
				},
				1000:{
					items:Number(md_item)				
				},
				1200:{
					items:Number(lg_item)				
				}
			}
		})
	});
};

NN_FRAMEWORK.slickPage = function(){
	if($('.slick.in-page').length > 0){
		$('.slick.in-page').each(function() {
			var dots = $(this).attr('data-dots');
			var infinite = $(this).attr('data-infinite');
			var speed = $(this).attr('data-speed');
			var vertical = $(this).attr('data-vertical');
			var arrows = $(this).attr('data-arrows');
			var autoplay = $(this).attr('data-autoplay');
			var autoplaySpeed = $(this).attr('data-autoplaySpeed');
			var centerMode =  $(this).attr('data-centerMode');
			var centerPadding =  $(this).attr('data-centerPadding');
			var slidesDefault =  $(this).attr('data-slidesDefault');
			var responsive =  $(this).attr('data-responsive');
			var xs_item = $(this).attr('data-xs-items');
			var md_item = $(this).attr('data-md-items');
			var lg_item = $(this).attr('data-lg-items');
			var sm_item = $(this).attr('data-sm-items');
			var slidesDefault_ar = slidesDefault.split(":");
			var xs_item_ar = xs_item.split(":");
			var sm_item_ar = sm_item.split(":");
			var md_item_ar = md_item.split(":");
			var lg_item_ar = lg_item.split(":");
			var to_show = slidesDefault_ar[0];
			var to_scroll = slidesDefault_ar[1];
			if (responsive == 1) { responsive = true; } else{ responsive = false; }
			if (dots == 1) { dots = true; } else{ dots = false; }
			if (arrows == 1) { arrows = true; } else{ arrows = false; }
			if (infinite == 1) { infinite = true; } else{ infinite = false; }
			if (autoplay == 1) { autoplay = true; } else{ autoplay = false; }
			if (centerMode == 1) { centerMode = true; } else{ centerMode = false; }
			if (vertical == 1) { vertical = true; } else{ vertical = false; }
			if (typeof speed !== typeof undefined && speed !== false) {    
			} else{ speed = 300; }
			if (typeof autoplaySpeed !== typeof undefined && autoplaySpeed !== false) {    
			} else{ autoplaySpeed = 2000; }
			if (typeof centerPadding !== typeof undefined && centerPadding !== false) {    
			} else{ centerPadding = "0px"; }
			var reponsive_json = [{
			      	breakpoint: 1024,
			      	settings: {
			        	slidesToShow: Number(lg_item_ar[0]),
			        	slidesToScroll: Number(lg_item_ar[1])
			      	}
			    },{
			      	breakpoint: 992,
			      	settings: {
			        	slidesToShow: Number(md_item_ar[0]),
			        	slidesToScroll: Number(md_item_ar[1])
			      	}
			    },{
			      	breakpoint: 768,
			      	settings: {
				        slidesToShow: Number(sm_item_ar[0]),
				        slidesToScroll: Number(sm_item_ar[1]),
				        vertical: false
			      	}
			    },{
			      	breakpoint: 480,
			      	settings: {
			        	slidesToShow: Number(xs_item_ar[0]),
			        	slidesToScroll: Number(xs_item_ar[1]),
			        	vertical: false
			      	}
				}];
			if(responsive==1){
				$(this).slick({
					dots: dots,
					infinite: infinite,
					arrows: arrows,
					speed: Number(speed),
					vertical: vertical,
					slidesToShow: Number(to_show),
					slidesToScroll: Number(to_scroll),
					autoplay: autoplay,
					autoplaySpeed: Number(autoplaySpeed),
					responsive: reponsive_json
				});
			}else{
				$(this).slick({
					dots: dots,
					infinite: infinite,
					arrows: arrows,
					speed: Number(speed),
					vertical: vertical,
					slidesToShow: Number(to_show),
					slidesToScroll: Number(to_scroll),
					autoplay: autoplay,
					autoplaySpeed: Number(autoplaySpeed)
				});
			}
		});
	}
};
NN_FRAMEWORK.loadPage = function(){
	ValidationFormSelf("validation-newsletter");
	ValidationFormSelf("validation-cart");
	ValidationFormSelf("validation-user");
	ValidationFormSelf("validation-contact");
	loadPagingAjax("ajax/ajax_product.php",'.paging-product',0,12);
	ResizeWebsite();
};

NN_FRAMEWORK.galleryPage = function(){
	$('.pic-album [data-fancybox]').fancybox({
		thumbs : {
			autoStart : true
		},
		transitionEffect: "circular",
		slideShow: {
		    autoStart: true,
		    speed: 3000
		}
	});
};

$window.resize(function(){
    ResizeWebsite();
});
$window.scroll(function() {
    if($window.scrollTop() >= $(".header").height()){
        $(".menu").css({position:"fixed",left:'0px',right:'0px',top:'0px',zIndex:'999'});
    }else{
        $(".menu").css({position:"relative"});
    }
    if(!$('.scrollToTop').length){
        $("body").append('<div class="scrollToTop"><img src="'+GOTOP+'" alt="Go Top"/></div>');
    }
    if($(this).scrollTop() > 100){
        $('.scrollToTop').fadeIn();
    }else{
        $('.scrollToTop').fadeOut();
    }
});
NN_FRAMEWORK.menuMobile = function(){
	$('body').on('click', 'span.btn-dropdown-menu', function() {
		var o = $(this);
		if(!o.hasClass('active')){
			o.addClass('active');
			o.next('.sub-menu').stop().slideDown(300);
		}else{
			o.removeClass('active');
			o.next('.sub-menu').stop().slideUp(300);
		}
	});	
	$('.menu-mobile-btn').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		$('.header-left-fixwidth').toggleClass('open-sidebar-menu');
		$('.opacity-menu').toggleClass('open-opacity');
	});
	$('.opacity-menu').click(function(e){
		$('.open-menu-header').removeClass('open-button');
		$('.header-left-fixwidth').removeClass('open-sidebar-menu');
		$('.opacity-menu').removeClass('open-opacity');
	});
};
NN_FRAMEWORK.SearchProduct=function(){
	let url="3d-models?";
	let flag = false;
	$('.list-danhmuc-search  a.active').each(function (index, element) {
		if(index==0) url+=$(this).data('key')+'='+$(this).data('value');
		else url+='&'+$(this).data('key')+'='+$(this).data('value');
		flag = true;
	});
	$('.tinhtrang a.active').each(function (index, element) {
		if(flag== false) url+='status='+$(this).data('value');
		else url+='&status='+$(this).data('value');
		flag = true;
	});
	$('.bookmarks a.active').each(function (index, element) {
		if(flag== false) url+=$(this).data('key')+'='+$(this).data('value');
		else url+='&'+$(this).data('key')+'='+$(this).data('value');
		flag = true;
	});
	if($('#manufacturers').is(':checked')){
		if(flag== false) url+='manufacturers=1';
		else url+='&manufacturers=1';
	}
	url+='&order-by='+$('.order-by').attr('data-order');
	$.post(CONFIG_BASE+url,function (data) {
		let html = $('<div>'+data+'</div>');
		let html_parse=html.find('#ajax_product').html();
		$('#ajax_product').html(html_parse);
		if($('.center-right-product ul li').length==1){
			$('.center-right-product ul li').remove();
		}
	});
	window.history.pushState('page2', 'Title', url);
}
var loadFile = function(event) {
	var reader = new FileReader();
	var data = new FormData();
	var output = document.getElementById('img-output');
	data.append('file', $('#files')[0].files[0]);
	data.append('action', 'avatar');
	$.ajax({
		url: 'ajax/account.php',
		type: 'POST',
		dataType: 'json',
		data: data,
        contentType: false,
		cache : false,
    	processData: false,
    	async:true,
		success:function(data){
			output.src = data.avatar;
		}
	});
};
$document.ready(function() {
	setTimeout(function(){$("#pre-loader").fadeOut(1e3)},400);
	$('.img-avatar p').click(function(event) {
		$(this).next().trigger('click');
	});
	
	$('#manufacturers').change(function (e) { 
		NN_FRAMEWORK.SearchProduct();
	});
	$('body').on('click','.delete-search', function () {
		let key= $(this).data('key');
		let value= $(this).data('value');
		$('a.'+key+'_'+value).removeClass('active');
		$(this).parents('li').remove();

		if($('.center-right-product ul li').length==1){
			$('.center-right-product ul li').remove();
		}
		NN_FRAMEWORK.SearchProduct();
	});
	$('body').on('click','.remove-all', function () {
		$('.delete-search').each(function (index, element) {
			let key= $(this).data('key');
			let value= $(this).data('value');
			$('a.'+key+'_'+value).removeClass('active');
			$(this).parents('li').remove();
		});
		if($('.center-right-product ul li').length==1){
			$('.center-right-product ul li').remove();
		}
		NN_FRAMEWORK.SearchProduct();
	});
	if($('.center-right-product ul li').length==1){
		$('.center-right-product ul li').remove();
	}
	if($('.mansory-list').length){
		$('.mansory-list').masonry({
			columnWidth: '.col-item',
			itemSelector: '.col-item',
		});
	}
	$('.dropdown-menu-left').find('a').hover(function() {
		$('.dropdown-menu-left').find('li').removeClass('active');
		$('.tabs-menu-right').removeClass('active');
		$('.tabs-menu-right:eq('+$(this).parent().index()+')').addClass('active');
		$(this).parent().addClass('active');
	});
	$('.show-3d-model').mouseleave(function(event) {
		$('.dropdown-menu-left').find('li').removeClass('active');
		$('.tabs-menu-right').removeClass('active');
		$('.tabs-menu-right:eq(0)').addClass('active');
		$('.dropdown-menu-left').find('li:eq(0)').addClass('active');
	});
	$('.list-danhmuc-search li.danhmuc > p > a').click(function (e) { 
		e.preventDefault();
		if($(this).parents('li').hasClass('active')){
			$(this).parents('li').removeClass('active');
			$(this).parents('li').find('.show_click').slideUp();
			$(this).removeClass('active');
			$(this).parents('li').find('.show_click ').find('a').removeClass('active');
		}else{
			$('.list-danhmuc-search li.danhmuc, .list-danhmuc-search li.danhmuc > p > a').removeClass('active');
			$('.show_click ').find('a').removeClass('active');
			$('.list-danhmuc-search li.danhmuc').find('.show_click').slideUp();
			$(this).parents('li').addClass('active');
			$(this).addClass('active');
			$(this).parents('li').find('.show_click').slideDown();
		}
	});
	$('.list-danhmuc-search li.li-properties > p > a').click(function (e) { 
		e.preventDefault();
		if($(this).parents('li').hasClass('active')){
			$(this).parents('li').removeClass('active');
			$(this).parents('li').find('.box-show-properties').slideUp();
		}else{
			$(this).parents('li').addClass('active');
			$(this).parents('li').find('.box-show-properties').slideDown();
		}
	});
	$('.list-danhmuc-search li.li-properties a.properties,li.danhmuc .show_click p a').click(function (e) {
		$(this).toggleClass('active');
		setTimeout(() => {
			NN_FRAMEWORK.SearchProduct();
		}, 100);
	});
	$('.bookmarks a').click(function (e) { 
		if($(this).hasClass('active')){
			$(this).removeClass('active');
		}else{
			$('.bookmarks a').removeClass('active');
			$(this).addClass('active');
		}
		setTimeout(() => {
			NN_FRAMEWORK.SearchProduct();
		}, 100);
	});
	$('.tinhtrang a').click(function (e) { 
		if($(this).hasClass('active')){
			$(this).removeClass('active');
		}else{
			$('.tinhtrang a').removeClass('active');
			$(this).addClass('active');
		}
		setTimeout(() => {
			NN_FRAMEWORK.SearchProduct();
		}, 100);
		
	});
	let Scrollbar
    if (typeof Scrollbar !== typeof null) {
        if (document.querySelectorAll(".data-scrollbar").length) {
            Scrollbar = window.Scrollbar
            Scrollbar.init(document.querySelector('.data-scrollbar'), {
                continuousScrolling: false,
            })
        }
    };
    $('.change-order').click(function(event) {
    	let order = $(this).data('order');
    	let text = $(this).text();
    	$('.order-by').attr('data-order',order).text(text);
    	setTimeout(() => {
			NN_FRAMEWORK.SearchProduct();
		}, 100);
    });
    $('body').on('click', '.like_product_click', function(event) {
    	event.preventDefault();
    	if(IS_LOGIN == false){
    		window.location.href="account/login";
    		return false;
    	}
    	let cmd = (!$(this).hasClass('active'))?'add-like':'remove-like';
    	let id = $(this).data('like');
    	let _root= $(this);
    	$.ajax({
    		url: 'ajax/like_product.php',
    		type: 'POST',
    		data: {id:id,cmd:cmd},
    		success:function(data){
    			_root.toggleClass('active');
    		}
    	});
    });
    
    $('.slick_main').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: true,
	  fade: true,
	  draggable:false,
	  asNavFor: '.slick_thumb'
	});
	$('.slick_thumb').slick({
	  slidesToShow: 6,
	  slidesToScroll: 1,
	  vertical:true,
	  asNavFor: '.slick_main',
	  dots: false,
	  arrows: false,
	  draggable:false,
	  centerMode: false,
	  focusOnSelect: true
	});
	$('.click_download').click(function(event) {
		if(!IS_LOGIN) {
			window.location.href = 'account/login';
			return false;
		}
		$('.click_download').find('i').removeClass('fa-long-arrow-down').addClass('fa-circle-notch fa-spin');
		$('.click_download').addClass('prosecess');
		$('.click_download').find('span').hide();
		$.ajax({
			url: 'ajax/dowload_file.php',
			type: 'POST',
			dataType:'json',
			data: {id: $('#id_download').val()},
			befoeSend:function(){
				$('.note_dowload').hide();
			},
			success:function(data){
				if(data.error == 1){
					$('.note_dowload').text(data.mess).show();
					$('.click_download').find('i').addClass('fa-long-arrow-down').removeClass('fa-circle-notch fa-spin');
					$('.click_download').removeClass('prosecess');
					$('.click_download').find('span').show();
				}else if(data.error == 3){
					window.location.href = data.href;
				}else if(data.error == 0){
					setTimeout(function(){
						fetch(data.url).then(resp => resp.blob()) .then(blob => {
							const url = window.URL.createObjectURL(blob);
							const a = document.createElement('a');
							a.style.display = 'none';
							a.href = url;
							a.download = data.name;
							document.body.appendChild(a);
							a.click();
							window.URL.revokeObjectURL(url);
						}).catch(() => console.log('oh no!'));
						$('.click_download').find('i').addClass('fa-long-arrow-down').removeClass('fa-circle-notch fa-spin');
						$('.click_download').removeClass('prosecess');
						$('.click_download').find('span').show();
					},1000);
				}
			}
		})
	});
	$('.select-free ul li').click(function (e) { 
		if($(this).hasClass('active')){
			$('.select-free ul li').removeClass('active');
			$('#numFree i').text(0);
			$('#num_free').attr('value',0);
		}else{
			$('.select-free ul li').removeClass('active');
			$('#numFree i').text(0);
			$('#num_free').attr('value',0);
			$(this).addClass('active');
			$('#num_free').attr('value',$(this).data('num'));
			$('#numFree i').text($(this).data('num'));	
		}
		
		let totalPricePro = parseInt($('input#price_pro').val()) * parseInt($('#number_pro').val());
		let totalPriceFree = parseInt($('input#price_free').val()) * parseInt($('#num_free').val());
		$('#total_model').attr('value',totalPricePro+totalPriceFree);
		$('#load_price').text((totalPricePro+totalPriceFree)+'$');
		if($('#num_free').attr('value') == 0 && $('#number_pro').attr('value') == 0 ){
			$('#pay_models').prop("disabled",true);
		}else{
			$('#pay_models').prop("disabled",false);
		}
	});
	$('.wrap-button button').click(function (e) { 
		let num = parseInt($(this).parent('.wrap-button').prev().attr('value'));
		if($(this).hasClass('add-pro')){
			num++;
		}
		if($(this).hasClass('remove-pro')){
			num--;
		}
		if(num<0) num = 0;
		if(num>200) num = 200;
		$('#numPro i').text(num);

		$(this).parent('.wrap-button').prev().attr('value',num).val(num);

		let totalPricePro = parseInt($('input#price_pro').val()) * num;
		let totalPriceFree = parseInt($('input#price_free').val()) * parseInt($('#num_free').val());
		$('#total_model').attr('value',totalPricePro+totalPriceFree);
		$('#load_price').text((totalPricePro+totalPriceFree)+'$');
		if($('#num_free').attr('value') == 0 && $('#number_pro').attr('value') == 0 ){
			$('#pay_models').prop("disabled",true);
		}else{
			$('#pay_models').prop("disabled",false);
		}
	});
	$('#pay_models').click(function(event) {

		let options = {
		    theme:"sk-cube-grid",
		    message:'The operation is being performed. Please do not close the browser when finished.',
		    textColor:"white"
		};
		$.ajax({
			url: 'ajax/save_buy.php',
			type: 'POST',
			dataType: 'json',
			data: $('#form_models').serialize(),
			beforeSend:function(){
				HoldOn.open(options);
			},
			success:function(data){
				if(data.paypal==1){
					$('#txt_name_paypal').attr('value',data.mess);
					$('#total_paypal').attr('value',data.total);
					$('#form_paypal').submit();
				}else{
					window.location.href=CONFIG_BASE+'complete';
				}
			}
		})
	});
	$('#number_pro').keyup(function(event) {
		let num = $(this).val();
		if(num == 0) return false;
		if(num <2) {
			alert('minimum quantity to buy is 2 PRO'); return false;
		}
		if(num > 200) {
			alert('maximum quantity to buy is 200 PRO'); return false;
		}
	});
	NN_FRAMEWORK.menuMobile(),
	NN_FRAMEWORK.galleryPage(),
	NN_FRAMEWORK.aweOwlPage(),
	NN_FRAMEWORK.slickPage(),
	NN_FRAMEWORK.loadPage(),
	NN_FRAMEWORK.tocDetail(),
	NN_FRAMEWORK.tabDetail(),
	NN_FRAMEWORK.iconSearch(),
	NN_FRAMEWORK.backToTop(),
	NN_FRAMEWORK.setAlt(),
	NN_FRAMEWORK.pageCart();
	function tooltip2019() {
	    var w_tooltip = $("#tooltip").width();
	    var h_tooltip = 0;
	    var pad = 10;
	    var x_mouse = 0;
	    var y_mouse = 0;
	    var wrap_left = 0;
	    var wrap_right = 0;
	    var wrap_top = 0;
	    var wrap_bottom = 0;
	    $(".product-information").mousemove(function(e) {
	    	let html = $(this).clone().html();
	        if (html.length == 0) {
	            return;
	            $("#tooltip").hide();
	        }
	        $("#tooltip").html(html);
	        wrap_left = 0;
	        wrap_top = $(window).scrollTop();
	        wrap_bottom = $(window).height();
	        wrap_right = $(window).width();
	        x_mouse = e.pageX;
	        y_mouse = e.pageY;
	        h_tooltip = $("#tooltip").height();
	        if (x_mouse + w_tooltip > wrap_right) $("#tooltip").css("left", x_mouse - w_tooltip - pad);
	        else $("#tooltip").css("left", x_mouse + pad);
	        if (y_mouse - h_tooltip < wrap_top) $("#tooltip").css("top", wrap_top);
	        else $("#tooltip").css("top", y_mouse - h_tooltip - pad);
	        $("#tooltip").show();
	    });
	    $(".product-information").mouseout(function() {
	        $("#tooltip").hide();
	    });
	}
	if ($(window).width() > 768) {
	    $(document).ready(function(e) {
	        tooltip2019();
	    });
	    $(document).ajaxStop(function(e) {
	        tooltip2019();
	    })
	}
})