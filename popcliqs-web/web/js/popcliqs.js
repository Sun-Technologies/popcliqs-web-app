
var stage;
var canvas;
var Log;

var ispredisplay = false;
var istimerStart = false;
var preflabel;
var newevtlabel;
var historylabel;
var prefcircle  ;
var newevtcircle ;
var historycircle ;
var poppedBubble;
var $time_interval;
var $cat_type; 
var $search_var;

var now ;
var maxL = 500;
var event1  = new Object();
event1.id   = "evt01";
event1.size = "S";
event1.type = "4"; //sports , professional , arts ,edu, adventure
event1.time = "17:00";
event1.fillPCent = 50;
event1.rank = 5;
event1.mratio=0.5; // Max value 2


var event2  = new Object();
event2.id   = "evt02";
event2.size = "S";
event2.type = "4";
event2.time = "18 :00";
event2.fillPCent = 24;
event2.rank = 3;
event2.mratio=0.4;

var event3  = new Object();
event3.id   = "evt03";
event3.size = "S";
event3.type = "4";
event3.time = "20:00"
event3.fillPCent = 7;
event3.rank = 5;
event3.mratio=1.4;
		
var $user_id ; 
//var eventlist =new Array(event1,event2,event3);
var eventlist  = new Array();
function init(user_id , $time_interval , $cat_type , $search_t ){
	
	eventlist  = new Array();
	$user_id = user_id;
	if( $time_interval == null){
		$time_interval = 8;

	}else{
		$("#ti").val($time_interval);
	}

	if( $cat_type == null){
		$cat_type = 0;
	}else{
		$("#c").val($cat_type);
	}

	if($search_t == null) {
		$search_t = "";
	}else{
		$("#s").val($search_t);
	}
	$search_var = $search_t;

	this.$time_interval = $time_interval;
	this.$cat_type      = $cat_type;

	var dt = new Date()
	var tz = dt.getTimezoneOffset();
	
	$.getJSON('./module/popcliqsevents/static/php/service.php?userId='
				+ user_id + '&ti=' + $time_interval + '&tz=' +tz + '&s=' + $search_t, 
		function(data , status) {
  			$.each(data, function(i, eventobj){
      			eventlist.push(eventobj);
    	});
    	process();
  	});
	
	//process();
	if (! istimerStart ) { 
		setInterval(function(){
		
			if( ispredisplay  || popupStatus == 1) {
				return;
			}

			if( $("#ti").val() == null){
				$time_interval = 8;

			}else{
				$time_interval = $("#ti").val();
			}

			if( $("#c").val() == null){
				$cat_type = 0;
			}else{
				$cat_type = $("#c").val();
			}

			if($("#s").val() == null) {
				$search_t = "";
			}else{
				$search_t = $("#s").val();
			}
			init( user_id , $time_interval , $cat_type , $search_t );
		
		},1000  *  60 * 2);
	
		istimerStart = true;
	}
}

// Init the splash page
function process(){

	// get time
	var dt = new Date();
 	now = dt.getHours() + ":00"  ;
 	//now = "00:00";
 	Log = createjs.Log;
			
	canvas = document.getElementById("mainCanvas");
	stage = new createjs.Stage(canvas);
	
	stage.clear();
	stage.update();

	//Easeljs
	// to get onMouseOver & onMouseOut events, we need to enable them on the stage:
	stage.enableMouseOver();
	
	spritesheet = new createjs.SpriteSheet({
		images: ['./module/popcliqsevents/static/image/animation-1.png'],
		frames: {width: 300, height: 300},
		animations: {   
			stand: 0, // 1 frame of the player standing
			die: [1, 5, false] // 5 frame death sequence
		}
	});
			
	
	//draw main body
	drawBody();
	
	//draw footer section
	drawFooter();
	
	createjs.Ticker.setFPS(20);
		
	// in order for the stage to continue to redraw when the Ticker is paused we need to add it with
	// the second ("pauseable") param set to false.
	createjs.Ticker.addEventListener("tick", tick);	
}﻿

function drawWaterDrop(){

	var waterdropObj = new Image();
	waterdropObj.src = './module/popcliqsevents/static/image/waterdrop.png';	
	
	waterdropObj.onload = function() {
		var drop1 = new createjs.Bitmap(waterdropObj);
		drop1.x = -28 ;
		drop1.y = -50; 
		stage.addChild(drop1);
	};
}

