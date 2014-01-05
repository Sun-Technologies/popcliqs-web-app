function save_acc_setting(){

	if ($('#zip').val() == null || $('#zip').val() == ""  
			|| $('#zip').val().length  != 5 || !isNumber($('#zip').val()) ){
	 	
		alert(" Invalid Zip" );
	 	return;
	 }
	 var $zip	= $('#zip').val();
	 var url = 'save_acc_setting.php';
	 var data = "zip=" + $zip ;
	var handler = save_acc_setting_success;

	$.ajax({
		  type: "POST",
		  dataType: "json",
		  url: url,
		  data: data,
		  success: handler
		});

}

function save_acc_setting_success(data, textStatus, jqXHR){
	
	if(data.exit_cd == 0 ){
		$('#resetpwd').modal('hide');
		
	}else{

		alert(data.msg);
	}
}


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
	var $age_limit = 0 ;
	if($("#age_limit_18").prop( "checked")){
		$age_limit = 18 ;
	}else if($("#age_limit_21").prop( "checked")){
		$age_limit = 21;
	}
	
	var dt = new Date()
  	var $tz = dt.getTimezoneOffset();

  	var $event_id       = $("#event_id").val();
	var $title			= $("#title").val();
	var $description	= $('#description').val();
	var $category_id	= $('#category_id').val();
	var $location		= $('#location').val();
	var $address		= $('#address').val();
	var $postal_code	= $('#postal_code').val();
	// var $age_limit		= $('#age_limit').val();
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
			   + "&tz="         + $tz      +  "&event_id="    + $event_id;

	var handler = create_event_success; 

	if ($('#event_id').val() != null || $('#event_id').val() != "" ){
		handler = update_event_success;
	}

	$.ajax({
		  type: "POST",
		  dataType: "json",
		  url: url,
		  data: data,
		  success: handler
		});
}

function update_event_success(data, textStatus, jqXHR){
	
	if(data.exit_cd == 0 ){
		alert("Event update Successfully !!! ");
		close_event_window();
		location.reload();
	}else{
		alert(data.msg);
	}
}


function isNumber(n) {
  	return !isNaN(parseFloat(n)) && isFinite(n);
}

function create_event_success(data, textStatus, jqXHR){
	
	if(data.exit_cd == 0 ){
		alert("Event created Successfully !!! ");
		close_event_window();
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

function fetch_acc_setting(){
		
	var url = 'fetch_acc_setting.php';

	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: url,
	  data: null,
	  success: create_acc_setting_success
	});
}

function create_acc_setting_success(data,textStatus,jqXHR){

	if(data.exit_cd == 0 ){

		$('#resetpwd').modal('show');
		zip = data.zip;
	
        $("#zip").val(data.zip);


	}else{

		alert(data.msg);
	}
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
	var sport_pref_val    = return_checkbox_val(1);
	var prof_pref_val     = return_checkbox_val(2);
	var arts_pref_val     = return_checkbox_val(3);	
	var edu_pref_val      = return_checkbox_val(4);	
	var help_pref_val     = return_checkbox_val(5);		
	var outdoor_pref_val  = return_checkbox_val(6);
	var party_pref_val    = return_checkbox_val(7);
	var social_pref_val	  = return_checkbox_val(8);	

	var data = "sport_pref_val=" + sport_pref_val +  "&prof_pref_val=" + prof_pref_val + 
	           "&arts_pref_val=" + arts_pref_val  +  "&edu_pref_val=" + edu_pref_val  + 
	           "&help_pref_val=" + help_pref_val  +  "&outdoor_pref_val=" + outdoor_pref_val  +
	           "&party_pref_val=" + party_pref_val+  "&social_pref_val=" + social_pref_val;

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

function fetch_event_details(eventid){

	var dt = new Date()
  	var $tz = dt.getTimezoneOffset();

	var data = "event_id=" + eventid + "&tz=" + $tz; 
	var url = 'fetch_event_details.php';

	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: url,
	  data: data,
	  success: fetch_event_details_success
	});
}

