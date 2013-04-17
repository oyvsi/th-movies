function sendRating(rating) {
	var id = $('.rating').attr('id');
	//console.log("This is where we get our ajax on. Vars in: " + rating + 'on movie: ' + id);

	$.ajax({
		type: 'POST',
		url: baseURL + 'movies/rate',
		data: { movie_id: id, rating: rating },
	}).done(function(result) {
		console.log('good ajax gave us:' + result);
		
	});
}

$(document).ready(function() {
	$('#star').raty({
		path: baseURL + '/js/img/',
		number: 12,	
		hints: ['Worst fucking movie, like, evah!', 'Worst', 'Terrible', 'Really bad', 'Bad', 'OK', 'Good', 'Really good', 'Great', 'Awesome', 'I want to have this movies babies', 'Lifechaning, out of body experience'],
		target: '#rating-hint',
		targetKeep: true,
		width: false,
		click: sendRating,
		score: function() {
		     return $(this).attr('data-score');
		}
	});
});
