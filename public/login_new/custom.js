/*alert('public js custom');*/
function sideBarHeight(){
	"use strict";
	jQuery('body.login').attr('style','');
	jQuery('.contentSide').attr('style','');
	var screenHeight = jQuery(window).innerHeight();
	jQuery('.sidebar').css('min-height',screenHeight);
	jQuery('.contents').css('min-height',screenHeight);
	var loginBlock 	= jQuery('.login_block').innerHeight();
	var spaceIs 	= parseInt(screenHeight - loginBlock - 60)/parseInt(2);
	jQuery('body.login').css('padding-top',spaceIs);
	jQuery('body.login,body.detail_page').css('min-height',screenHeight);
	jQuery('.contentSide').css('min-height',loginBlock);
}
function removeShowClasses(){
	"use strict";
	jQuery('.pageBody').addClass('sideOPened');
		jQuery('.sidebar').addClass('openedSide');
	var screenWidth = jQuery(window).innerWidth();
	if(screenWidth < 1200){
		jQuery('.pageBody').removeClass('sideOPened');
		jQuery('.sidebar').removeClass('openedSide');
	}
}
function progressSetup(){
	"use strict";
	var screenS = jQuery(window).innerWidth(),
		oneS = '0%',
		twoS = '25%',
		thrS = '50%',
		forS = '75%',
		fivS = '100%';
		jQuery('.stepsProgress .progress .progress-bar').attr('style','');
	jQuery('.stepsProgress .progress .step').each(function(){
		var stepActive 	= jQuery(this).hasClass('activated'),
			one			= jQuery(this).hasClass('one'),
			two			= jQuery(this).hasClass('two'),
			three		= jQuery(this).hasClass('three'),
			four		= jQuery(this).hasClass('four'),
			five		= jQuery(this).hasClass('five');
		if(stepActive){
			if(one){
				if(screenS < 768){
					jQuery('.stepsProgress .progress .progress-bar').attr('style','height:'+oneS+';');
				}else{
					jQuery('.stepsProgress .progress .progress-bar').attr('style','width:'+oneS+';');
				}
			}
			if(two){
				if(screenS < 768){
					jQuery('.stepsProgress .progress .progress-bar').attr('style','height:'+twoS+';');
				}else{
					jQuery('.stepsProgress .progress .progress-bar').attr('style','width:'+twoS+';');
				}
			}
			if(three){
				if(screenS < 768){
					jQuery('.stepsProgress .progress .progress-bar').attr('style','height:'+thrS+';');
				}else{
					jQuery('.stepsProgress .progress .progress-bar').attr('style','width:'+thrS+';');
				}
			}
			if(four){
				if(screenS < 768){
					jQuery('.stepsProgress .progress .progress-bar').attr('style','height:'+forS+';');
				}else{
					jQuery('.stepsProgress .progress .progress-bar').attr('style','width:'+forS+';');
				}
			}
			if(five){
				if(screenS < 768){
					jQuery('.stepsProgress .progress .progress-bar').attr('style','height:'+fivS+';');
				}else{
					jQuery('.stepsProgress .progress .progress-bar').attr('style','width:'+fivS+';');
				}
			}
		}
	});
}
sideBarHeight();
removeShowClasses();
progressSetup();
jQuery(window).resize(function(){
	"use strict";
	sideBarHeight();
	removeShowClasses();
	progressSetup();
});
jQuery('.openCsidebar').on('click',function(){
	"use strict";
	jQuery('body').toggleClass('sideOPened');
	jQuery('.sidebar').toggleClass('openedSide');
});
jQuery('.detail_page .products_slider .nav-tabs>li>a').each(function(){
	"use strict";
	var itsBg = jQuery(this).attr('data-bg');
	jQuery(this).css('background-color',itsBg);
	if(itsBg === 'all'){
		jQuery(this).removeAttr('style');
		jQuery(this).addClass('btn btn-default');
	}
});
jQuery('.detail_page .products_slider .owl-carousel').owlCarousel({
	items: 4,
	margin: 16,
	nav: true,
	navText: ['<svg viewBox="0 0 62 62"><line fill="none" stroke="#717171" x1="45.815" y1="60.631" x2="16.185" y2="31"/><line fill="none" stroke="#717171" x1="45.815" y1="1.369" x2="16.185" y2="31"/></svg>','<svg viewBox="0 0 62 62"><line fill="none" stroke="#717171" x1="16.185" y1="60.631" x2="45.815" y2="31"/><line fill="none" stroke="#717171" x1="16.185" y1="1.369" x2="45.815" y2="31"/></svg>'],
	dots: true,
	responsive : {
		// breakpoint from 0 up
		0 : {
			items: 2,
		},
		// breakpoint from 480 up
		480 : {
			items: 2,
		},
		// breakpoint from 768 up
		768 : {
			items: 5  
		}
	}
});
jQuery('.app_slider .owl-carousel').owlCarousel({
	margin: 16,
	nav: true,
	navText: ['<svg viewBox="0 0 62 62"><line fill="none" stroke="#717171" x1="45.815" y1="60.631" x2="16.185" y2="31"/><line fill="none" stroke="#717171" x1="45.815" y1="1.369" x2="16.185" y2="31"/></svg>','<svg viewBox="0 0 62 62"><line fill="none" stroke="#717171" x1="16.185" y1="60.631" x2="45.815" y2="31"/><line fill="none" stroke="#717171" x1="16.185" y1="1.369" x2="45.815" y2="31"/></svg>'],
	dots: true,
	responsive : {
		// breakpoint from 0 up
		0 : {
			items: 2,
		},
		// breakpoint from 480 up
		480 : {
			items: 2,
		},
		// breakpoint from 768 up
		768 : {
			items: 5,    
		}
	},
	
});
jQuery('.contactForm .form-control').on('focus',function(){
	"use strict";
	var CurrentField = jQuery(this),
		inputField = jQuery('.input-group');
	inputField.removeClass('focused');
	CurrentField.parent().addClass('focused');
});
jQuery('.contactForm .form-control').on('blur',function(){
	"use strict";
	var inputField = jQuery('.input-group');
	inputField.removeClass('focused');
});
















