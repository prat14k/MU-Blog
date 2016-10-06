<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

.share-btn-wrp {
	list-style: none;
	display: block;
	margin: 0px;
	padding: 0px;
	width: 32px;
	left: 0px;
	position: fixed;
}
.share-btn-wrp .button-wrap{
	text-indent:-100000px;
	width:32px;
	height: 32px;
	cursor:pointer;
	transition: width 0.1s ease-in-out;
}
.share-btn-wrp > .facebook{
	background: url(images/share-icons.png) no-repeat -42px 0px;
}
.share-btn-wrp > .facebook:hover{
	background: url(images/share-icons.png) no-repeat -4px -0px;
	width:38px;
}
.share-btn-wrp > .twitter{
	background: url(images/share-icons.png) no-repeat -42px -34px;
}
.share-btn-wrp > .twitter:hover{
	background: url(images/share-icons.png) no-repeat -4px -34px;
	width:38px;
}
.share-btn-wrp > .digg{
	background: url(images/share-icons.png) no-repeat -42px -68px;
}
.share-btn-wrp > .digg:hover{
	background: url(images/share-icons.png) no-repeat -4px -68px;
	width:38px;
}
.share-btn-wrp > .stumbleupon{
	background: url(images/share-icons.png) no-repeat -42px -102px;
}
.share-btn-wrp > .stumbleupon:hover{
	background: url(images/share-icons.png) no-repeat -4px -102px;
	width:38px;
}
.share-btn-wrp > .delicious{
	background: url(images/share-icons.png) no-repeat -42px -136px;
}
.share-btn-wrp > .delicious:hover{
	background: url(images/share-icons.png) no-repeat -4px -136px;
	width:38px;
}
.share-btn-wrp > .gplus{
	background: url(images/share-icons.png) no-repeat -42px -170px;
}
.share-btn-wrp > .gplus:hover{
	background: url(images/share-icons.png) no-repeat -4px -170px;
	width:38px;
}
.share-btn-wrp > .email{
	background: url(images/share-icons.png) no-repeat -42px -408px;
}
.share-btn-wrp > .email:hover{
	background: url(images/share-icons.png) no-repeat -4px -408px;
	width:38px;
}

@media all and (max-width: 699px) {
	.share-btn-wrp{
		width: 100%;
		text-align: center;
		position: fixed;
		bottom: 1px;
	}
	.share-btn-wrp .button-wrap {
		display: inline-block;
		margin-left: -2px;
		margin-right: -2px;
	}
}

</style>
<script type="text/javascript" src="jss/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var pageTitle	= document.title; //HTML page title
    var pageUrl		= location.href; //Location of this page
	
	$('.share-btn-wrp li').click(function(event){
		var shareName = $(this).attr('class').split(' ')[0]; //get the first class name of clicked element
		switch(shareName) //switch to different links based on different social name
		{
			case 'facebook':
				OpenShareUrl('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
				break;
			case 'twitter':
				OpenShareUrl('http://twitter.com/home?status=' + encodeURIComponent(pageTitle + ' ' + pageUrl));
				break;
			case 'digg':
				OpenShareUrl('http://www.digg.com/submit?phase=2&amp;url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
				break;
			case 'stumbleupon':
				OpenShareUrl('http://www.stumbleupon.com/submit?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
				break;
			case 'delicious':
				OpenShareUrl('http://del.icio.us/post?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
				break;
			case 'gplus':
				OpenShareUrl('https://plus.google.com/share?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
				break;
			case 'email':
				OpenShareUrl('mailto:?subject=' + pageTitle + '&body=Found this useful link for you : ' + pageUrl);
				break;
		}
		
	});
		
	function OpenShareUrl(openLink){
		//Parameters for the Popup window
        winWidth    = 650; 
        winHeight   = 450;
        winLeft     = ($(window).width()  - winWidth)  / 2,
        winTop      = ($(window).height() - winHeight) / 2,
        winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
        window.open(openLink,'Share This Link',winOptions); //open Popup window to share website.
        return false;
	}
});
</script>
<ul class="share-btn-wrp">
    <li class="facebook button-wrap">Facebook</li>
    <li class="twitter button-wrap">Tweet</li>
    <li class="digg button-wrap">Digg it</li>
    <li class="stumbleupon button-wrap">Stumbleupon</li>
    <li class="delicious button-wrap">Delicious</li>
    <li class="gplus button-wrap">Google Share</li>
    <li class="email button-wrap">Email</li>
</ul>
