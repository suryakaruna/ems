function redirect(url){
	window.location.href=url;
}

events = {};

function getDashboard(){
   // $("#addEventForm").hide();  //v1
   $.post("api/fetchEvents.php",function(response){
                events = JSON.parse(response);
                for(let i=0; i<events.length; i++){
                      event = events[i];
                      $("<div class='dash list-group-item' id="+event.id+">"+event.title+"<i class='fas fa-angle-double-right float-right'></i></div>").appendTo(".list-group");
                }
               // $("<div class='list-group-item text-center' id='addEvent'><i class='fas fa-plus-square text-primary'></i></div>").appendTo(".list-group"); //v1
            });
}


$(document).ready(function(){

	$(".dash.list-group-item").click(function(){
    	redirect("eventDashboard.php?id="+$(this).attr('id'));
	});

// 	$("#addEvent").click(function(){
//     $("#addEventForm").toggle('1s','swing');
// });												//v1

	// $(".list-group-item").click(function(){
	// 	$(".col-md-9").empty();
	// 	 for(let i=0; i<events.length; i++){
 //                      event = events[i];
	// 		if(event.id == $(this).attr('id')){
	// 			keys = Object.keys(event);
	// 			except = ["id","banner","submit","organiser"];
	// 			//console.log(keys.splice(except))
				
	// 			//console.log(type(except));
	// 			for(var key in event)
	// 				if(except.find(String(key)))
	// 					$("<div class='form-group'>\
	// 				    	<label for='"+key+"'>"+key+"</label>\
	// 				    	<input type='text' class='form-control' id='"+key+"' value='"+event[key]+"'>\
	// 					</div>").appendTo(".col-md-9");
	// 		}
	// 	}
	// });
});




