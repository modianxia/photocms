// JavaScript Document
function SouutuIMGupNext(bigimg){
var lefturl	= $("#prev").attr('href');
var righturl = $("#next").attr('href');
var imgurl		= righturl;
var width	= bigimg.width;
var height	= bigimg.height;
bigimg.onmousemove=function(){
	if(event.offsetX<width/2){
		bigimg.style.cursor	= 'url(/public/static/img/left.ico),auto';
		$('#prev').addClass('on');
		$('#next').removeClass('on');
		imgurl= lefturl;
	}else{
		bigimg.style.cursor	= 'url(/public/static/img/right.ico),auto';
		$('#prev').removeClass('on');
		$('#next').addClass('on');
		imgurl= righturl;
	}
}
bigimg.onclick=function(){
	top.location=imgurl;
}};