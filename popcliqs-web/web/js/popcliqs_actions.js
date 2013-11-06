/**
 *  Create Event.
 */
function create_event(){
	
	if ( $('#title').val() == null || $('#title').val() == "" ){
	  	alert(" Invalid Title" );
	  	return;
	}

	if ($('#category_id').val() == null || $('#category_id').val() == "" ){
	  	alert(" Select a Category" );
	  	return;
	}

	if ($('#postal_code').val() == null || $('#postal_code').val() == ""  
			|| $('#postal_code').val().length  != 5 || !isNumber($('#postal_code').val()) ){
	 	
		alert(" Invalid Zip" );
	 	return;
	}

	if ($('#start_date').val() == null || $('#start_date').val() == "" ){
	  	alert(" Invalid Start date" );
	  	return;
	}

	if ($('#end_date').val() == null || $('#end_date').val() == "" ){
	  	alert(" Invalid End date" );
	  	return;
	}

	if( $('#capacity').val() != null && $('#capacity').val() != ""  && !isNumber($('#capacity').val()) ){
		alert(" Capacity should be numberic. " );
	  	return;
	}

	var $title			= $("#title").val();
	var $description	= $('#description').val();
	var $category_id	= $('#category_id').val();
	var $location		= $('#location').val();
	var $address		= $('#address').val();
	var $postal_code	= $('#postal_code').val();
	var $age_limit		= $('#age_limit').val();
	var $capacity		= $('#capacity').val();
	var $s_dt       	= $('#start_date').val();
	var $e_dt       	= $('#end_date').val();
	var $s_tm			= $('#start_time').val();
	var $e_tm			= $('#end_time').val();
	
	// alert( $title   +  " " + $description + " " + $category_id + " "  + $location  + " " +
	// 	   $address +  " " + $postal_code + " " + $age_limit   + " "  + $capacity  + " " +
	// 	   $s_dt    +  " " + $e_dt        + " " +  $s_tm	   + " "  +  $e_tm
	// 	); 	

	var url = 'event.php';
	var data =   "event_title=" + $title   +  "&description=" + $description + "&category_id=" + $category_id + "&location="  + $location  
			   + "&address="    + $address +  "&postal_code=" + $postal_code + "&age_limit="   + $age_limit   + "&capacity="  + $capacity  
			   + "&start_date=" + $s_dt    +  "&end_date="    + $e_dt        + "&start_time="  +  $s_tm	      + "&end_time="  +  $e_tm ; 

	$.ajax({
		  type: "POST",
		  dataType: "json",
		  url: url,
		  data: data,
		  success: create_event_success
		});
}

function isNumber(n) {
  	return !isNaN(parseFloat(n)) && isFinite(n);
}

function create_event_success(data, textStatus, jqXHR){
	
	if(data.exit_cd == 0 ){
		alert("Event created Successfully !!! ");
		$('#newEvent').modal('hide');
		document.getElementById("event_form").reset();
	}else{
		alert(data.msg);
	}
}
