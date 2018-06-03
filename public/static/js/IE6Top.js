/*var isie6 = window.XMLHttpRequest ? false : true; function newtoponload() { var c = document.getElementById("back-to-top"); function b() { var a = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop; if (a > 0) { if (isie6) { c.style.display = "none"; clearTimeout(window.show); window.show = setTimeout(function () { var d = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop; if (d > 0) { c.style.display = "block"; c.style.top = (500 + d) + "px" } }, 300) } else { c.style.display = "block" } } else { c.style.display = "none" } } if (isie6) { c.style.position = "absolute" } window.onscroll = b; b() } if (window.attachEvent) { window.attachEvent("onload", newtoponload) } else { window.addEventListener("load", newtoponload, false) } document.getElementById("back-to-top").onclick = function () { window.scrollTo(0, 0) };*/


var isie6 = window.XMLHttpRequest ? false: true;
function newtoponload() {
	var c = document.getElementById("back-to-top");
	function b() {
		var a = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
		if (a > 0) {
			if (isie6) {
				c.style.display = "none";
				clearTimeout(window.show);
				window.show = setTimeout(function() {
					var d = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
					if (d > 0) {
						c.style.display = "block";
						c.style.top = (200 + d) + "px"
					}
				},
				300)
			} else {
				c.style.display = "block"
			}
		} else {
			c.style.display = "none"
		}
	}
	if (isie6) {
		c.style.position = "absolute"
	}
	window.onscroll = b;
	b()
}
if (window.attachEvent) {
	window.attachEvent("onload", newtoponload)
} else {
	window.addEventListener("load", newtoponload, false)
}
document.getElementById("back-to-top-btn").onclick = function() {
	//window.scrollTo(0, 0)
	$("html,body").animate({scrollTop: 0}, 500);
};



/*function addFavorite2() {
    var url = window.location;
    var title = document.title;
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf("360se") > -1) {
        alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
    }
    else if (ua.indexOf("msie 8") > -1) {
        window.external.AddToFavoritesBar(url, title); //IE8
    }
    else if (document.all) {
  try{
   window.external.addFavorite(url, title);
  }catch(e){
   alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
  }
    }
    else if (window.sidebar) {
        window.sidebar.addPanel(title, url, "");
    }
    else {
  alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    }
}*/