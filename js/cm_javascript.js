//Search Field
function searchInput(text){
	$(document).ready(function(){
		$("#input_search").val(text).css({"color":"#999"});
			$("#input_search").one("focus",function(){
				$(this).val("").css({"color":"#5a5a5a"});
			});
		$("div.header form label").hide();
	});
};

//Subscribe via Email Field
function emailInput(text){
	$(document).ready(function(){
		$("#input_subscribe").val(text).css({"color":"#999"});
		$("#input_subscribe").one("focus",function(){
			$(this).val("").css({"color":"#5a5a5a"});
		});
	});
};

$(document).ready(function(){
	
	//drop down menus
	$('.menu ul').superfish({
		dropShadows: false
	}); 

	//rounded corners on feature
	$('.feature').corner({
		tl: { radius: 10 },
		tr: { radius: 10 },
		bl: false,
		br: false,
		antiAlias: true,
		autoPad: true,
		validTags: ["div"] });
	$('.widget_welcome').corner({
		tr: { radius: 10 },
		tl: { radius: 10 },
		br: false,
		bl: false,
		antiAlias: true,
		autoPad: true,
		validTags: ["div"] });
		
	//widget highlights
	var originalBG = $(".widget ul li").css("background-color"); 
	var fadeColor = "#ddd"; 
	
	$(".widget ul li").hover( function () { 
		$(this).animate( { backgroundColor:fadeColor}, 450 ) 
		.animate( {backgroundColor:"#fff"}, 950 )
	},
	function () {}
	);
	
	//Hide RSS Options
	$(".rssoptions").hide();
	$(".rss a").click( function (){
		$(".rssoptions").slideToggle('fast');
		return false;
	});
	
	//Hide Trackbacks
	$("#trackbacks").hide();
	$("a.show_trackbacks").click( function (){
		$("#trackbacks").slideToggle('fast');
		return false;
	});
	
});
