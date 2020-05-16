function redirect(url){
	window.location.href=url;
}

function checkMe(ele){
        if($(ele).val()){
          $(ele).removeClass("in-valid").addClass("valid")
          return true
        }
        else{
          $(ele).removeClass("valid").addClass("in-valid")
          return false
        }
        
      }
      function checkFilled(form){
        arr = []
        $(form).find('input').each(function(){
          arr.push(checkMe(this))
        });
        return arr
    }
    
$(document).ready(function(){

	$(".dash.list-group-item").click(function(){
    	redirect("eventDashboard.php?eve="+$(this).attr('eve'));
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




