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

	var dt = new Date()
  	var $tz = dt.getTimezoneOffset();

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
			   + "&start_date=" + $s_dt    +  "&end_date="    + $e_dt        + "&start_time="  +  $s_tm	      + "&end_time="  +  $e_tm 
			   + "&tz="         + $tz; 

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
		location.reload();
	}else{
		alert(data.msg);
	}
}

function fetch_pref(){
		
	var url = 'fetch_pref.php';

	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: url,
	  data: null,
	  success: create_pref_success
	});
}

function create_pref_success(data, textStatus, jqXHR){

	if(data.exit_cd == 0 ){

		$('#mypref').modal('show');
		for (var i=0; i < data.pref.length ; i++){

			var pref = data.pref[i];
			var cat_id  = pref.category_id;
			var pref_cd = pref.preference_cd;

			// var obj = $('#1' ).val();
			// alert( " cat_id " + cat_id );
			var checkbox_id = "#cat_" +  cat_id + "_" + pref_cd; 
 			$(checkbox_id).prop( "checked", true );
			// alert( " cat_id " + cat_id +  " pref_cd " + pref_cd + " obj " + document.getElementById(cat_id)) ; 
		}

	}else{
		alert(data.msg);
	}
}
function return_checkbox_val(cat_id){
	
	var checkbox_id = "#cat_" +  cat_id + "_0"; 

	var pref = $(checkbox_id).prop( "checked");
	if(pref == true){
		return 0;
	}

	checkbox_id = "#cat_" +  cat_id + "_1"; 
    pref = $(checkbox_id).prop( "checked");
    if(pref == true){
		return 1;
	}

	checkbox_id = "#cat_" +  cat_id + "_2"; 
	pref = $(checkbox_id).prop( "checked");
    
    if(pref == true){
		return 2;
	}
}
function update_user_pref(){

	//sports 
	var sport_pref_val = return_checkbox_val(1);
	var prof_pref_val  = return_checkbox_val(2);
	var arts_pref_val  = return_checkbox_val(3);	
	var edu_pref_val  = return_checkbox_val(4);	
	var help_pref_val  = return_checkbox_val(5);		
	var outdoor_pref_val  = return_checkbox_val(6);
	var party_pref_val  = return_checkbox_val(7);	

	var data = "sport_pref_val=" + sport_pref_val + "&prof_pref_val=" + prof_pref_val + 
	           "&arts_pref_val=" + arts_pref_val  +  "&edu_pref_val=" + edu_pref_val  + 
	           "&help_pref_val=" + help_pref_val  +  "&outdoor_pref_val=" + outdoor_pref_val  +
	           "&party_pref_val=" + party_pref_val ;

	var url = 'update_user_pref.php';

	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: url,
	  data: data,
	  success: update_user_pref_success
	});
}


function update_user_pref_success(data, textStatus, jqXHR){
	
	if(data.exit_cd == 0 ){
		$('#mypref').modal('hide');
		location.reload();
	
	}else { 

		alert(data.msg);
	}
}
