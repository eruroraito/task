$(function(){
		var width = $(document).width();
		var height = $(document).height();
		$('.main').width(width);
		$('.main').height(height);
		$('html').width(width);
		$('html').height(height);
		//alert(width);
		//alert(height);
	}
);

function orientationChange(){  
	switch(window.orientation) {   
		case 0: $('#basic').hide();
		case 180: $('#basic').hide();  
		// Javascript to setup Portrait view   
		break;   
		case -90: $('#basic').show();			  
		case 90: $('#basic').show();
		// Javascript to steup Landscape view   
		break;   
	}   
}
window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", orientationChange, false);

