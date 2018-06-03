// JavaScript Document
$(document).ready(function() {
	$(".cm_block04 .itMore a.tabs").hover(
	function(){
		$(this).addClass("current");
		$(this).siblings().removeClass("current");
		var dangqian=$(".cm_block04 .zxmmtp_gd").eq($(".cm_block04 .itMore a.tabs").index(this));
		dangqian.show();
		dangqian.siblings().hide();
		}
	);
	$(".cm_block04 ul li").hover(
		function(){
			$(this).find(".txt_box").animate({top:"210px"},"linear");
		},function(){
			$(this).find(".txt_box").animate({top:"242px"},"linear");
		}
	);
	$(".Imeinvlist ul li").hover(
		function(){
			$(this).find(".txt_box").animate({top:"210px"},"linear");
		},function(){
			$(this).find(".txt_box").animate({top:"242px"},"linear");
		}
	);
	$(".tk_ind .cm_block05 .lm_name .tab span").hover(
	function(){
		$(this).addClass("current");
		$(this).siblings().removeClass("current");
		var dangqian=$(".tk_ind .cm_block05 ul").eq($(".tk_ind .cm_block05 .lm_name .tab span").index(this));
		dangqian.addClass("showbox");
		dangqian.siblings().removeClass("showbox");
		}
	);
	$(".cm_block05 dd").hover(
	function(){
		$(this).addClass("current");
		$(this).find(".btn").show();
		},
	function(){
		$(this).removeClass("current");
		$(this).find(".btn").hide();
		}
	);
	$(".home_index .cm_block05 .box dl dd").hover(
	function(){
		$(this).addClass("current");
		$(this).find(".btn").show();
		},
	function(){
		$(this).removeClass("current");
		$(this).find(".btn").hide();
		}
	);
	
		/* 设置第一张图片 */
	$(".slider .bd li").first().before($(".slider .bd li").last());
	
	/* 鼠标悬停箭头按钮显示 */
	$(".slider").hover(function(){
		$(this).find(".arrow").stop(true,true).fadeIn(300)
	},function(){
		$(this).find(".arrow").fadeOut(300)
	});
//	$(".txt_top").hover(function(){
//		$(this).find(".txtshow").stop(true,true).fadeIn(300)
//	},function(){
//		$(this).find(".txtshow").fadeOut(300)
//	});
	
	/* 滚动切换 */
	$(".slider").slide({
		titCell:".hd ul", 
		mainCell:".bd ul", 
		effect:"leftLoop",
		autoPlay:true, 
		vis:5,
		autoPage:true, 
		trigger:"click"
	});
	
	/*TAGS*/
	$('#JS-news .title-tab a').each(function(index){
		$(this).click(function(){
			$('#JS-news div.tab-box2-nr').hide().eq(index).show();
			$(this).addClass('dq').siblings().removeClass('dq');
		});
	});	
	$('.tab-box2-nr').delegate('ul.news-list li', 'mouseenter', function(){
		$(this).addClass('dq');
	}).delegate('ul.news-list li', 'mouseleave', function(){
		$(this).removeClass('dq');
	})
	/*imgshow*/	
	$('.tab-box2-nr').delegate('ul.news-list li div.news-abs', 'mouseenter', function(){
		$(this).addClass('news-absover');
	}).delegate('ul.news-list li div.news-abs', 'mouseleave', function(){
		$(this).removeClass('news-absover');
	})
	/*menubox*/	
		var qcloud={};
	$('[_t_nav]').hover(function(){
		var _nav = $(this).attr('_t_nav');
		clearTimeout( qcloud[ _nav + '_timer' ] );
		qcloud[ _nav + '_timer' ] = setTimeout(function(){
		$('[_t_nav]').each(function(){
		$(this)[ _nav == $(this).attr('_t_nav') ? 'addClass':'removeClass' ]('nav-up-selected');
		});
		$('#'+_nav).stop(true,true).slideDown(200);
		}, 150);
	},function(){
		var _nav = $(this).attr('_t_nav');
		clearTimeout( qcloud[ _nav + '_timer' ] );
		qcloud[ _nav + '_timer' ] = setTimeout(function(){
		$('[_t_nav]').removeClass('nav-up-selected');
		$('#'+_nav).stop(true,true).slideUp(200);
		}, 150);
	});
	//二维码
	$('#mweb').hover(function(){
		$(this).find('div').fadeIn('fast');
	},function(){
		$(this).find('div').fadeOut('fast');
	})
	//tags
	$('.tags').hover(function(){
		$(this).find('.tags-list').fadeIn('fast');
		$(this).addClass('tover');
	},function(){
		$(this).find('.tags-list').fadeOut('fast');
		$(this).removeClass('tover');
	})
	
	//搜索 15-05-08
	$(".in_search").click(function(){
		$(".search_cont").addClass('ser').animate({
			width:170,
		},200);
		if($(this).val() == '搜索'){
			$(".in_search").val('');
		}
	})
	$(".in_search").blur(function(){
		if($(this).val() !== ''){
			return false;
		}
		$(".search_cont").removeClass('ser').animate({
			width:90,
		},200);
		$(".in_search").val('搜索');
	});
	
	//showphotolists
	$('#showlists').click(function(){
		$('.showlists').toggle();
		$('.workContentWrapper').toggle();
		$('#time2').html($('#time').html());
	})
	$('#showphotos').click(function(){
		$('.showlists').toggle();
		$('.workContentWrapper').toggle();
		$('#time2').html();
	})
	
	$(".workOtherImg a").hover(
		function(){
			$(this).find(".tit").animate({bottom:"-0"},"linear");
			},function(){
				$(this).find(".tit").animate({bottom:"-23px"},"linear");
			}
	);
	
});