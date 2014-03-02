// JavaScript Document
$(document).ready(function(){
	$("#slideit").click(function(){
		$("#top2").slideDown("slow");
	
	});	
	$("#closeit").click(function(){
		$("#top2").slideUp("slow");	
		
	});
	$("#toggle a").click(function () {
		$("#toggle a").toggle();
	});		
});

$(document).ready(function(){
	$("#slide").click(function(){
		$("#top3").slideDown("slow");
	
	});	
	$("#close").click(function(){
		$("#top3").slideUp("slow");	
	});
	$("#toggleit a").click(function () {
		$("#toggleit a").toggle();
	});		
});

