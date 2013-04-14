var apikey = "bvswh94ct9uug45678ncjk9v";
var baseUrl = "http://api.rottentomatoes.com/api/public/v1.0";
var moviesSearchUrl = baseUrl + '/movies.json?apikey=' + apikey;

$(document).ready(function() {

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
        var searchValue = $(this).val();
        if(searchValue.length > 3) {
                ajaxCall(searchValue);
        } else {
                $("#movies").empty();
                $("#movies").append("SEARCH YOU FOOL");
        }

});
});

