$(function(){

    // 显示分辨率
    var toggle = true;
    $('.hd-user i').click(function(){

        if (toggle == true){

            toggle = false;
            $('.hd-info').show();
            $(this).removeClass('icon-down');
            $(this).addClass('icon-up');

        } else if (toggle == false){

            toggle = true;
            $('.hd-info').hide();
            $(this).removeClass('icon-up');
            $(this).addClass('icon-down');
        }
    });

    var toggle = true;
    $('span.tag').click(function(){

        if (toggle == true){

            toggle = false;
            $('.hd-info').show();
            $('.hd-user i').removeClass('icon-down');
            $('.hd-user i').addClass('icon-up');

        } else if (toggle == false){

            toggle = true;
            $('.hd-info').hide();
            $('.hd-user i').removeClass('icon-up');
            $('.hd-user i').addClass('icon-down');
        }
    });

    // 判断是否是微信浏览器打开
    function is_weixn(){
        var ua = navigator.userAgent.toLowerCase();
        if(ua.match(/MicroMessenger/i)=="micromessenger") {
            weixin = true;
        } else {
            weixin = false;
        }
    }
    // 弹出分享
    $('.ishare').click(function(){
        is_weixn();
        if (weixin == false) {
            $(".share-pop").show();
            $('.shade').show();
        } else {
            $(".share-pop-w").show();
            $('.shade').show();
        }

    });

    // 弹出评论框
    $(document).on('touchend', '.reply-btn, .add-com', function() {
        $('.shade').show();
        $('.comment-pop').show();
        $('textarea').focus();
    });

    // 点击取消隐藏评论和分享
    $(document).on('touchend', '.cancel', function() {
        $('textarea').val('');
        $('.shade').hide();
        $('.comment-pop').hide();
        $('.share-pop').hide();
        return false;
    });

    // 点击遮罩隐藏评论和分享
    $(document).on('touchend', '.shade', function() {
        $('textarea').val('');
        $('.shade').hide();
        $('.comment-pop').hide();
        $(".share-pop").hide();
        $(".share-pop-w").hide();
    });

    // 关闭登陆框
    // $(".more-comment").click(function(){
    // 	$(".login").show();
    // });
    // $(".icon-close").click(function(){
    // 	$(".login").hide();
    // });

    // 显示首页侧栏

    var $body = $('body');
    function disable(e) {
        e.preventDefault();
    }
    $('#panelSwitch').click(function(){
        $(document).on('touchmove', disable);
        if($body.hasClass('panel-active')){
            $body.removeClass('panel-active');
            $(document).off('touchmove', disable);
        }
        else{
            $body.addClass('panel-active');
            $(document).on('touchmove', disable);
        }
    });

    var windowHeight = $(document).height(),
        $body = $("body");
    $body.css("height", windowHeight);
    var startX, startY, moveEndX, moveEndY, X, Y;

    $("body").on("touchstart", function(e) {
        startX = e.originalEvent.changedTouches[0].pageX,
            startY = e.originalEvent.changedTouches[0].pageY;
    });
    $("body").on("touchmove", function(e) {
        moveEndX = e.originalEvent.changedTouches[0].pageX,
            moveEndY = e.originalEvent.changedTouches[0].pageY,
            X = moveEndX - startX,
            Y = moveEndY - startY;

        if ( Math.abs(X) > Math.abs(Y) && X < 0 ) {  //Math.abs(X) 取X的绝对值
            $body.removeClass('panel-active');
            $(document).off('touchmove', disable);
        }

    });

});

var browser={
    versions:function(){
        var u = navigator.userAgent, app = navigator.appVersion;
        return {//移动终端浏览器版本信息
            trident: u.indexOf('Trident') > -1, //IE内核
            presto: u.indexOf('Presto') > -1, //opera内核
            webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
            gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
            mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
            ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
            android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
            iPhone: u.indexOf('iPhone') > -1 , //是否为iPhone或者QQHD浏览器
            iPad: u.indexOf('iPad') > -1, //是否iPad
            webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
        };
    }(),
    language:(navigator.browserLanguage || navigator.language).toLowerCase()
}

if(browser.versions.mobile || browser.versions.ios || browser.versions.android ||
    browser.versions.iPhone || browser.versions.iPad){

}else{
    window.location = "http://www.59pic.com";
}