$(document).ready(function() {
	$('#star').raty({
		number: 12,	
		hints: ['Worst fucking movie, like, evah!', 'Worst', 'Terrible', 'Really bad', 'Bad', 'OK', 'Good', 'Really good', 'Great', 'Awesome', 'I want to have this movies babies', 'Lifechaning, out of body experience'],
		target: '#rating-hint',
		width: false,
	});
});
