/*
	The navigation code for navigating our coded site - "plugin".

	To make the script compatible with your server:

	1. change the variable "baseUrl" to your needs.
	2. change the variable "urlEnd". The array "drawers" should be the
	two last "variables" in the url. ie. xxx/xxx/xxx/"urlPart[4]"/"urlPart[5]"/.
	3. the function ajaxIndex needs to be changed incase length of the actual
	url changes.
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
//function that goes through an element to find all ids,
//(li elements in particular) to recursively "deselect" the tabs.
function defineTabs(div) {
	if(div.nodeType) {
		//get how many tabs there are in the sidetabs.
		var idLength = div.id.length;
		var liAmount = div.id.slice(idLength-1, idLength);
		//get the genre name of the id.
		var idGenre = div.id.slice(0, - 1)

		for(var i = 1; i <= liAmount; i++) {
			tabSelect(idGenre+i, '#003d4c', 'white');
		}
	} 
}

function tabSelect(div, bgcolor, text) {
	var header = document.getElementById(div);
	if(bgcolor == null && text == null) {
		bgcolor = 'white';
		text = '#003d4c';
	}
	if(header) {
		header.style.backgroundColor = bgcolor;
		header.style.color = text;
	}
}

//ensures page is properly loaded.
$(document).ready(function() {
	var baseUrl = "/th-movies";

//ensuring that the selected tab is colored nicely
	var urlInfo = document.URL;
	var urlParts = urlInfo.split('/');
	var urlEnd = urlParts[4]+urlParts[5];


	switch(urlEnd) {

		case 'undefined':
			tabSelect('homepage');
			break;
		case 'movies':
			tabSelect('moviepage');
			break;
		//this makes the maintab selected even when a movie 
		//with another url-ending is "loaded".
		case 'moviesmovie':
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

function mouseOnmouseOff(state, div) {
	var bgcolor = (state ? 'gray' : '#003d4c');

	if(div != 'currentuser') {
		var header = document.getElementById(div);

		//checks if the "header" background was white
		if(header.style.backgroundColor != 'white') {
			header.style.backgroundColor = bgcolor;
		}
	}	

}

//action for when the id "sidetabs" and its "li" element is mouseovered
	$('#sidetabs li').mouseover(function() {
		var div = $(this).attr('id');
		mouseOnmouseOff(true, div);
	});
//and mouseOUTED
	$('#sidetabs li').mouseout(function() {
		var div = $(this).attr('id');
		mouseOnmouseOff(false, div);
	});


//action for when the id "home" is clicked
	$('#homepage').click(function(e) {
		window.location = baseUrl+'/';
	});

//action for when the id "moviespage" is clicked
	$('#moviepage').click(function(e) {
		window.location = baseUrl+'/movies/';
	});

function ratedInfoPage() {
	var callBack = function(data) {
		$('#movieInfo').html(data);
	}
	ajaxPost(baseUrl+'/users/ratedInfo/', callBack);
}

/*
This is a function that ensures two things:
	1. The div "currentuser" loads the page index.
	2. Fixes a "bug" that appears When inoformation about a specific movie
	is loaded and the url changes.
*/
function sideTabIndex() {
	if(document.getElementById('movieInfo') && urlParts.length == 6) {
		ratedInfoPage();
	};
		$('#currentuser').click(function(e) {
		//get the li elements within current document
		var liIds = document.getElementsByTagName("li");
		//send the last element in array, as it tells what tabs (div id) to select.
		defineTabs(liIds[liIds.length-1]);
		ratedInfoPage();
	});
}

sideTabIndex();

//action for when the id "movies1" is clicked
	$('#movies1').click(function(e) {

		var callBack = function(data) {
			tabSelect('movies3', '#003d4c', 'white');
			tabSelect('movies2', '#003d4c', 'white');
			tabSelect('movies1');
			$('#movieInfo').html(data);
		}
		ajaxPost(baseUrl+'/movies/top/', callBack);
	});

//action for when the id "movies2" is clicked
	$('#movies2').click(function(e) {

		var callBack = function(data) {
			tabSelect('movies3', '#003d4c', 'white');
			tabSelect('movies1', '#003d4c', 'white');
			tabSelect('movies2');
			$('#movieInfo').html(data);
		}
		ajaxPost(baseUrl+'/movies/latestMovies/', callBack);
	});
//action for when the id "movies3" is clicked
	$('#movies3').click(function(e) {

		var callBack = function(data) {
			tabSelect('movies2', '#003d4c', 'white');
			tabSelect('movies1', '#003d4c', 'white');
			tabSelect('movies3');
			$('#movieInfo').html(data);
		}
		ajaxPost(baseUrl+'/movies/rated/', callBack);
	});
//action for when the id "userpage" is clicked

	$('#userpage').click(function(e) {
		window.location = baseUrl+'/users/';
	});
	//action for when the id "user1" is clicked
	$('#user1').click(function(e) {

		var callBack = function(data) {
			tabSelect('user2', '#003d4c', 'white');
			tabSelect('user1');
			$('#profilepage').html(data);
		}
		ajaxPost('profileInfo/', callBack);
	});
	//action for when the id "user2" is clicked
	$('#user2').click(function(e) {

		var callBack = function(data) {
			tabSelect('user1', '#003d4c', 'white');
			tabSelect('user2');
			$('#profilepage').html(data);
		}
		ajaxPost('groupsInfo/', callBack);
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