/*
	The navigation code for navigating our coded site - "plugin".

	To make the script compatible with your server:

	1. change the variable "baseUrl" to your needs.
	2. change the variable "urlEnd". The array "drawers" should be the
	two last "variables" in the url. ie. xxx/xxx/xxx/"urlPart[4]"/"urlPart[5]"/.
		- urlEnd can be edited in other ways, but currently this works on my local machine - laffedr8.
	3. the function ajaxIndex needs to be changed incase length of the actual
	url changes.
*/
//MÅ ENDRES FOR Å TILPASSE SEG ULIKE URL-OPPSETT:
var urlLength = 8;

function l_ajaxPost(url, callback, data) {

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
	console.log(header);
	if(header) {
		header.style.backgroundColor = bgcolor;
		header.style.color = text;
	} else {
		console.log("fuck all");
	}
}

//ensures page is properly loaded.
$(document).ready(function() {

//ensuring that the selected tab is colored nicely
	var urlInfo = document.URL;
	var urlParts = urlInfo.split('/');
	var urlEnd = urlParts[urlParts.length-1];//+urlParts[urlParts.length-1];
	//console.log(urlEnd);
	if(urlParts[urlParts.length - 3] == 'movies' || urlParts[urlParts.length - 3] == 'Tags') {
		tabSelect('homepage');
	} else {		
		switch(urlEnd) {
			case 'users': 
				tabSelect('userpage');
				tabSelect('user2');
				break;
			case 'profileInfo':
				tabSelect('userpage');
				tabSelect('user2');
				break;
			//same as the "moviesmovie"-case, as edit is not
			//loaded with ajax, selection of its tab must be done 
			//this way.
			case 'edit':
				tabSelect('userpage');
				tabSelect('user2', '#003d4c', 'white');
				tabSelect('user1');
				break;
			case 'groups':
				tabSelect('grouppage');
				tabSelect('groups3');
				break;
			case 'abouts':
				tabSelect('aboutpage');
				break;
			default:
				tabSelect('homepage');
				break;
		}
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
		window.location = baseURL;
	});

//action for when the id "moviespage" is clicked
	$('#moviepage').click(function(e) {
		window.location = baseURL+'movies';
	});
//function used as an index for the movie page.
function ratedInfoPage() {
	var callBack = function(data) {
		$('#frontpage').html(data);
	}
	l_ajaxPost(baseURL+'users/ratedInfo', callBack);
}
//function used as an index for the profile page.
function profileInfoPage() {
	var callBack = function(data) {
		$('#profileInfo').html(data);
	}
	l_ajaxPost(baseURL+'users/profileInfo', callBack);
}

//this function ensures not only that the page loads (as the once above).
//but also makes sure that the li elements loaded are clickable. (grouplistli).
//It also makes the membership class clickable for requestmembership.
function groupInfoPage() {
	var callBack = function(data) {
		$('#groupsInfo').html(data);
		groupListLi();
		//////////////////////////7
		$('.membership').bind("click", function() {
			var id = $(this).attr("id");
			var callback2 =  function() {
				//console.log('cool beans');
				//console.log(id);
				var message = document.getElementsByClassName('membership');
				$(message).html('<span class="feedback"> Request sent</span>');
			};	
			l_ajaxPost(baseURL+'groups/requestMembership', callback2, {group_id: id}); 
		});
		//////////////////////////////
	}
	l_ajaxPost(baseURL+'groups/listGroups', callBack);
}

//function that
function groupListLi() {
	//when the li elements are clicked.
	$('#grouplist li').click(function(e) {
		//get id of the element clicked.
		var groupId = this.id;

		var callBack = function(data) {
			$('#groupsInfo').html(data);
			e.preventDefault();
		}
		l_ajaxPost(baseURL+'groups/listGroup/'+groupId, callBack);
	});
}

/*
This is a function that ensures two things:
	1. The div "currentuser" loads the page index.
	2. Fixes a "bug" that appears When inoformation about a specific movie
	is loaded and the url changes.
*/
function sideTabIndex() {
	//console.log(urlParts.length);
	if(document.getElementById('frontpage') && urlParts.length == urlLength) {
	//	console.log("hello");
		ratedInfoPage();
	};
	if(document.getElementById('profileInfo') && urlParts.length == urlLength - 1) {
		profileInfoPage();
	};
	if(document.getElementById('groupsInfo') ){//&& urlParts.length == 6) {
		groupInfoPage();
	};

	$('#currentuser').click(function(e) {
	//get the li elements within current document
	var liIds = document.getElementsByTagName("li");
	//send the last element in array, as it tells what tabs (div id) to select.
	defineTabs(liIds[liIds.length-1]);

//	if(urlParts[urlParts - 3] == 'movies'){
//		ratedInfoPage();
//	} else {
	switch(urlParts[urlParts.length-1]) {
		/*case 'movies':
			ratedInfoPage();
			break;*/
		case 'users': case 'edit':
			//profileInfoPage();
			break;
		case 'groups':
			//groupInfoPage();
			break;
		case 'abouts':
			window.location = baseURL+'abouts';
			break;
		default:
			ratedInfoPage();
			break;
	}
//	}
	//ratedInfoPage();
	});
}

sideTabIndex();

//action for when the id "movies1" is clicked
	$('#movies1').click(function(e) {

		var callBack = function(data) {
			tabSelect('movies3', '#003d4c', 'white');
			tabSelect('movies2', '#003d4c', 'white');
			tabSelect('movies4', '#003d4c', 'white');
			tabSelect('movies1');
			$('#frontpage').html(data);
		}
		l_ajaxPost(baseURL+'movies/top', callBack);
	});

//action for when the id "movies2" is clicked
	$('#movies2').click(function(e) {

		var callBack = function(data) {
			tabSelect('movies3', '#003d4c', 'white');
			tabSelect('movies1', '#003d4c', 'white');
			tabSelect('movies4', '#003d4c', 'white');
			tabSelect('movies2');
			$('#frontpage').html(data);
		}
		l_ajaxPost(baseURL+'movies/latestMovies', callBack);
	});
//action for when the id "movies3" is clicked
	$('#movies3').click(function(e) {

		var callBack = function(data) {
			tabSelect('movies2', '#003d4c', 'white');
			tabSelect('movies1', '#003d4c', 'white');
			tabSelect('movies4', '#003d4c', 'white');
			tabSelect('movies3');
			$('#frontpage').html(data);
		}
		l_ajaxPost(baseURL+'movies/rated', callBack);
	});
	
	$('#movies4').click(function(e) {
		tabSelect('movies2', '#003d4c', 'white');
		tabSelect('movies1', '#003d4c', 'white');
		tabSelect('movies3', '#003d4c', 'white');
		tabSelect('movies4');
		ratedInfoPage();
	});
//action for when the id "userpage" is clicked

	$('#userpage').click(function(e) {
		window.location = baseURL+'users';
	});
	//action for when the id "user1" is clicked
	$('#user1').click(function(e) {
		window.location = baseURL+'users/edit';	
		/*
		var callBack = function(data) {
			tabSelect('user2', '#003d4c', 'white');
			tabSelect('user1');
			$('#profileInfo').html(data);
		}
		l_ajaxPost('edit/', callBack);
		*/

	});
	$('#user2').click(function(e) {
		tabSelect('user1', '#003d4c', 'white');
		tabSelect('user2');
		profileInfoPage();
		
	});


	//action for when the id "moviespage" is clicked
	$('#grouppage').click(function(e) {
		window.location = baseURL+'groups';
	});
	//action for when the id "groups1" is clicked
	$('#groups1').click(function(e) {

		var callBack = function(data) {
			tabSelect('groups2', '#003d4c', 'white');
			tabSelect('groups3', '#003d4c', 'white');
			tabSelect('groups1');
			$('#groupsInfo').html(data);
			groupListLi();
		}
		l_ajaxPost(baseURL+'users/groupsInfo', callBack);
	});
	
	$('#groups2').click(function(e) {

		var callBack = function(data) {
			tabSelect('groups1', '#003d4c', 'white');
			tabSelect('groups3', '#003d4c', 'white');
			tabSelect('groups2');
			$('#groupsInfo').html(data);
			//groupListLi();
		}
		l_ajaxPost(baseURL+'groups/listRequests', callBack);
	});
	
	$('#groups3').click(function(e) {
		tabSelect('groups1', '#003d4c', 'white');
		tabSelect('groups2', '#003d4c', 'white');
		tabSelect('groups3');
		groupInfoPage();
	});
	
	//action for when the id "aboutpage" is clicked
	$('#aboutpage').click(function(e) {
		window.location = baseURL+'abouts';

	});

//action for when the id "about1" is clicked
	$('#about1').click(function(e) {
		console.log("tattar");
		var callBack = function(data) {
			tabSelect('about2', '#003d4c', 'white');
			tabSelect('about3', '#003d4c', 'white');
			tabSelect('about4', '#003d4c', 'white');
			tabSelect('about1');
			$('#information').html(data);
		}
		l_ajaxPost('abouts/about', callBack, {choice: 'PK'});
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
		l_ajaxPost('abouts/about', callBack, {choice: 'bundy'});
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
		l_ajaxPost('abouts/about', callBack, {choice: 'flash'});
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
		l_ajaxPost('abouts/about', callBack, {choice: 'laff'});
	});


	//action for when the id "moviespage" is clicked
	$('#logoutpage').click(function(e) {
		window.location = baseURL+'users/logout';
	});

	//action for when the id "moviespage" is clicked
	$('#loginpage').click(function(e) {
		window.location = baseURL+'users/login';
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