function drawBody(){
	
	drawWaterDrop();
	
	linewd = canvas.width/10;
	var timex = linewd;
	
	var time_inc = 1;
	if($time_interval == 24){
		time_inc = 3;
	}else if($time_interval == 72){
		time_inc = 9;
	}
	
	 var time_line = 0; 
	//Easeljs
	var bg = new createjs.Shape();

	stage.addChild(bg);
	bg.graphics.beginStroke("#9F9F9F");

	if($time_interval != 72){
		displayTime(timex , 'Now' , stage , 10 );
	} else{
		displayTime(timex , 'Today' , stage , 10 );
	}
	drawVertTimeLine( timex , canvas ,bg );
	
	now_l = addtime(now, time_inc );
	time_line = time_line + time_inc;
	timex = linewd * 2;
	if($time_interval != 72){
		displayTime(timex , getTime(now_l) , stage );
	}
	//drawVertTimeLine( timex , canvas ,bg );
	
	time_line = time_line + time_inc;
	timex = linewd * 3;

	now_l = addtime(now_l, time_inc );
	if($time_interval != 72){
		displayTime(timex , getTime(now_l) , stage );
	}
	//drawVertTimeLine( timex , canvas ,bg );
	
	time_line = time_line + time_inc;
	timex = linewd * 4;
	now_l = addtime(now_l, time_inc );
	if($time_interval != 72){
		displayTime(timex , getTime(now_l) , stage );
	}else{
		displayTime(timex , 'Tomorrow' , stage );
	}
	drawVertTimeLine( timex , canvas ,bg );
	
	time_line = time_line + time_inc;
	timex = linewd * 5;

	now_l = addtime(now_l, time_inc );
	if($time_interval != 72){
		displayTime(timex , getTime(now_l) , stage );
	}
	//drawVertTimeLine( timex , canvas ,bg );
	
	now_l = addtime(now_l, time_inc );
	time_line = time_line + time_inc;
	timex = linewd * 6;
	if($time_interval != 72){
		displayTime(timex , getTime(now_l) , stage );
	}
	//drawVertTimeLine( timex , canvas ,bg );
	
	now_l = addtime(now_l, time_inc );
	time_line = time_line + time_inc;
	timex = linewd * 7 ;
	drawVertTimeLine( timex , canvas ,bg );
	
	if($time_interval != 72){
		displayTime(timex , getTime(now_l) , stage );
	}else{
		displayTime(timex , 'Day After' , stage );
	}

	now_l = addtime(now_l, time_inc );
	time_line = time_line + time_inc;
	timex = linewd * 8;
	if($time_interval != 72){
		displayTime(timex , getTime(now_l) , stage );
	}
	//drawVertTimeLine( timex , canvas ,bg );
	
	now_l = addtime(now_l, time_inc );
	time_line = time_line + time_inc;
	timex = linewd * 9;
	if($time_interval != 72){
		displayTime(timex , getTime(now_l) , stage );
	}
	//drawVertTimeLine( timex , canvas ,bg );
	
	//Draw all the events.
	for (var i=0; i<eventlist.length; i++){
		drawEvent( eventlist[i] , time_inc); 

	}
}

/*
 *  alignbuf - is used to align Now string.
 */
function displayTime(timex , msgTxt , stage , alignbuf  ){

	var msg = new createjs.Text(msgTxt, '11pt Calibri', '#9F9F9F');
	stage.addChild(msg);
	
	if(alignbuf != null){
		msg.x = timex - 25  + alignbuf;
	} else{
		msg.x = timex - 25 ;
	}
	msg.y = 54;
}

