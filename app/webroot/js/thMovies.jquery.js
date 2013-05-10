function ajaxPost(url, data, callback, base) {
	var ajaxURL = (base == false ? url : baseURL + url);
	$.ajax({
		type: 'POST',
		url: ajaxURL,
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
			ajaxPost('movies/rate/', {id: $(this).parent().attr("id"), rating: rating });
		},
		score: function() {
			return $(this).attr('data-score');
		}
	});

	$('#drop_rating').bind("click", function() {
		var callback =  function() {
			$('#star').raty('score', 0);
			$('#rating-hint').html('');
		};	
		ajaxPost('movies/drop/', {id: $(this).parent().attr("id")}, callback); 
	});	

// this code is moved into navigationsystem since it needs to be loaded
// after its page/wrapper is loaded.
/*
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
			$('.' + userClass, '.group#' + groupId).html('<span class="feedback"> User added</span>');

		};	
		ajaxPost('groups/addUser', {group_id: groupId, user_id: userId}, callback); 
	});
*/	
	$('#AddTag #tag').focus(function() {
		$(this).val('');	
	});
	
	$('#AddTag #tag').focusout(function() {
		$(this).val(this.getAttribute('value'));	
	});
	$("#AddTag #tag" ).autocomplete({
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
		
		
$(document).on('keydown', 'input.groupName', function(event) {
		if(event.keyCode == 27) {
			$('#newGroupWrapper').replaceWith("<input type='submit' id='newGroup'  value='New Group'/>");
		}
			
		if(event.keyCode == 13) {
			$('.submitGroup').click();
		}
			
});



$(document).on("click", 'input#newGroup', function() {
		var html = $(this).html();
		$(this).replaceWith("<div id='newGroupWrapper'> <input class='groupName' type='text' value='Group name...'> <input class='submitGroup' type='submit'></div>");
		$('input.groupName').focus();
	
});

//clears value when anything is balls
$(document).on('keydown', 'input.groupName', function(event) {
	if(event.keyCode) {
		if(this.value == 'Group name...') {
			this.value = '';
		}
	}
});

$(document).on("click", '.submitGroup', function() {
		var groupName = $('.groupName').val();
		var callback = function(data) {
			var dataArr = data.split('/');
			//using function from navigationsystem. FUck cakephp, hello ajax

			var callBack = function(data) {
				groupInfoPage();
			}
			l_ajaxPost(baseURL+'groups/addUser', callBack, {group_id: dataArr[0], user_id: dataArr[1], pending: 0}); 
		};
		if(groupName.length > 3) {
			ajaxPost('groups/createGroup', {groupName: groupName}, callback, true);
		} else {
			$('#newGroupWrapper').append("<p class='error'> The name must be longer then 3 chars </p>");
		}
			
});	

	
});



