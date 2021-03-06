
(function($){if(typeof EPBOUWERLayout!='undefined'){return;}
EPBOUWERLayout={init:function()
{EPBOUWERLayout._destroy();EPBOUWERLayout._initClasses();EPBOUWERLayout._initAnchorLinks();EPBOUWERLayout._initHash();EPBOUWERLayout._initBackgrounds();EPBOUWERLayout._initModuleAnimations();EPBOUWERLayout._initForms();},_destroy:function()
{var win=$(window);win.off('scroll.fl-bg-parallax');win.off('resize.fl-bg-video');},_isTouch:function()
{if(('ontouchstart'in window)||(window.DocumentTouch&&document instanceof DocumentTouch)){return true;}
return false;},_initClasses:function()
{$('body').addClass('ep-bouwer');if(EPBOUWERLayout._isTouch()){$('body').addClass('ep-bouwer-touch');}},_initBackgrounds:function()
{var win=$(window);if($('.fl-row-bg-parallax').length>0&&!EPBOUWERLayout._isTouch()){EPBOUWERLayout._scrollParallaxBackgrounds();EPBOUWERLayout._initParallaxBackgrounds();win.on('scroll.fl-bg-parallax',EPBOUWERLayout._scrollParallaxBackgrounds);}
if($('.fl-bg-video').length>0){EPBOUWERLayout._resizeBgVideos();win.on('resize.fl-bg-video',EPBOUWERLayout._resizeBgVideos);}},_initParallaxBackgrounds:function()
{$('.fl-row-bg-parallax').each(EPBOUWERLayout._initParallaxBackground);},_initParallaxBackground:function()
{var row=$(this),content=row.find('.fl-row-content-wrap'),src=row.data('parallax-image'),img=new Image();if(typeof src!='undefined'){$(img).on('load',function(){content.css('background-image','url('+src+')');});img.src=src;}},_scrollParallaxBackgrounds:function()
{$('.fl-row-bg-parallax').each(EPBOUWERLayout._scrollParallaxBackground);},_scrollParallaxBackground:function()
{var win=$(window),row=$(this),content=row.find('.fl-row-content-wrap'),speed=row.data('parallax-speed'),offset=content.offset(),yPos=-((win.scrollTop()-offset.top)/speed);content.css('background-position','center '+yPos+'px');},_resizeBgVideos:function()
{$('.fl-bg-video').each(EPBOUWERLayout._resizeBgVideo);},_resizeBgVideo:function()
{if(0===$(this).find('video').length){return;}
var wrap=$(this),wrapHeight=wrap.outerHeight(),wrapWidth=wrap.outerWidth(),vid=wrap.find('video'),vidHeight=vid.data('height'),vidWidth=vid.data('width'),newWidth=wrapWidth,newHeight=Math.round(vidHeight*wrapWidth/vidWidth),newLeft=0,newTop=0;if(vidHeight==''||vidWidth==''){vid.css({'left':'0px','top':'0px','width':newWidth+'px'});}
else{if(newHeight<wrapHeight){newHeight=wrapHeight;newWidth=Math.round(vidWidth*wrapHeight/vidHeight);newLeft=-((newWidth-wrapWidth)/2);}
else{newTop=-((newHeight-wrapHeight)/2);}
vid.css({'left':newLeft+'px','top':newTop+'px','height':newHeight+'px','width':newWidth+'px'});}},_initModuleAnimations:function()
{if($('.ep-bouwer-edit').length===0&&typeof jQuery.fn.waypoint!=='undefined'&&!EPBOUWERLayout._isTouch()){$('.fl-animation').waypoint({offset:'80%',handler:EPBOUWERLayout._doModuleAnimation});}},_doModuleAnimation:function()
{var module=$(this),delay=parseFloat(module.data('animation-delay'));if(!isNaN(delay)&&delay>0){setTimeout(function(){module.addClass('fl-animated');},delay*1000);}
else{module.addClass('fl-animated');}},_initHash:function()
{var hash=window.location.hash.replace('#',''),element=null,tabs=null,responsiveLabel=null,tabIndex=null,label=null;if(''!=hash){element=$('#'+hash);if(element.length>0){if(element.hasClass('fl-accordion-item')){setTimeout(function(){element.find('.fl-accordion-button').trigger('click');},100);}
if(element.hasClass('fl-tabs-panel')){setTimeout(function(){tabs=element.closest('.fl-tabs');responsiveLabel=element.find('.fl-tabs-panel-label');tabIndex=responsiveLabel.data('index');label=tabs.find('.fl-tabs-labels .fl-tabs-label[data-index='+tabIndex+']');if(responsiveLabel.is(':visible')){responsiveLabel.trigger('click');}
else{label.trigger('click');}},100);}}}},_initAnchorLinks:function()
{$('a').each(EPBOUWERLayout._initAnchorLink);},_initAnchorLink:function()
{var link=$(this),href=link.attr('href'),id=null,element=null;if('undefined'!=typeof href&&href.indexOf('#')>-1){try{id=href.split('#').pop();element=$('#'+id);if(element.length>0){if(element.hasClass('fl-row')||element.hasClass('fl-col')||element.hasClass('fl-module')){$(link).on('click',EPBOUWERLayout._scrollToElementOnLinkClick);}
if(element.hasClass('fl-accordion-item')){$(link).on('click',EPBOUWERLayout._scrollToAccordionOnLinkClick);}
if(element.hasClass('fl-tabs-panel')){$(link).on('click',EPBOUWERLayout._scrollToTabOnLinkClick);}}}
catch(e){}}},_scrollToElementOnLinkClick:function(e,callback)
{var element=$('#'+$(this).attr('href').split('#').pop()),dest=0,win=$(window),doc=$(document);if(element.length>0){if(element.offset().top>doc.height()-win.height()){dest=doc.height()-win.height();}
else{dest=element.offset().top-100;}
$('html, body').animate({scrollTop:dest},1000,'swing',callback);e.preventDefault();}},_scrollToAccordionOnLinkClick:function(e)
{var element=$('#'+$(this).attr('href').split('#').pop());if(element.length>0){var callback=function(){if(element){element.find('.fl-accordion-button').trigger('click');element=false;}};EPBOUWERLayout._scrollToElementOnLinkClick.call(this,e,callback);}},_scrollToTabOnLinkClick:function(e)
{var element=$('#'+$(this).attr('href').split('#').pop()),tabs=null,label=null,responsiveLabel=null;if(element.length>0){tabs=element.closest('.fl-tabs');responsiveLabel=element.find('.fl-tabs-panel-label');tabIndex=responsiveLabel.data('index');label=tabs.find('.fl-tabs-labels .fl-tabs-label[data-index='+tabIndex+']');if(responsiveLabel.is(':visible')){var callback=function(){if(element){responsiveLabel.trigger('click');element=false;}};EPBOUWERLayout._scrollToElementOnLinkClick.call(this,e,callback);}
else{label.trigger('click');}
e.preventDefault();}},_initForms:function()
{if(!EPBOUWERLayout._hasPlaceholderSupport){$('.fl-form-field input').each(EPBOUWERLayout._initFormFieldPlaceholderFallback);}
$('.fl-form-field input').on('focus',EPBOUWERLayout._clearFormFieldError);},_hasPlaceholderSupport:function()
{var input=document.createElement('input');return'undefined'!=input.placeholder;},_initFormFieldPlaceholderFallback:function()
{var field=$(this),val=field.val(),placeholder=field.attr('placeholder');if('undefined'!=placeholder&&''==val){field.val(placeholder);field.on('focus',EPBOUWERLayout._hideFormFieldPlaceholderFallback);field.on('blur',EPBOUWERLayout._showFormFieldPlaceholderFallback);}},_hideFormFieldPlaceholderFallback:function()
{var field=$(this),val=field.val(),placeholder=field.attr('placeholder');if(val==placeholder){field.val('');}},_showFormFieldPlaceholderFallback:function()
{var field=$(this),val=field.val(),placeholder=field.attr('placeholder');if(''==val){field.val(placeholder);}},_clearFormFieldError:function()
{var field=$(this);field.removeClass('fl-form-error');field.siblings('.fl-form-error-message').hide();}};$(function(){EPBOUWERLayout.init();});})(jQuery);(function($){$(function(){var slider=$('.fl-node-5a3108dbe872d .fl-content-slider').bxSlider({adaptiveHeight:true,auto:true,autoHover:true,autoControls:false,pause:5000,mode:'horizontal',speed:500,controls:false,pager:false,video:true,onSliderLoad:function(){$('.fl-node-5a3108dbe872d .fl-content-slider').addClass('fl-content-slider-loaded');}});slider.data('bxSlider',slider);});})(jQuery);var wpAjaxUrl='https://how2behealthy.nl/wp-admin/admin-ajax.php';var flBuilderUrl='https://how2behealthy.nl/wp-content/plugins/The_New-epic_bouwer/';