function drawVertTimeLine( timex , canvas ,bg ){
	for ( var i = 60 ; i < canvas.height -100 ; ){
	
		i = i +20;
		bg.graphics.moveTo(timex, i);
		
		i = i +10;
		bg.graphics.lineTo(timex, i);
	}

}
function drawEvent( event , time_inc ){


	/*				
	if (document.getElementById('category').selectedIndex == 1 && event.type !=  "sports"){
		return;
	}
	else if (document.getElementById('category').selectedIndex == 2 && event.type !=  "professional"){
		return;
	}
	else if (document.getElementById('category').selectedIndex == 3 && event.type !=  "edu"){
		return;
	}
	else if (document.getElementById('category').selectedIndex == 4 && event.type !=  "shelp"){
		return;
	}
	else if (document.getElementById('category').selectedIndex == 5 && event.type !=  "arts"){
		return;
	}
	else if (document.getElementById('category').selectedIndex == 6 && event.type !=  "outdoor"){
		return;
	}
	else if (document.getElementById('category').selectedIndex == 7 && event.type !=  "event"){
		return;
	}
	else if (document.getElementById('category').selectedIndex == 8 && event.type !=  "others"){
		return;
	}
	
	*/

	//alert(event.id);

	if($cat_type != 0 && $cat_type != event.type){
		return;
	}

	var fillstartangle ;
	var fillendangle ;
	if(event.fillPCent <= 10){
		fillstartangle =  0.3;
		fillendangle   =  0.7;
		
	} else if(event.fillPCent <= 25){
		fillstartangle =  0.2;
		fillendangle   =  0.8;
	} else if(event.fillPCent <= 60){
		fillstartangle =  0;
		fillendangle   =  1;
	}else {
		fillstartangle =  1.7;
		fillendangle   =  1.3; 
	}

	if( getHour(now) > getHour(event.time) ){
		var diff = 24 -  getHour(now); 
		var timeDiff = getHour(event.time) + diff ;


	}else{

		var timeDiff = getHour(event.time) - getHour(now) ;
	}
	
	if(timeDiff  != 0){ 
		timeDiff = timeDiff/time_inc ;
	}
	 
	var radius; 
	var logoradius;
	if( event.size == "L") {
		radius = 120; 
		logoradius = 70;
	}
	else if( event.size == "M") {
		radius = 90; 
		logoradius = 50;
	}
	else {
		radius = 70;
		logoradius = 40;
	}
	var distance = maxL - (  event.rank * 10 * maxL ) /100 ;
	
	var arc = new createjs.Shape();
	arc.graphics.beginFill("#fff");
	arc.graphics.setStrokeStyle(2);
	arc.graphics.beginStroke("#00a3e8").arc(linewd * (timeDiff + 1), distance , radius/2 , 0, event.mratio * Math.PI, false);
	stage.addChild(arc);
	arc.addEventListener("click", popup_evt_details);
	arc.name = event.id;
	

	arc = new createjs.Shape();
	arc.graphics.beginFill("#fff");
	arc.graphics.setStrokeStyle(2);
	arc.graphics.beginStroke("#FF99CC").arc(linewd * (timeDiff + 1), distance , radius/2 ,  event.mratio * Math.PI , 2 * Math.PI, false);
	stage.addChild(arc);
	

	arc.name = event.id;
	//arc.user = user_id;
	arc.addEventListener("click", popup_evt_details);
	
	
	//// Animation code start here
	// Create the sprite sheet
	
	
	// Create the bitmap animation from the spritesheet
	// and display the standing 
	var bubble = new createjs.BitmapAnimation(spritesheet);
	
	
	if( event.size == "L") {
		bubble.x = linewd * ( timeDiff + 1) - (radius/2) -27;
		bubble.y = distance -(radius/2) -27; 
		bubble.scaleX = .58;
		bubble.scaleY = .58;
	}
	else if( event.size == "M") {
	
		bubble.x = linewd * ( timeDiff + 1) - (radius/2) -19;
		bubble.y = distance -(radius/2) -19; 
		bubble.scaleX = .43;
		bubble.scaleY = .43;
	}
	else if( event.size == "S") {
	
		bubble.x = linewd * ( timeDiff + 1) - (radius/2) -15;
		bubble.y = distance -(radius/2) -15; 
		bubble.scaleX = .333;
		bubble.scaleY = .333;
	}
	
	
	bubble.gotoAndStop('stand');
	
	event.bubble = bubble;
	
	/*
	// Add click listener to trigger animation
	stage.onMouseDown = function() {
		bubble.gotoAndPlay('die');
	};
	*/
	// Reset player 1 second after death sequence finishes playing
	bubble.onAnimationEnd = function() {
		
		//centerPopup("popupeventdetails");
		//loadPopup("popupeventdetails");
		poppedBubble = event.bubble;
		/*
		setTimeout(function() {
	
		bubble.gotoAndStop('stand');
		}, 1000);
		*/
		
	};
	
	// Display container on screen
	stage.addChild(bubble);
	//// Animation code ends here

	var eventtypeimg = new Image();
	
	if( event.type ==  "4"){
		eventtypeimg.src = './module/popcliqsevents/static/image/football-icon.png';	
		
	} else if ( event.type ==  "6"){
		eventtypeimg.src = './module/popcliqsevents/static/image/prof.png';	
		
	} else if ( event.type ==  "1"){
		eventtypeimg.src = './module/popcliqsevents/static/image/arts.png';	
		
	} else if ( event.type ==  "7"){
		eventtypeimg.src = './module/popcliqsevents/static/image/education.png';	
	} else if ( event.type ==  "5"){
		eventtypeimg.src = './module/popcliqsevents/static/image/help.png';	
	} else if ( event.type ==  "3"){
		eventtypeimg.src = './module/popcliqsevents/static/image/adventure.png';	
	} else if ( event.type ==  "2"){
		eventtypeimg.src = './module/popcliqsevents/static/image/event.png';	
	}
	
	
	eventtypeimg.name = 'event1';
	eventtypeimg.onload = function() {
		
		var eventtypeimgB = new createjs.Bitmap(eventtypeimg);
		eventtypeimgB.x = linewd * ( timeDiff + 1) - (logoradius/2) -5	;
		eventtypeimgB.y = distance -(logoradius/2) + 0; 
		if( event.size == "L") {
			eventtypeimgB.scaleX = .3;
			eventtypeimgB.scaleY = .3;
		} else if( event.size == "M") {
			eventtypeimgB.scaleX = .2;
			eventtypeimgB.scaleY = .2;
		} else if( event.size == "S") {
			eventtypeimgB.scaleX = .19;
			eventtypeimgB.scaleY = .19;
		}
		stage.addChild(eventtypeimgB);
	
		var fillarc = new createjs.Shape();
		fillarc.alpha =.6;
		fillarc.graphics.beginFill("#66A3D2").arc(linewd * (timeDiff + 1), distance  , radius/2 -5, fillstartangle * Math.PI, fillendangle * Math.PI, false);
		stage.addChild(fillarc);
		
		drawWave(linewd * (timeDiff + 1) , distance, fillstartangle , fillendangle, radius/2 -5 );
	};
}
		
