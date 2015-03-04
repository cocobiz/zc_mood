/**
 * @author Mobanbase.com
 */
var Mobanbase = Mobanbase || {};

Mobanbase.getPosition = function(o){
	var temp={};
    temp.left=temp.top=0;
    while(o!=document.body){
        temp.left+=o.offsetLeft;
        temp.top+=o.offsetTop;
        o=o.offsetParent;
    }
    return temp;
}

Mobanbase.getCart = function(){
	var url = 'index.php?action=get_cart&in_ajax=1';
	var callback = function(response){
		var template = '<h3 class="fix"><span class="products l">Products</span>  <span class="price r">Price</span></h3>\
		            <ul>{list}</ul>\
				    <p class="actions"><a href="index.php?main_page=shopping_cart" class="p-view-cart-link">View {productsNum} item(s) in cart</a></p>\
				    <p class="subtotal">Total: <em><span class="price">{total}</span></em></p>\
				    <p class="tr"><button class="submit" onclick="window.location=\'index.php?main_page=shopping_cart\'">Checkout</button></p>';
		if(response.result =='success'){
			var list = response.list;
			var li   = '';
			for(var i=0; i<list.length; i++){
				li += '<li><div class="pro-img">'+list[i].image+'</div>\
	            <div class="pro-info">\
	                <h4>'+list[i].name+'</h4>\
	                <p class="info-price">Price: <span class="price">'+list[i].final_price+'</span>/Yard</p>\
	                <p class="info-model">Product #: '+list[i].model+'</p>\
	                <p class="info-size">Qty: '+list[i].quantity+' Yard</p>\
	            </div>\
	            <div class="pro-price"><span class="price">'+list[i].final_price+'</span></div></li>';
			}
			template = template.replace(/{list}/,li).replace(/{productsNum}/, response.productsNum).replace(/{total}/, response.total);
			$('.header-cart-box').html(template);
			$('.header-cart-status .items').html(response.productsNum + ' items');
		}
	}
	$.getJSON(url,null,callback);
}
Mobanbase.getCookie = function(n){
	var r = new RegExp("(?:^|;+|\\s+)" + n + "=([^;]*)"), m = document.cookie.match(r);
	return (!m ? "" : m[1]);
}
Mobanbase.setCookie = function(name, value, domain, path, hour){
	if(hour){
		var expire = new Date();
		expire.setTime(expire.getTime() + 3600000 * hour);
	}
	document.cookie = name + "=" + value + "; " + (hour ? ("expires=" + expire.toGMTString() + "; ") : "") + (path ? ("path=" + path + "; ") : "path=/; ") + (domain ? ("domain=" + domain + ";") : "");
	return true;
};
Mobanbase.popWindow = function(){
	this.init.apply(this, arguments);
}
Mobanbase.popWindow.prototype = {
		constructor: Mobanbase.popWindow,
		init: function(config){
			config  = config || {};
			this.content = config.content;
			
			this.content = $('<div class="content abs"><a href="javascript:;" class="close abs"></a></div>').append(this.content);
			this.contentWrapper = $('<div class="content-wrapper abs"></div>').append(this.content);
			this.wrapper = $('<div class="pop-window"><div class="mask abs"></div></div>').append(this.contentWrapper);
			this.wrapper.height($(window).height());
			
			this.wrapper.find('.dn').removeClass('dn')
			$('body').css('overflow','hidden')
					 .append(this.wrapper);
			
			var top = ($(window).height() - config.content.height())/2;
			this.content.css({
				'top':(top < 0) ? '40px': top,
				'left':($(window).width() - config.content.width())/2
			});
			
			this.addEvent();
		},
		addEvent:function(){
			var that = this;
			this.wrapper.click(function(e){
				if(e.target.className.indexOf('close') != -1 || e.target.className.indexOf('content-wrapper') != -1){
					that.wrapper.remove();
					$('body').css('overflow','auto');
				}
			});
		}
}


