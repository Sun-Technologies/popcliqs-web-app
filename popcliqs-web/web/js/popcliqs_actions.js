function reset_forgot_password(){
	$('#forgotPassword').modal('hide');
		document.getElementById("forgot_password_form").reset();
}

function send_password(){

	if ($('#user_email').val() == null || $('#user_email').val() == "") {
		alert("Please Enter Email");
		return;

	}
	 var $user_email = $('#user_email').val();
     var url = 'forgot_password.php';
	 var data = "user_email=" + $user_email ;
	 var handler = send_password_success;

	$.ajax({
		  type: "POST",
		  dataType: "json",
		  url: url,
		  data: data,
		  success: handler
		});
}

function send_password_success(data, textStatus, jqXHR){

	if(data.exit_cd == 0 ){
      alert("The Link to reset password has been sent to your Email Address");
		$('#forgotPassword').modal('hide');
		document.getElementById("forgot_password_form").reset();
		
	} else{
		
			alert(data.msg);
	}
	
}

function save_acc_setting(){

	if (document.getElementById("pwd").checked == true ){
	
        if ($('#pwd1').val() == null || $('#pwd1').val() == ""){
    		alert("Enter old Password");
    		return; 
    	}

    	else if ( $('#pwd2').val() == null || $('#pwd2').val() == "" ){
    	alert("Enter New Password");
    	return;

   	}
    	 else if ( $('#pwd3').val() == null || $('#pwd3').val() == "" ){
    	alert("Re Enter New Password");
    	return;

    }
   		else if ( $('#pwd2').val().length  < 6 || $('#pwd3').val().length  < 6 ){
	 	
		alert("Password length Should be greater than six" );
	 	return;

    }
    	else if ( $('#pwd2').val() !== $('#pwd3').val() ){
    	alert("Password Miss Match");
    }

		else if ($('#zip').val() == null || $('#zip').val() == ""  
			|| $('#zip').val().length  != 5 || !isNumber($('#zip').val()) ){
	 	
		alert(" Invalid Zip" );
	 	return;
	 }

}
   		var $old_password = $('#pwd1').val();
   		var $new_password = $('#pwd3').val();
        
	 	var $zip= $('#zip').val();
	 	var url = 'save_acc_setting.php';
	 	var data = "zip=" + $zip + "&old_password=" + $old_password  + "&new_password=" + $new_password;
	 	var handler = save_acc_setting_success;

	 	$('#zip_code_str').html($zip.trim()+")");
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
		 fetchEvents();
		
	}else{

	
		alert(data.msg);


	}
}


function display_err(id_tag){
	$("#"+ id_tag + "_fr" ).addClass("has-error has-feedback");
	$("#"+ id_tag + "_sp").show();
	  
}

function hide_err(id_tag){
	$("#"+ id_tag + "_fr" ).removeClass("has-error has-feedback");
	$("#"+ id_tag + "_sp").hide();
	  
}