function fetch_event_details_success (data, textStatus, jqXHR) {
	
	// alert(data);
	if(data.exit_cd == 0 ){

		$('#e_title').html(data.title) ;
		$('#e_desc').html(data.description) ;
		$('#e_loc').html(data.location) ;
		$('#e_add').html(data.address) ;
		$('#e_zip').html(data.postal_code) ;


		age_limit_desc = "No age limit";
		if(data.age_limit == 18) {
			age_limit_desc = "Above 18 only.";
		}else if(data.age_limit == 21) {
			age_limit_desc = "Above 21 only.";
		}
		$('#e_alimit').html(age_limit_desc) ;
		$('#e_id').val(data.id) ;
		$('#e_start').html(data.st_dt) ;
		$('#e_end').html(data.ed_dt) ;
		$('#e_dist').html(data.distance);
		
		if(data.rsvp != 0 ) {
			$("#save_btn").css("display", "none");
		}else{
			$("#save_btn").css("display", "inline");
		}
		$('#eventdetails').modal('show');

	}else { 
		alert(data.msg);
	}
}

function update_rspv(){

	var eventid = $('#e_id').val();
	var data    = "event_id=" + eventid ; 
	var url     = 'update_user_rspv.php';

	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: url,
	  data: data,
	  success: update_rspv_success
	});
}

function update_rspv_success(data, textStatus, jqXHR){
	
	if(data.exit_cd == 0 ){
		
		$('#eventdetails').modal('hide');
	}else { 

		alert(data.msg);
	}
}

function fetch_initiated_events(){

	var dt = new Date()
  	var $tz = dt.getTimezoneOffset();

	var url  = 'fetch_initiated_events.php?';
	var data = "&tz=" + $tz; 
	$.ajax({
	  type: "POST",
	  dataType: "text",
	  url: url,
	  data: data,
	  success: fetch_initiated_events_success
	});
}

function fetch_initiated_events_success (data, textStatus, jqXHR) {
	
	$('#initiated-tab').html(data);
}

function delete_event(event_id){
	
	var r = confirm("Are you sure you want to delete the event !!! ");
	if ( r == true ){
	   
		var url  = 'delete_event.php?';
		var data = "event_id=" + event_id; 
		$.ajax({
		  type: "POST",
		  dataType: "text",
		  url: url,
		  data: data,
		  success: delete_event_success
		});
	}
}

function delete_event_success(data, textStatus, jqXHR){

	fetch_initiated_events();
}

function edit_event(event_id){

	var dt = new Date();
  	var $tz = dt.getTimezoneOffset();
  	var url = 'fetch_event_details.php';

	var data = "event_id=" + event_id + "&tz=" + $tz; 
	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: url,
	  data: data,
	  success: edit_event_success
	});
}

function edit_event_success (data, textStatus, jqXHR) {
	
	// alert(data);
	if(data.exit_cd == 0 ){
		
		$('#history').modal('hide');
		$('#newEvent').modal('show');

		// set values  to input boxes 
		$("#event_id").val(data.id);
		$("#title").val(data.title);
		$('#description').val(data.description);
		$('#category_id').val(data.typeid);
		$('#location').val(data.location);
		$('#address').val(data.address);
		$('#postal_code').val(data.postal_code);

		var agelimit_chkbox = '#age_limit_' + data.age_limit;
		$(agelimit_chkbox).prop( "checked", true );
		$('#capacity').val(data.capacity);
				
		var start = data.st_dt.split(" "); 
		var end   = data.ed_dt.split(" "); 
		$('#start_date').val(start[0]);
	    $('#end_date').val(end[0]);
	    $('#start_time').val(data.st_time);
	    $('#end_time').val(data.ed_time);

	}else { 
		alert(data.msg);
	}
}

function update_screen(modal_id){
	$(modal_id).modal('hide');
		location.reload();

}

function close_event_window(){

	$('#newEvent').modal('hide');
	document.getElementById("event_form").reset();
}


function reset_pwd(){
	$('#resetpwd').modal('show');
}

function enableTextbox()
{
    if (document.getElementById("pwd").checked == true)
    {
        
        document.getElementById("pwd1").disabled = false;
        document.getElementById("pwd2").disabled = false;
        document.getElementById("pwd3").disabled = false;
       
    }
    else
    {
        document.getElementById("pwd1").disabled = true;
        document.getElementById("pwd2").disabled = true;
        document.getElementById("pwd3").disabled = true;
       
    }
}

