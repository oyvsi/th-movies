$(document).ready(function() {
	$('#sidebar a').click(function(e) {
		/* get the url information and split it up */
		var urlInfo = $(this).attr('href');
		var urlParts = urlInfo.split('#');
	
		/* create a string for load to use */
		var loadText = urlParts[0]+' #'+urlParts[1];
	
		/*set up the load*/
		$('#content').load(loadText);
		e.preventDefault();
	});
});