function create_event(){
	
	var is_error =false;
	if ( $('#title').val() == null || $('#title').val() == "" ){
		
		display_err("title");
		is_error = true;
	}else{
		hide_err("title");
	}

	if ($('#category_id').val() == null || $('#category_id').val() == "" ){
	  	
		display_err("category");
		is_error = true;
	}else{
		hide_err("category");
	}

	if ($('#postal_code').val() == null || $('#postal_code').val() == ""  
			|| $('#postal_code').val().length  != 5 || !isNumber($('#postal_code').val()) ){
	 	
		display_err("zip");
		is_error = true;

	}else{
		hide_err("zip");
	}

	if ($('#start_date').val() == null || $('#start_date').val() == "" ){
	  	display_err("stdt");
		is_error = true;
	}else{
		hide_err("stdt");
	}

	if ($('#end_date').val() == null || $('#end_date').val() == "" ){
	  	display_err("endt");
		is_error = true;

	}else{
		hide_err("endt");
	}

	if( $('#capacity').val() != null && $('#capacity').val() != ""  && !isNumber($('#capacity').val()) ){
		display_err("capacity");
		is_error = true;

	}else{
		hide_err("capacity");
	}


	var $age_limit = 0 ;
	if($("#age_limit_18").prop( "checked")){
		$age_limit = 18 ;
	}else if($("#age_limit_21").prop( "checked")){
		$age_limit = 21;
	}
	
	if(is_error){
		return;
	}
	var dt = new Date()
  	var $tz = dt.getTimezoneOffset();

  	var $event_id       = $("#event_id").val();
	var $title			= $("#title").val();
	var $description	= $('#description').val();
	var $category_id	= $('#category_id').val();
	var $location		= $('#location').val();
	var $address		= $('#autocomplete').val();
	var $postal_code	= $('#postal_code').val();
	// var $age_limit		= $('#age_limit').val();
	var $capacity		= $('#capacity').val();
	var $s_dt       	= $('#start_date').val();
	var $e_dt       	= $('#end_date').val();
	var $s_tm			= $('#start_time').val();
	var $e_tm			= $('#end_time').val();
	var $e_lat    		= $('#lat').val();
	var $e_lon    		= $('#lon').val();
	var $geozip         = $('#geozip').val();
	
	if( $geozip !== null && $geozip.trim().length > 0 && $geozip  !=  $postal_code) { 

		$e_lat  = null;
		$e_lon  = null;
	}

	// alert( $title   +  " " + $description + " " + $category_id + " "  + $location  + " " +
	// 	   $address +  " " + $postal_code + " " + $age_limit   + " "  + $capacity  + " " +
	// 	   $s_dt    +  " " + $e_dt        + " " +  $s_tm	   + " "  +  $e_tm     
	// 	); 	
	

	var url = 'event.php';
	var data =   "event_title=" + $title   +  "&description=" + $description + "&category_id=" + $category_id + "&location="  + $location  
			   + "&address="    + $address +  "&postal_code=" + $postal_code + "&age_limit="   + $age_limit   + "&capacity="  + $capacity  
			   + "&start_date=" + $s_dt    +  "&end_date="    + $e_dt        + "&start_time="  + $s_tm	      + "&end_time="  + $e_tm 
			   + "&tz="         + $tz      +  "&event_id="    + $event_id    + "&lat="          + $e_lat       + "&lon="        + $e_lon;

	var handler = create_event_success; 

	if ($('#event_id').val() != null && $('#event_id').val().trim() != "" ){
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
		// alert("Event update Successfully !!! ");
		close_event_window();
		//display modal 
		
		$('#messageTitle').html(" Cliq updated");
		$('#messageTxt').html("Event update Successfully");
		$('#msgModal').modal('show') ;
		//location.reload();
	}else{
		if(data.exit_cd == "-1009"){
			display_err("stdt");
			display_err("endt");

		}else{
			alert(data.msg);
		}
	}
}


function isNumber(n) {
  	return !isNaN(parseFloat(n)) && isFinite(n);
}

