
$(document).ready(function(){

	//Handle mobile nav
	setUpMobileNav();
	$(window).on("resize", function(){
		setUpMobileNav();
	});
	
	$("#open-menu").on("click", function(){
		var $sideMenu = $("#side-menu");
		
		if($sideMenu.hasClass("open"))
			closeSideMenu();
		else 
			openSideMenu();
	});
	
	/*---------------END MOBILE NAV SCRIPTS------------------*/

	//Set the time and date
	getTime();
	getDate();

	//Open up the popup on click
	$("#add-task").on("click", function(){
		$("#overlay").fadeIn();	
	});
	
	//Close the popup
	$("#cancel-add").on("click", function(){
		$("#overlay").fadeOut();	
	});
	
	//Setup the datepicker
	$("#datepicker").datepicker();
	
	//Setup the timepicker
	jQuery('#timepicker').datetimepicker({
		datepicker:false,
		format:'H:i'
	});
	
	//Setup colors of warning and urgent tasks
	$("#tasks").find(".days-left").each(function(){
		var $days = $(this).attr("id");
		var classToAdd = "";
		
		if($days == 4 || $days == 5)
			classToAdd = "warning";
		else if($days <= 3 && $days > 0)
			classToAdd = "urgent";
		else if($days == 0)
			classToAdd = "today";
		else if($days < 0)
			classToAdd = "late";
		
		$(this).parent().addClass(classToAdd);
	});
});

//Setup the mobile nav
function setUpMobileNav(){
	$("#side-menu").css("height", $(window).height());
}

//Open side menu
function openSideMenu(){
	$("#side-menu").stop().animate({
		width: $(window).width() * 0.75
	}, function(){ $(this).addClass("open"); });
	
	//$("#tasks").stop().animate({
		//marginLeft: $(window).width() * 0.75
	//});
}

//Close side menu
function closeSideMenu(){
	$("#side-menu").stop().animate({width: 0}, function(){ $(this).removeClass("open"); });
	//$("#tasks").stop().animate({marginLeft: 0});
}

//Send out a formatted time objects
function getTime(){
	var d = new Date();
	var time = d.toLocaleTimeString();
	$("#time").html(time);
	setTimeout(function(){ getTime(); }, 1000);
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
	$("#date").html(today);	
	
	SetCookie("date", today);
	setTimeout(function(){ getDate(); }, 86400000);
}