function drawWave(xp , yp, startA , endA, radius ){
  	  	
	var line = new createjs.Shape();
	
	var xmin = Math.round((xp +  radius * Math.cos(endA * Math.PI  )));
	var ymin = Math.round((yp +  radius * Math.sin(endA * Math.PI )));
 
	var xmax = Math.round((xp + radius * Math.cos(startA * Math.PI  )));
	var ymax = Math.round((yp + radius * Math.sin(startA * Math.PI )));
 
	line.alpha =.8;
	line.graphics.setStrokeStyle(5);
	line.graphics.moveTo(xmin,ymin);
	line.graphics.beginStroke("#66A3D2").lineTo(xmax,ymin);
	stage.addChild(line);
}
  	  
function tick() {        
	stage.update();
}

function drawFooter(){
	
	var arc = new createjs.Shape();
	arc.graphics.setStrokeStyle(2);
	arc.graphics.beginStroke("#ccc");
	arc.graphics.beginFill("#141C5C").arc(0, 650, 100, Math.PI*1.5, Math.PI*0.5, false);

    var hit = new createjs.Shape();
	hit.graphics.beginFill("#000").drawRect(0, 400, 200, 650);
	arc.hitArea = hit;

	arc.addEventListener("mouseover", archandleMouseOver);
	arc.addEventListener("mouseout", archandleMouseOut);
	
	
	var pqlabel = new createjs.Text("pq", "45px Arial", "#fff");
	pqlabel.x = 15;
	pqlabel.y = 575;

	stage.addChild(arc , pqlabel);

	prefcircle   	= new createjs.Shape();
	newevtcircle  	= new createjs.Shape();
	historycircle	= new createjs.Shape();
	
	prefcircle.graphics.setStrokeStyle(2);
	newevtcircle.graphics.setStrokeStyle(2);
	historycircle.graphics.setStrokeStyle(2);

	prefcircle.graphics.beginFill("#141C5C").drawCircle(0, 650, 40);
	newevtcircle.graphics.beginFill("#141C5C").drawCircle(0, 650, 40);
	historycircle.graphics.beginFill("#141C5C").drawCircle(0, 650, 40);
	
	
	preflabel = new createjs.Text("Preferences", "12px Arial", "#fff");
	preflabel.x = 10;
	preflabel.y = 490;
	
	
	newevtlabel = new createjs.Text("PopcliQ!", "12px Arial", "#fff");
	newevtlabel.x = 100;
	newevtlabel.y = 520;

	historylabel = new createjs.Text("History", "12px Arial", "#fff");
	historylabel.x = 135;
	historylabel.y = 600;
	
	prefcircle.addEventListener("click", popup_pref_win);
	newevtcircle.addEventListener("click", popup_new_evt_win);
	historycircle.addEventListener("click", popup_history_win);
	
}

