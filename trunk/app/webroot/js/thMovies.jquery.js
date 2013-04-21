function ajaxPost(url, data, callback, base) {
	if(base === false)
		 baseURL = '';
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
		hints: ['Worst fucking movie, like, evah!', 'Worst', 'Terrible', 'Really bad', 'Bad', 'OK', 'Good', 'Really good', 'Great', 'Awesome', 'I want to have this movies\' babies', 'Lifechaning, out of body experience'],
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

	$('#AddTag input').focus(function() {
		$(this).val('');	
	});
	
	$('#AddTag input').focusout(function() {
		$(this).val('Add tag...');	
		});
	$( "#AddTag #tag" ).autocomplete({
		source: baseURL + "Tags/find/" + $('.rating').attr('id'),
		minLength: 2,
		select: function( event, ui ) {
//			"Selected: " + ui.item.value + " aka " + ui.item.id :
//			"Nothing selected, input was " + this.value );
		}
});
$("#AddTag").submit(function() {
		var tag = $(this).find('#tag').val();
		var movie = $('.rating').attr('id');
		var action = $(this).attr('action');
		var callback = function() {
		$('#tags').append(' <span class="tag"><a href="' + baseURL + 'Tags/findMovies/' + tag + '">' + tag + '</a> |</span>');
		$('#AddTag #tag').blur();
		};
		ajaxPost(action, {id: movie, tag: tag}, callback, false);

		return false;	
		});

});
