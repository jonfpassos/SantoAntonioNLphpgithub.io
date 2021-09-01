$(document).ready(function() {
	$("#visited").show();
	$("#liked").hide();
	$("#show2").css({"opacity":"0.5"});

	$( "#show1" ).click(function() {
	  $("#visited").show();
	  $("#liked").hide();
	  $("#show2").css({"opacity":"0.5"});
	  $("#show1").css({"opacity":"1"});
	});

	$( "#show2" ).click(function() {
	  $("#visited").hide();
	  $("#liked").show();
	  $("#show1").css({"opacity":"0.5"});
	  $("#show2").css({"opacity":"1"});
	});

	$("#moneydonation").mask("#.##0,00", {reverse: true});
});