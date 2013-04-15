$(document).ready(function() {
	var apikey = "bvswh94ct9uug45678ncjk9v";
	var baseUrl = "http://api.rottentomatoes.com/api/public/v1.0";
	var moviesSearchUrl = baseUrl + '/movies.json?apikey=' + apikey;
	var lastSearchValue = '';
	
	function searchCallback(data) {
		$("#movies").empty();	
		$.each(data.movies, function(index, movie) {
			if(movie.ratings.critics_score > 1) {
				var output = '<div style="width: 300px; border-style: solid; border-width:1px" id="hit" <li>' + movie.title + ' CR: ' + movie.ratings.critics_score + ' AR: ' + movie.ratings.audience_score + '</li>';
			} 
			$("#movies").append(output);
		});
	}

	function ajaxCall(searchValue) {
		$.ajax({
			url: moviesSearchUrl + '&q=' + encodeURI(searchValue) + '&page_limit=20',
			dataType: "jsonp",
			success: searchCallback
		});
	}

	$('#searchBox').keyup(function(event){
		var inputRegEx = new RegExp("^[a-zA-Z0-9]+$");  
		var allowedKeys = new Array(27, 40, 8);
		if(inputRegEx.test(String.fromCharCode(event.which)) || ($.inArray(event.keyCode, allowedKeys>-1))) {
			var searchValue = $(this).val();
			if(searchValue.length > 3) {
				if(searchValue != lastSearchValue) {
					ajaxCall(searchValue);
				}
				lastSearchValue = searchValue;
			} else {
				$("#movies").empty();
				$("#movies").append("SEARCH YOU FOOL");
			}
		} else {
			$("#movies").append("No alphanumeric ova here");
		}
	});
});


