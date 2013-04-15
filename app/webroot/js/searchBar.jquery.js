$(document).ready(function() {

	var apikey = "bvswh94ct9uug45678ncjk9v";
	var baseUrl = "http://api.rottentomatoes.com/api/public/v1.0";
	var moviesSearchUrl = baseUrl + '/movies.json?apikey=' + apikey;
	var lastSearchValue = '';
	
	function searchCallback(data) {
      $("#movies").empty();
      $.each(data.movies, function(index, movie) {
			if(movie.ratings.critics_score > 1) {
				var output = '<li class="search_item" id="' + movie.id + '"><span id="title">' + movie.title + ' (' + movie.year + ') CR: ' + movie.ratings.critics_score + ' AR: ' + movie.ratings.audience_score + '</span><span id="thumb"><img src="' + movie.posters.thumbnail + '" /></thumb></li>';
				$("#movies").append(output);
			}
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
		var $prev, $next, $current = $("#movies li.selected");		
		if(inputRegEx.test(String.fromCharCode(event.which)) || ($.inArray(event.keyCode, allowedKeys>-1))) {
			if(event.keyCode === 13) {
				if($current.length) {
					document.location = 'movie/' + $current.attr('id');
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


