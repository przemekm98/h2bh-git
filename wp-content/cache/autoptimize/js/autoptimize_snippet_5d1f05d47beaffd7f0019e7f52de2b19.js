(function($){var body=$('body'),_window=$(window);(function(){var nav=$('#site-navigation'),button,menu;if(!nav)
return;button=nav.find('.menu-toggle');if(!button)
return;menu=nav.find('.nav-container');if(!menu||!menu.children().length){button.hide();return;}
$('.menu-toggle').on('click.icraft',function(){});})();_window.on('hashchange.icraft',function(){var element=document.getElementById(location.hash.substring(1));if(element){if(!/^(?:a|select|input|button|textarea)$/i.test(element.tagName))
element.tabIndex=-1;element.focus();}});})(jQuery);jQuery(document).ready(function($){jQuery('div.nav-container > ul > li > a').append('<span class="colorbar"></span>');jQuery('div.nav-container ul > li').hover(function(){jQuery(this).children('ul.children,ul.sub-menu').stop(true,true).slideDown("fast");},function(){jQuery(this).children('ul.children,ul.sub-menu').slideUp("fast");});jQuery('.search-form').append('<span class="searchico genericon genericon-search"></span>');$("div.entry-nothumb").parent(".meta-img").addClass("no-image-meta");jQuery('body').append('<a href="#" class="go-top animated"><span class="genericon genericon-collapse"></span></a>');jQuery(window).scroll(function(){if(jQuery(this).scrollTop()>200){jQuery('.go-top').fadeIn(200).addClass('bounce');}else{jQuery('.go-top').fadeOut("slow");}});jQuery('.go-top').click(function(event){event.preventDefault();jQuery('html, body').animate({scrollTop:0},1000);});$('.menu-toggle').sidr({name:'sidr-left',side:'left',source:'.nav-container',onOpen:function(){$('.menu-toggle').animate({marginLeft:"260px"},200);},onClose:function(){$('.menu-toggle').animate({marginLeft:"0px"},200);}});$(window).resize(function(){if($(window).width()>1070){$.sidr('close','sidr-left');}});$(window).load(function(){$('#footer-widgets').each(function(){$(this).masonry({});});$('#blog-cols').each(function(){$(this).masonry({});});});$('#da-slider').each(function(){_this=$(this);var slider_speed=_this.data('slider-speed');_this.owlCarousel({navigation:true,autoPlay:slider_speed,paginationSpeed:600,singleItem:true,rewindSpeed:600,stopOnHover:true,navigationText:['<span class="genericon genericon-leftarrow"></span>','<span class="genericon genericon-rightarrow"></span>'],addClassActive:true,theme:"owl-theme1",goToFirstSpeed:1000,slideSpeed:600,autoHeight:true});});});(function($){var nav_container=$(".headerwrap");var nav=$(".site-header");var top_spacing=30;var waypoint_offset=60;if($(".admin-bar").length>0)
{if($(window).width()<766)
{var top_spacing=0;}else
{var top_spacing=30;}}else
{var top_spacing=0;}
nav_container.waypoint({handler:function(direction){if(direction=='down'){nav_container.css({'height':nav.outerHeight()});nav.stop().addClass("fixeddiv").css("top",-nav.outerHeight()).animate({"top":top_spacing});}else{nav_container.css({'height':'auto'});nav.stop().removeClass("fixeddiv").css("top",nav.outerHeight()).animate({"top":""});}},offset:function(){return-nav.outerHeight()-waypoint_offset;}});if($('.utilitybar').length==0)
{console.log("no utility bar");$('.headerwrap').addClass('noutility');}
if($('.ibanner').length>0)
{var slider_parallax=$('#da-slider').data('slider-parallax');if(slider_parallax==1)
{var slidetop=parseInt($('.ibanner').offset().top);if($(window).width()>999)
{$(window).scroll(function(){var newvalue=parseInt($(this).scrollTop()*0.70)-100;if($(this).scrollTop()>slidetop)
{$('.da-img img').css('margin-top',newvalue+'px');}
if($(this).scrollTop()<=slidetop)
{var slideheight=$('.active .da-img img').height();$('.da-img img').css('margin-top',0+'px');$('.owl-wrapper-outer').css('max-height',slideheight+'px');}});}}}
if($('.products .product').length>0&&$('.woo-infiscroll').length>0)
{var infinite_scroll={loading:{img:null,msgText:'<div class="infi-loader"><span class="infi-in"><span class="infi-spinner"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i><span><span class="infi-loadingtext">Loading..<span></span></div>',finishedMsg:'<div class="infi-loader"><span class="infi-in">All Items loaded.</span></div>',},nextSelector:".page-numbers .next",navSelector:".page-numbers",itemSelector:"li.product",contentSelector:"ul.products",animate:true,dataType:'html',bufferPx:40,};$(infinite_scroll.contentSelector).infinitescroll(infinite_scroll);}
function destryandload()
{}})(jQuery);;