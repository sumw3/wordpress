/* Search form */
function showSearchWord(id) {
	str=document.getElementById(id);
	str.style.backgroundPosition='0 -42px';
}
function hiddSearchWord(id) {
	str=document.getElementById(id);
	str.value='';
	str.style.backgroundPosition='0 -75px';
}
/* Submenu */
$(function(){
	$("#mainmenu>div>ul>li").hover(function() {
		if(!$(this).children("ul").is(":animated")) {
			$(this).children("ul").slideDown("800");
		}
	},function() {
		$(this).children("ul").slideUp("400");
	});
});
/* Scroll tools */
jQuery(document).ready(function($) {
var s = $('#top_foot').offset().top;
$(window).scroll(function() {
$("#top_foot").animate({
top: $(window).scrollTop() + s + "px"
},
{
queue: false,
duration: 500
})
});
$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
$('#top').click(function() {
$body.animate({
scrollTop: '0px'
},
400)
});
$('#foot').click(function() {
$body.animate({
scrollTop: $('.copyright').offset().top
},
400)
});
$('#tocomment').click(function() {
$body.animate({
scrollTop: $('#comments').offset().top
},
400)
});
});
/* @ to commenter */
jQuery(".comment-reply-link").click(function() {
	var uid = jQuery(this).parent().parent().parent().attr("id");
	var unm = jQuery(this).parent().parent().children().first().text().trim();
	//jQuery("#comment").attr("value","<a href='#" + uid + "'>@" + unm + ":</a> ").focus();
	jQuery("#comment").attr("value","@" + unm + ": ").focus();
});
jQuery("#cancel-comment-reply-link").click(function() {
	jQuery("#comment").empty();
});
$(document).ready(function() {
	$(".more-link").parent("p").css("text-indent","0");
	$(".highslide-image").parent("p").css("text-indent","0");
});