/*
 * Parabola theme frontend.js
 */
 
jQuery(document).ready(function() {

	/* Masonry */
	parabola_activateMasonry();

	/* Standard menu touch support for tablets */
	var custom_event = ('ontouchstart' in window) ? 'touchstart' : 'click'; /* check touch support */
	var ios = /iPhone|iPad|iPod/i.test(navigator.userAgent);
	jQuery( '#access .menu > ul > li a' ).on( 'click', function(e){
			var link_id = jQuery(this).attr('href');
			if (jQuery(this).closest('#access').data('clicked') == link_id) { 
				/* second touch */
				jQuery(this).closest('#access').data('clicked', null);
			} else {
				/* first touch */
				if (custom_event != 'click' && !ios && (jQuery(this).parent().children('ul').length >0)) { e.preventDefault(); }
				jQuery(this).closest('#access').data('clicked', link_id);
				jQuery(this).next('.sub-menu').slideDown();
			}
		});

	/* Back to top button animation */
	jQuery(function() {
		jQuery(window).on('scroll', function() {
			var x=jQuery(this).scrollTop();
			var ver = getInternetExplorerVersion();
			/* no fade animation (transparency) if IE8 or below */
			if ( ver > -1 && ver <= 8 ) {
				if(x != 0) {
						jQuery('#toTop').show();
					} else {
						jQuery('#toTop').hide();
					}
			}
			/* fade animation if not IE8 or below */
			else {
			if(x != 0) {
					jQuery('#toTop').fadeIn(3000);
				} else {
					jQuery('#toTop').fadeOut();
				}
		}
		});
		jQuery('#toTop').on('click', function() { jQuery('body,html').animate({scrollTop:0},800); });
	});

	/* Menu animation */
	jQuery("#access > div > ul > li").on( 'mouseenter', function(){
		if (jQuery(this).find('ul').length > 0) jQuery("#access > div > ul > li > ul").hide();
	});

	jQuery("#access ul ul").css({display: "none"}); /* Opera Fix */
	jQuery("#access > .menu ul li > a:not(:only-child)").attr("aria-haspopup","true"); /* IE10 mobile Fix */

	jQuery("#access li").on( 'mouseenter', function(){
		jQuery(this).find('ul:first').stop();
		jQuery(this).find('ul:first').css({opacity: "0"}).css({visibility: "visible",display: "none",overflow:"visible"}).slideDown({duration:400}).animate({"opacity":1},{queue:false});
	}).on( 'mouseleave', function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "block",overflow:"visible"}).slideUp(150);
	});

	/* Social Icons Animation */
	jQuery(".socialicons").append('<div class="socials-hover"></div>');
	jQuery(".socialicons").on('mouseenter', function(){
			jQuery(this).find(".socials-hover").animate({"bottom":"0"},{queue:false,duration:150});
		}).on('mouseleave', function() {
			jQuery(this).find(".socials-hover").animate({"bottom":"100%"},{queue:false,duration:150, complete: function() {
				jQuery(this).css({bottom:"-100%"});
				}
			});
		}
	);

	/* Detect and apply custom class for Safari */
	if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
		jQuery('body').addClass('safari');
	}

});
/* end document.ready */

/* Masonry init, called on both ready and window.load */
function parabola_activateMasonry(){ 
	if ( (parabola_settings.masonry==1) && ( typeof jQuery.fn.masonry !== 'undefined' )) {
			jQuery('body.magazine-layout .content-masonry').masonry({
				itemSelector: 'article',
				columnWidth: 'article',
				percentPosition: true,
			});
		}
}

/* Mobile Menu v2 */
function parabola_mobilemenu_init() {
	var state = false;
	jQuery("#nav-toggle").on('click', function(){
		jQuery("#access").slideToggle(function(){ if (state) {jQuery(this).removeAttr( 'style' )}; state = ! state; } );
	});
}

/* Columns equalizer, used if at least one sidebar has a bg color */
function parabola_equalizeHeights(){
    var h1 = jQuery("#primary").height();
	var h2 = jQuery("#secondary").height();
	var h3 = jQuery("#content").height();
    var max = Math.max(h1,h2,h3);
	if (h1<max) { jQuery("#primary").height(max); };
	if (h2<max) { jQuery("#secondary").height(max); };
}

jQuery(window).on('load', function() {
	/* FitVids & mobile menu */
	if (parabola_settings.mobile==1) parabola_mobilemenu_init();
	if (parabola_settings.fitvids==1) jQuery(".entry-content").fitVids();
	
	/* Second Masonry, in case elements expand size due to dynamic content; keep after FitVids */
	parabola_activateMasonry();
});

/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

;(function( $ ){

  'use strict';

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement("div");
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        'iframe[src*="player.vimeo.com"]',
        'iframe[src*="youtube.com"]',
        'iframe[src*="youtube-nocookie.com"]',
        'iframe[src*="kickstarter.com"][src*="video.html"]',
        'object',
        'embed'
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not('object object'); // SwfObj conflict patch
      $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.

      $allVideos.each(function(){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; // Disable FitVids on this video.
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('name')){
          var videoName = 'fitvid' + $.fn.fitVids._count;
          $this.attr('name', videoName);
          $.fn.fitVids._count++;
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+'%');
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
  
  // Internal counter for unique video names.
  $.fn.fitVids._count = 0;
  
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );


/* Returns the version of Internet Explorer or a -1
  (indicating the use of another browser). */
function getInternetExplorerVersion()
{
  var rv = -1; /* assume not IE. */
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}

/* FIN */