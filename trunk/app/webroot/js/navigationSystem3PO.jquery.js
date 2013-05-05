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

function tabSelect(div, bgcolor, text) {
		if(bgcolor == null && text == null) {
			bgcolor = 'white';
			text = '#003d4c';
		}
		var header = document.getElementById(div);
		header.style.backgroundColor = bgcolor;
		header.style.color = text;
}

//ensures page is properly loaded.
$(document).ready(function() {
	var baseUrl = "/th-movies";

	//ensuring that the selected tab is colored nicely
	var urlInfo = document.URL;
	var urlParts = urlInfo.split('/');
	console.log(urlParts[4]+urlParts[5]);

	switch(urlParts[4]+urlParts[5]) {

		case 'pageshome':
			tabSelect('homepage');
			break;
		case 'moviesrated':
			tabSelect('moviepage');
			break;
		case 'users':
			tabSelect('userpage');
			break;
		case 'groups':
			tabSelect('grouppage');
			break;
		case 'abouts':
			tabSelect('aboutpage');
			break;
	}

	//action for when the id "home" is clicked
	$('#homepage').click(function(e) {
		window.location = baseUrl+'/pages/home/';
	});

	//action for when the id "moviespage" is clicked
	$('#moviepage').click(function(e) {
		window.location = baseUrl+'/movies/rated/';
	});

//action for when the id "sidetabs" and its "li" element is mouseovered

	$('#sidetabs li').mouseover(function() {
		var div = $(this).attr('id');
		var header = document.getElementById(div);

		//checks if the header already was white
		if(header.style.backgroundColor != 'white') {
			header.style.backgroundColor = 'grey';
		}
	});
//and mouseOUTED
	$('#sidetabs li').mouseout(function() {
		var div = $(this).attr('id');
		var header = document.getElementById(div);

		//checks if the header was clicked (white)
		if(header.style.backgroundColor != 'white') {
			header.style.backgroundColor = '#003d4c';
		}
	});

//action for when the id "userpage" is clicked

	$('#userpage').click(function(e) {
		window.location = baseUrl+'/users/';
	});
//action for when the id "user1" is clicked
	$('#user1').click(function(e) {

		var callBack = function(data) {
			tabSelect('user2', '#003d4c', 'white');
			tabSelect('user3', '#003d4c', 'white');
			tabSelect('user1');
			$('#profile').html(data);
		}
		ajaxPost('profileInfo/', callBack);
	});
//action for when the id "user2" is clicked
	$('#user2').click(function(e) {

		var callBack = function(data) {
			tabSelect('user1', '#003d4c', 'white');
			tabSelect('user3', '#003d4c', 'white');
			tabSelect('user2');
			$('#profile').html(data);
		}
		ajaxPost('groupsInfo/', callBack);
	});
//action for when the id "about4" is clicked
	$('#user3').click(function(e) {

		var callBack = function(data) {
			tabSelect('user1', '#003d4c', 'white');
			tabSelect('user2', '#003d4c', 'white');
			tabSelect('user3');
			$('#profile').html(data);
		}
		ajaxPost('ratedInfo/', callBack);
	});


	//action for when the id "moviespage" is clicked
	$('#grouppage').click(function(e) {
		window.location = baseUrl+'/groups/';
	});


	//action for when the id "aboutpage" is clicked
	$('#aboutpage').click(function(e) {
		window.location = baseUrl+'/abouts/';

	});

//action for when the id "about1" is clicked
	$('#about1').click(function(e) {

		var callBack = function(data) {
			tabSelect('about2', '#003d4c', 'white');
			tabSelect('about3', '#003d4c', 'white');
			tabSelect('about4', '#003d4c', 'white');
			tabSelect('about1');
			$('#information').html(data);
		}
		ajaxPost('about/', callBack, {choice: 'PK'});
	});
//action for when the id "about2" is clicked
	$('#about2').click(function(e) {

		var callBack = function(data) {
			tabSelect('about1', '#003d4c', 'white');
			tabSelect('about3', '#003d4c', 'white');
			tabSelect('about4', '#003d4c', 'white');
			tabSelect('about2');
			$('#information').html(data);
		}
		ajaxPost('about/', callBack, {choice: 'flash'});
	});
//action for when the id "about3" is clicked
	$('#about3').click(function(e) {

		var callBack = function(data) {
			tabSelect('about1', '#003d4c', 'white');
			tabSelect('about2', '#003d4c', 'white');
			tabSelect('about4', '#003d4c', 'white');
			tabSelect('about3');
			$('#information').html(data);
		}
		ajaxPost('about/', callBack, {choice: 'bundy'});
	});
//action for when the id "about4" is clicked
	$('#about4').click(function(e) {

		var callBack = function(data) {
			tabSelect('about1', '#003d4c', 'white');
			tabSelect('about2', '#003d4c', 'white');
			tabSelect('about3', '#003d4c', 'white');
			tabSelect('about4');
			$('#information').html(data);
		}
		ajaxPost('about/', callBack, {choice: 'laff'});
	});


	//action for when the id "moviespage" is clicked
	$('#logoutpage').click(function(e) {
		window.location = baseUrl+'/users/logout/';
	});

	//action for when the id "moviespage" is clicked
	$('#loginpage').click(function(e) {
		window.location = baseUrl+'/users/login/';
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