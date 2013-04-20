function ajaxPost(url, data, callback) {
	$.ajax({
		type: 'POST',
		url: baseURL + url,
		data: data,
		success: callback
	});
}

function test() {
	console.log("Call back");
}
$(document).ready(function() {
	$('#star').raty({
		path: baseURL + '/js/img/',
		number: 12,	
		hints: ['Worst fucking movie, like, evah!', 'Worst', 'Terrible', 'Really bad', 'Bad', 'OK', 'Good', 'Really good', 'Great', 'Awesome', 'I want to have this movies babies', 'Lifechaning, out of body experience'],
		target: '#rating-hint',
		targetKeep: true,
		width: false,
		click: function(rating) {
			ajaxPost('movies/rate', {id: $(this).parent().attr("id"), rating: rating });
		},
		score: function() {
			return $(this).attr('data-score');
		}
	});

	$('#drop_rating').bind("click", function() {
		var callback =  function() {
			console.log('cool beans');
			$('#star').raty('score', 0);
			$('#rating-hint').html('');
		};	
		ajaxPost('movies/drop', {id: $(this).parent().attr("id")}, callback); 
	});	
	
	$('.membership').bind("click", function() {
		var id = $(this).attr("id");
		var callback =  function() {
			console.log('cool beans');
			console.log(id);
			$('.membership#' + id ).html('<span class="feedback"> Request sent</span>');
		};	
		ajaxPost('groups/requestMembership', {group_id: id}, callback); 
	});
	
	$("[class^='user_']").bind("click", function() {
		var userClass = $(this).attr("class");
		var userId = parseInt(userClass.split('_')[1]);
		var groupId = $(this).parents('.group').attr("id");
		var callback =  function() {
			console.log('cool beans');
			console.log($('.' + userClass, '.group#' + groupId).html('<span class="feedback"> User added</span>'));
		};	
		ajaxPost('groups/addUser', {group_id: groupId, user_id: userId}, callback); 
	});
});
