var cssObj = { 'box-shadow' : '#888 5px 10px 10px', // Added when CSS3 is standard
                '-webkit-box-shadow' : '#888 5px 10px 10px', // Safari
                '-moz-box-shadow' : '#888 5px 10px 10px'}; // Firefox 3.5+
	$("#suggestions").css(cssObj);
	
	 $("input").blur(function(){
	 	$('#suggestions').fadeOut(2000);
	 });

function lookup(inputString) {
	if(inputString.length == 0) {
		$('#suggestions').fadeOut(); 
	} else {
		$.post("?r=site/searchLiveAnswer", {queryString: ""+inputString+""}, function(data) { 
			$('#suggestions').fadeIn(); 
			$('#suggestions').addClass('bg');
			$('#suggestions').html(data); 
		});
	}
}	
$("#inputString").keypress(function(e) {
	if (e.which == 13) {
		return false;
	}
});