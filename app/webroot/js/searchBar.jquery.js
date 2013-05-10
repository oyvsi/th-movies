$(document).ready(function() {
	var apikey = "a8049ffed9e54f709cc42647f7a42722";
	var baseUrl = "http://api.themoviedb.org/3/search/";
	var moviesSearchUrl = baseUrl + 'movie?api_key=' + apikey;
	var lastSearchValue = '';
	var $prev, $next, $current;
	var timeOut = 400;
	var timer = null;

	function searchCallBack(data) {
      $("#movies").empty();
	  console.log(data);
	  
      $.each(data.results, function(index, movie) {
				var output = '<li class="search_item" id="' + movie.id + '"><span id="title">' + movie.original_title + ' (' + movie.release_date + ')</span><span id="thumb"><img src="http://d3gtl9l2a4fn1j.cloudfront.net/t/p/w92' + movie.poster_path + '" /></thumb></li>';
				$("#movies").append(output);
				if(index == 4) {
					$("#movies").append('<li class="search_item" id="moremovies">More movies! (Arrow down or click) </li>');
				}
				$('#movies li:gt(5)').hide();
				if(index == 9) {
					return false;
				}
		});
	}

	function ajaxCall(url, controller, action, searchString, callBack) {
          $.ajax({
                    type: 'GET',
                        url: url + controller + action,
                        data: { search: searchString },
						dataType: "json",
                        success: callBack
           });
	}


//clears searchbox and its dropdownlist.
	function clearSearch() {
		$('#searchBox').val('');
		$('#movies').html('');
	}

//calls clearsearch function if anything but the searchbox or "moremovies" (title)
//is clicked
	$(document).click(function(e) {
		var ele = document.elementFromPoint(e.clientX, e.clientY);
		var id = ele.id;

		if(id == 'searchBox' || id == 'title') {
			console.log('do nothing');
		} else {
			clearSearch();
		}
	});
//calls clearsearch if esc is clicked
	$(document).keyup(function(event) {
		if (event.keyCode === 27) {
			clearSearch();
		}
	});


	$('#searchBox').keyup(function(event){
		var inputRegEx = new RegExp("^[a-zA-Z0-9]+$");  
		var allowedKeys = new Array(27, 40, 8);
		$prev, $next, $current = $("#movies li.selected");

		if(inputRegEx.test(String.fromCharCode(event.which)) || ($.inArray(event.keyCode, allowedKeys>-1))) {
			if(event.keyCode === 13) {
				 if ($current.length) {
					document.location = baseURL + 'movies/movie/' + $current.attr('id');
					//console.log($current.attr('id'));
					} 
			} else if (event.keyCode === 40) {
				if(!$current.length) $("#movies li:first").addClass("selected");
				if ($current.attr('id') == 'moremovies') {
						$next = $('li[id*=moremovies]').next();
						$('#movies li:gt(4)').show();
						$('li[id*=moremovies]').remove();
						$next.addClass('selected');
				}
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
					clearTimeout(timer);
					timer = setTimeout(function() {
							ajaxCall(baseURL, "movies/", "searchMovies", searchValue, searchCallBack);
					}, timeOut);
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

//makes it so that you can mouseclick "more movies"
	$('#movies').delegate('li', 'click', function() {
		if (this.id != 'moremovies') {
			document.location = baseURL + 'movies/movie/' + this.id;
		} else {
			$next = $('li[id*=moremovies]').next();
			$('#movies li:gt(4)').show();
			$('li[id*=moremovies]').remove();
			$next.addClass('selected');
		}
	});
});