function archandleMouseOut(evt){
     
	if( !ispredisplay ) {
		return;
	}
	Log.log("mouse out x: " + evt.stageX + " : " + evt.stageY);
	
	if( evt.stageX < 170 ) return;
	
	stage.removeChild(preflabel);
	stage.removeChild(newevtlabel );
	stage.removeChild(historylabel);
	
	//stage.update();
	createjs.Tween.get(prefcircle,{loop:false,override:true})
		.to({ x: -40,y:150}, 1000, createjs.Ease.get(1)); // jump to the new scale properties (default duration of 0)
	
	//120 280
	createjs.Tween.get(newevtcircle,{loop:false, override:true})
		.to({ x: -120,y:120}, 1000, createjs.Ease.get(1)); 
	
	//150 360
	createjs.Tween.get(historycircle,{loop:false, override:true})
		.to({ x: -150,y:40}, 1000, createjs.Ease.get(1)); 
	
	ispredisplay = false;
}
	
function archandleMouseOver(evt){

	Log.log("mouse over x: " + evt.stageX + " : " + evt.stageY);
	
	//return;
	if( ispredisplay )  return;
	
	createjs.Tween.get(prefcircle,{override:true})
		.to({ x: 40,y:-150}, 1000, createjs.Ease.get(1)); // jump to the new scale properties (default duration of 0)
	
	//120 280
	createjs.Tween.get(newevtcircle,{loop:false, override:true})
		.to({ x: 120,y:-120}, 1000, createjs.Ease.get(1)); 
		
	//150 360
	createjs.Tween.get(historycircle,{loop:false, override:true})
		.to({ x: 150,y:-40}, 1000, createjs.Ease.get(1)).call(displayLabel); 
	
	stage.addChild(prefcircle);
	stage.addChild(newevtcircle);
	stage.addChild(historycircle);
	
	ispredisplay = true;
}

function displayLabel(){

	stage.addChild( preflabel);
	stage.addChild(newevtlabel);
	stage.addChild(historylabel);
}

function addtime ( time ,  addhr ){

	var timeStr; 
	var parts = time.split(':'),
	hour = parts[0],
	minutes = parts[1];
	hour =  parseInt( hour ) + addhr;
	if(hour > 23 ) {
		hour = hour - 24;
	}
	//alert(time + " ::: " + addhr  + " == " +  hour + ":" + minutes); 
 	return hour + ":" + minutes;
}

function getTime(time){

	var timeStr; 
	var parts = time.split(':'),
	hour 	  = parts[0],
	minutes   = parts[1];
	
	if (hour > 12) {
		timeStr = (hour - 12) + ' pm';
	} else if (hour == 0) {
		timeStr = 12 + ' am';
	} else if (hour == 12) {
		timeStr = time + 'pm';
	} else {
		timeStr = '  ' + hour + ' am';
	}
	return timeStr;
}

function getHour(time){
		
	var timeStr; 
	var parts 	= time.split(':'),
	hour 		= parts[0];	
	return parseInt(hour);		
}

function popup_new_evt_win(evt){
	centerPopup("popupnewevent");
	loadPopup("popupnewevent");
	$( "#startTime" ).datepicker();
	$( "#endTime" ).datepicker();
}

function popup_history_win(evt){
	centerPopup("popuphistory");
	loadPopup("popuphistory");
}

function popup_pref_win(evt){
	centerPopup("popuppref");
	//load popup
	loadPopup("popuppref");
}

function popup_evt_details(evt){
	
	console.log(evt.target.name + " Was Clicked");
	for (var i=0; i<eventlist.length; i++){
		if(eventlist[i].id  == evt.target.name ){
			eventlist[i].bubble.gotoAndPlay('die');
			break;
		}
	}
	centerPopup("popupeventdetails");
	loadPopup("popupeventdetails" , evt.target.name , $user_id);
}

function create_event(){
	alert("here i am ");
}