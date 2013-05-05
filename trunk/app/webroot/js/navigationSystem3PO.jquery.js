/*
	The navigation code for navigating our coded site - plugin.
*/

function ajaxPost(url, callback, data) {

	$.ajax({
		type: 'POST',
		url: url,
		data: data,
		dataType: 'html',
		success: callback
	});
}


//ensures page is properly loaded.
$(document).ready(function() {

//action for when the id "about1" is clicked
	$('#about1').click(function(e) {

		var callBack = function(data) {
			console.log(data);
			$('#information').html(data);
		}
		ajaxPost('abouts/about', callBack, {choice: 'PK'});
	});
//action for when the id "about2" is clicked
	$('#about2').click(function(e) {

		var callBack = function(data) {
			console.log(data);
			$('#information').html(data);
		}
		ajaxPost('abouts/about', callBack, {choice: 'flash'});
	});
//action for when the id "about3" is clicked
	$('#about3').click(function(e) {

		var callBack = function(data) {
			console.log(data);
			$('#information').html(data);
		}
		ajaxPost('abouts/about', callBack, {choice: 'bundy'});
	});
//action for when the id "about4" is clicked
	$('#about4').click(function(e) {

		var callBack = function(data) {
			console.log(data);
			$('#information').html(data);
		}
		ajaxPost('abouts/about', callBack, {choice: 'laff'});
	});

//action for when the id "user1" is clicked
	$('#user1').click(function(e) {

		var callBack = function(data) {
			console.log(data);
			$('#profile').html(data);
		}
		ajaxPost('users/profileInfo', callBack);
	});
//action for when the id "user2" is clicked
	$('#user2').click(function(e) {

		var callBack = function(data) {
			console.log(data);
			$('#profile').html(data);
		}
		ajaxPost('users/groupsInfo', callBack);
	});
//action for when the id "about4" is clicked
	$('#user3').click(function(e) {

		var callBack = function(data) {
			console.log(data);
			$('#profile').html(data);
		}
		ajaxPost('users/ratedInfo', callBack);
	});









});


/*
function ajaxCall(controller, action, searchString, callBack) {
         $.ajax({
                   type: 'GET',
                    url: controller + action,
                    data: { search: searchString },
					dataType: "html",
                    success: callBack
           });
	}

$(document).ready(function() {
	$('#sidebar a').click(function(e) {
		var urlInfo = $(this).attr('href');
		var urlParts = urlInfo.split('#');
		var searchCallBack = function(data) {
			console.log(data);
			$('#'+urlParts[3]).html(data);
		}
		ajaxCall(urlParts[0], urlParts[1], urlParts[2], searchCallBack);
		e.preventDefault();
	});
});
*/