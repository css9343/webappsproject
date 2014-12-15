//Get the current data
getDate();

$(document).ready(function(){
	$("#page").height($(window).height);
	
	//Clear all inputs
	$("input:text").each(function(){
		$(this).val("");
	});

	//Query string exists
	if(window.location.search.length){
		var errorHighLite = window.location.search.split("?")[1].split("=")[1];
		$(".errors").each(function(){
			$(this).find("#" + errorHighLite).show();
		});
	}
	
	//Accordion for the login/register form		
	$error = getParameterByName("error");
	
	if ($error.toString().split("")[0] == "c") {
		$("#login-accordion").accordion({
			collapsible: true,
			active: 1
		});
	}
	else{
		$("#login-accordion").accordion({
			collapsible: true,
			active: 0
		});
	}

});

//http://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

//A function to set the current date
function getDate(){
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd < 10)
		dd='0'+dd;

	if(mm < 10)
		mm='0'+mm;

	today = mm+'/'+dd+'/'+yyyy;

	SetCookie("date", today);
	setTimeout(function(){ getDate(); }, 86400000);
}