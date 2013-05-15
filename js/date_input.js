	jQuery.extend(DateInput.DEFAULT_OPTS, {   
	month_names: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],   
	short_month_names: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"],   
	short_day_names: ["一", "二", "三", "四", "五", "六", "日"],  
	 dateToString: function(date) {  
	    var month = (date.getMonth() + 1).toString();  
	    var dom = date.getDate().toString();  
	    if (month.length == 1) month = "0" + month;  
	    if (dom.length == 1) dom = "0" + dom;  
	    return date.getFullYear() + "-" + month + "-" + dom;  
	  }  
	  
	});   
	  
	$(function() {   
		$(".biuuu1").date_input();   
		$(".biuuu2").date_input();   
	}); 