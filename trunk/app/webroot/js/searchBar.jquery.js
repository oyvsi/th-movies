$(document).ready(function() {

	var apikey = "a8049ffed9e54f709cc42647f7a42722";
	var baseUrl = "http://api.themoviedb.org/3/search/";
	var moviesSearchUrl = baseUrl + 'movie?api_key=' + apikey;
	var lastSearchValue = '';
	
	function searchCallback(data) {
      $("#movies").empty();
      $.each(data.results, function(index, movie) {
				var output = '<li class="search_item" id="' + movie.id + '"><span id="title">' + movie.original_title + ' (' + movie.release_date + ')</span><span id="thumb"><img src="http://d3gtl9l2a4fn1j.cloudfront.net/t/p/w92' + movie.poster_path + '" /></thumb></li>';
				$("#movies").append(output);
		});
	}

	function ajaxCall(searchValue) {
        $.ajax({
        url: moviesSearchUrl + '&query=' + encodeURI(searchValue),
        dataType: "jsonp",
        success: searchCallback
        });
	}

	$('#searchBox').keyup(function(event){
		var inputRegEx = new RegExp("^[a-zA-Z0-9]+$");  
		var allowedKeys = new Array(27, 40, 8);
		var $prev, $next, $current = $("#movies li.selected");		
		if(inputRegEx.test(String.fromCharCode(event.which)) || ($.inArray(event.keyCode, allowedKeys>-1))) {
			if(event.keyCode === 13) {
				if($current.length) {
					document.location = '/www-tek/th-movies/movies/' + $current.attr('id');
					//console.log($current.attr('id'));
				}
			} else if (event.keyCode === 40) {
				if(!$current.length) $("#movies li:first").addClass("selected");
				$next = $current.next("li");
				if ($next.length) {
					$current.removeClass("selected");
					$next.addClass("selected");
				}
			} else if (event.keyCode === 38) {
				$prev = $current.prev("li");
				if ($prev.length) {
					$current.removeClass("selected");
					$prev.addClass("selected");
				}
			}
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

$('#movies').delegate('li', 'click', function() {
		document.location = '/www-tek/th-movies/movies/' + this.id;
});
});


