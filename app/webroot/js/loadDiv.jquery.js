/*
	The navigation code for navigating our coded site - plugin.
*/

function ajaxPost(url, data, callback, base) {
	var ajaxURL = (base == false ? url : baseURL + url);
	$.ajax({
		type: 'POST',
		url: ajaxURL,
		data: data,
		success: callback
	});
}

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
		// get the string that belongs to the "href" and 
		//splits it by the delimiter "#" to be put into array.
		var urlInfo = $(this).attr('href');
		var urlParts = urlInfo.split('#');

		console.log("So far so good");
		e.preventDefault();
		//declaring function to be used as callback.
		//function recieves "data" from the "print()" in views etc.
		//as stated in "ajaxCall()" the data is in html format.
		var searchCallBack = function(data) {
			console.log(data);
			$('#'+urlParts[3]).html(data);
		}

		ajaxCall(urlParts[0], urlParts[1], urlParts[2], searchCallBack);

		//prevent the regular action (go to link/page).
		e.preventDefault();
	});
});