function create_event_success(data, textStatus, jqXHR){
	
	if(data.exit_cd == 0 ){
		//alert("You are all set to find your cliq.");
		//Modal to display sucess. 

		close_event_window();
		$('#messageTitle').html(" Cliq created");
		$('#messageTxt').html("You are all set to find your cliq.");
		$('#msgModal').modal('show') ;
		//location.reload();

	}else{
		if(data.exit_cd == "-1009"){
			display_err("stdt");
			display_err("endt");

		}else{
			alert(data.msg);
		}
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

	myApp.showPleaseWait();
	
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
	return;
}

function fetch_event_details_success (data, textStatus, jqXHR) {
	
	myApp.hidePleaseWait();

	if(data.exit_cd == 0 ){

		$('#e_title').html(data.title) ;
		$('#e_desc').html(data.description) ;
		$('#e_cat').html(data.type) ;
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
		if(data.distance == 0){
			$('#e_dist').html("Same zip code");
		}else{
			$('#e_dist').html(" About "  + data.distance + " " + " miles");
		}
		if(data.rsvp == 0 ) {
			$("#save_btn").css("display", "inline");
		}else{
			$("#save_btn").css("display", "none");
		}
		$('#eventdetails').modal('show');

	}else { 
		alert(data.msg);
	}
}

function update_rspv(){

	myApp.showPleaseWait();

	var eventid = $('#e_id').val();
	var dt 		= new Date()
	var $tz 	= dt.getTimezoneOffset()
	
	var data 	= "event_id=" + eventid + "&tz=" + $tz;  
	var url     = 'update_user_rspv.php';
	;

	$.ajax({
	  type: "POST",
	  dataType: "json",
	  url: url,
	  data: data,
	  success: update_rspv_success
	});
}

function update_rspv_success(data, textStatus, jqXHR){
	
	myApp.hidePleaseWait();

	if(data.exit_cd == 0 ){
		
		$('#eventdetails').modal('hide');
	}else { 

		alert(data.msg);
	}
}

function fetch_attended_events(){

	var dt   = new Date()
  	var $tz  = dt.getTimezoneOffset();
	var data = "action=2&tz=" + $tz ; 
	fetch_rsvp_evnts(data,fetch_attended_events_success);
}

function fetch_interested_events(){

	var dt   = new Date()
  	var $tz  = dt.getTimezoneOffset();
	var data = "action=1&tz=" + $tz ; 
	fetch_rsvp_evnts(data ,fetch_interested_events_success);
	
}

function fetch_rsvp_evnts(data , successNext){

	var url  = 'fetch_rsvp_events.php';
	
	$.ajax({
	  type: "POST",
	  dataType: "text",
	  url: url,
	  data: data,
	  success: successNext
	});

}

function fetch_attended_events_success(data, textStatus, jqXHR){
	$('#attended-tab').html(data);
}

function fetch_interested_events_success(data, textStatus, jqXHR){
	$('#interested-tab').html(data);
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

function update_rsvp_event(event_id){
	var r = confirm("Are you sure you want to remove the event  from your list ?");
	if ( r == true ){
		var url  = 'update_rsvp_events.php?';
		var data = "&event_id=" + event_id ; 
		$.ajax({
		  type: "POST",
		  dataType: "json",
		  url: url,
		  data: data,
		  success: update_rsvp_events_success
		});
	}
}

function update_rsvp_events_success (data, textStatus, jqXHR) {

	if(data.exit_cd == 0 ){
		fetch_interested_events();
		fetch_attended_events();
	}else { 

		alert(data.msg);
	}
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
	initialize_geo();
	// alert(data);
	if(data.exit_cd == 0 ){
		
		$('#history').modal('hide');
		$('#newEvent').modal('show');

		//update title.
		$("#eventdetails_title").html("Modify Cliq");

		// set values  to input boxes 
		$("#event_id").val(data.id);
		$("#title").val(data.title);
		$('#description').val(data.description);
		$('#category_id').val(data.typeid);
		$('#location').val(data.location);
		$('#autocomplete').val(data.address);
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
	    $('#submit_btn').html("Update");

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
	$('#submit_btn').html("Create");
	$("#eventdetails_title").html("New Cliq");
	document.getElementById("event_form").reset();
}


function closemodal(modalid){
    $("#"+modalid).modal('hide');
    location.reload();
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

var placeSearch, autocomplete;
var componentForm = {
  // street_number: 'short_name',
  // route: 'long_name',
  // locality: 'long_name',
  // administrative_area_level_1: 'short_name',
  // country: 'long_name',
  postal_code: 'short_name',
  
};

function initialize_geo() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] ,
      	componentRestrictions: {country: 'us'}
       });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

   	//alert(place.geometry.location.lat() +  " "  +  place.geometry.location.lng() );


   	$('#lat').val(place.geometry.location.lat());
   	$('#lon').val(place.geometry.location.lng()) 
  	// Get each component of the address from the place details
  	// and fill the corresponding field on the form.
  	for (var i = 0; i < place.address_components.length; i++) {
	    var addressType = place.address_components[i].types[0];
	    var val = place.address_components[i][componentForm[addressType]];
	    if (componentForm[addressType]) {
	      var val = place.address_components[i][componentForm[addressType]];
	      
	      document.getElementById(addressType).value = val;
	      if(  addressType  === 'postal_code' ){
	      	document.getElementById("geozip").value = val;
	  	  }
	    }
	}
}


// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
    });
  }
}
// [END region_geolocation]

