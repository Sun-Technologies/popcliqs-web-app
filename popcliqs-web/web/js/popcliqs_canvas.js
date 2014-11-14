var canvasstr ; 
var ispredisplay = false;
var Log;
var $time_interval = 8;
var poppedBubble;
var stage;
var event1  = new Object();
event1.id   = "evt01";
event1.size = "S";
event1.type = "4"; //sports , professional , arts ,edu, adventure
event1.time = "21:00";
event1.fillPCent = 0;
event1.rank = 5;
event1.mratio=0.5; // Max value 2


var event2  = new Object();
event2.id   = "evt02";
event2.size = "S";
event2.type = "4";
event2.time = "23:00";
event2.fillPCent = 24;
event2.rank = 3;
event2.mratio=0.4;

var event3  = new Object();
event3.id   = "evt03";
event3.size = "S";
event3.type = "4";
event3.time = "1:00"
event3.fillPCent = 7;
event3.rank = 5;
event3.mratio=1.4;


$cat_type = 0;
var maxL = 465;
var eventlist ;



/*
 * Redraw 
 */
function redraw(eventarr , redraw){
  
  // eventlist = new Array(event1,event2,event3);
  if(eventarr != null){
    eventlist = eventarr;
  }
  

  var w = window.innerWidth;
  var h = window.innerHeight;
 
  if( $("#wapper-canvas-lg").css('display') == 'block'){
      newcanvas = "mainCanvas-lg";
    
  }else if( $("#wapper-canvas-md").css('display') == 'block'){
    newcanvas = "mainCanvas-md";

   }else if( $("#wapper-canvas-sm").css('display') == 'block'){
    newcanvas = "mainCanvas-sm";


  }else{
    if(w < 500){
      newcanvas = "mainCanvas-mob";
      document.getElementById("mainCanvas-xs").hidden = true;
    }else{
      newcanvas = "mainCanvas-xs";
    }
  }

  if(canvasstr != newcanvas || redraw ){
    //alert(" change in canvas");
    canvasstr = newcanvas;
    if( stage != null){
      stage.removeAllChildren();
      stage.update();
    }
    draw();
  }
}

function draw() {

  var canvas = document.getElementById(canvasstr);
  stage = new createjs.Stage(canvas);
  
  // stage.clear();
  //stage.update();

  spritesheet = new createjs.SpriteSheet({
    images: ['./web/img/animation-1.png'],
    frames: {width: 300, height: 300},
    animations: {   
      stand: 0, // 1 frame of the player standing
      die: [1, 5, false] // 5 frame death sequence
    }
  });

  drawFooter();

  drawBody(canvas);

  createjs.Ticker.setFPS(20);
              
      // in order for the stage to continue to redraw when the Ticker is paused we need to add it with
      // the second ("pauseable") param set to false.
  createjs.Ticker.addEventListener("tick", tick); 
}

function drawBody(canvas){
 
  var dt = new Date();
  now = dt.getHours() + ":00"  ;
  linewd = canvas.width/10;
  var timex = linewd;
  
  var time_inc = 1;
  if($time_interval == 24){
    time_inc = 3;
  }else if($time_interval == 72){
    time_inc = 9;
  }
  
  var time_line = 0; 
  var bg = new createjs.Shape();

  stage.addChild(bg);
  stage.enableMouseOver();
  bg.graphics.beginStroke("#9F9F9F");

  if($time_interval != 72){
    displayTime(timex , 'Now' , stage , 10 );
  } else{
    displayTime(timex , 'Now' , stage , 10 );
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
    displayTime(timex , 'Next 24hrs' , stage );
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
    displayTime(timex , 'Next 72hrs' , stage );
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
  //Draw all the events.
  for (var i=0; i < eventlist.length ; i++){
     drawEvent( eventlist[i] , time_inc ); 
  }
}

/*
 *  alignbuf - is used to align Now string.
 */
function displayTime(timex , msgTxt , stage , alignbuf  ){
  if (newcanvas ===  "mainCanvas-mob"){
    var msg = new createjs.Text(msgTxt, '9pt Calibri', '#9F9F9F');
  }else {  
    var msg = new createjs.Text(msgTxt, '11pt Calibri', '#9F9F9F');
  }
  stage.addChild(msg);
  
  if(alignbuf != null){
    msg.x = timex - 25  + alignbuf;
  } else{
    msg.x = timex - 25 ;
  }
  msg.y = 0;
}

function drawVertTimeLine( timex , canvas ,bg ){
  
  for ( var i = 0 ; i < canvas.height -10 ; ){

    i = i +20;
    bg.graphics.moveTo(timex, i);
    
    i = i +10;
    bg.graphics.lineTo(timex, i);
  }
}

function tick() {
   stage.update();
}

function drawFooter(){

  var arc = new createjs.Shape();
  arc.graphics.setStrokeStyle(2);
  arc.graphics.beginStroke("#ccc");

  if(newcanvas === "mainCanvas-xs" ) {
    arc.graphics.beginFill("#BDCB00").arc(0, 500, 70, 0, Math.PI*2);
  } else if (newcanvas ===  "mainCanvas-mob"){
    arc.graphics.beginFill("#BDCB00").arc(0, 400, 60, 0, Math.PI*2);
  }else{
    arc.graphics.beginFill("#BDCB00").arc(0, 500, 100, 0, Math.PI*2);
  }
  

  arc.onMouseOver = function(evt) { 
    evt.target.cursor = 'pointer' ;
  }

  arc.onClick = function(evt) { 
    archandleMouseClick() ;
  }
  

  if(newcanvas == "mainCanvas-xs" ) {
    var pqlabel = new createjs.Text("pq", "35px Baumans", "#278AD2");
    pqlabel.x = 10;
    pqlabel.y = 440;
  } else if (newcanvas ===  "mainCanvas-mob"){
    var pqlabel = new createjs.Text("pq", "30px Baumans", "#278AD2");
    pqlabel.x = 10;
    pqlabel.y = 350;
  }else{
    
    var pqlabel = new createjs.Text("pq", "45px Baumans", "#278AD2");
    pqlabel.x = 15;
    pqlabel.y = 425;
  }

  stage.addChild(arc , pqlabel);
  stage.update();

  prefcircle    = new createjs.Shape();
  newevtcircle  = new createjs.Shape();
  historycircle = new createjs.Shape();
  
  prefcircle.graphics.setStrokeStyle(2);
  newevtcircle.graphics.setStrokeStyle(2);
  historycircle.graphics.setStrokeStyle(2);

  if (newcanvas ===  "mainCanvas-mob"){
    prefcircle.graphics.beginFill("#1E80C4").drawCircle(0, 450, 40);
    newevtcircle.graphics.beginFill("#1E80C4").drawCircle(0, 450, 40);
    historycircle.graphics.beginFill("#1E80C4").drawCircle(0, 450, 40);

    preflabel = new createjs.Text("Settings", "13px Verdana, Geneva, sans-serif", "#ffffff");
    preflabel.x = 14;
    preflabel.y = 248;
    
    
    newevtlabel = new createjs.Text("New Cliq", "13px Verdana, Geneva, sans-serif", "#ffffff");
    newevtlabel.x = 100;
    newevtlabel.y = 260;

    historylabel = new createjs.Text("My Cliqs", "13px Verdana, Geneva, sans-serif", "#ffffff");
    historylabel.x = 115;
    historylabel.y = 345;
  }else {
    prefcircle.graphics.beginFill("#1E80C4").drawCircle(0, 550, 40);
    newevtcircle.graphics.beginFill("#1E80C4").drawCircle(0, 550, 40);
    historycircle.graphics.beginFill("#1E80C4").drawCircle(0, 550, 40);

    preflabel = new createjs.Text("Settings", "13px Verdana, Geneva, sans-serif", "#ffffff");
    preflabel.x = 14;
    preflabel.y = 348;
  
  
    newevtlabel = new createjs.Text("New Cliq", "13px Verdana, Geneva, sans-serif", "#ffffff");
    newevtlabel.x = 100;
    newevtlabel.y = 360;

    historylabel = new createjs.Text("My Cliqs", "13px Verdana, Geneva, sans-serif", "#ffffff");
    historylabel.x = 115;
    historylabel.y = 445;
  }
  
  

  stage.addChild(prefcircle);
  stage.addChild(newevtcircle);
  stage.addChild(historycircle);

  prefcircle.onMouseOver = function(evt) { 
    evt.target.cursor = 'pointer' ;
  }
  
  prefcircle.onClick = function(evt) { 
    open_pref(); 
  }

  newevtcircle.onMouseOver = function(evt) { 
     evt.target.cursor = 'pointer' ;
  }

  newevtcircle.onClick = function(evt) { 
    open_newEvent(); 
  }

  historycircle.onMouseOver = function(evt) { 
    evt.target.cursor = 'pointer' ;
  }

  historycircle.onClick = function(evt) { 
    open_history(); 
  }

  stage.update();
}

function open_pref(){

   fetch_pref();
}

function open_newEvent(){

  initialize_geo();

  $('#newEvent').modal('show');

}

function open_history(){
  $('#history').modal('show');
  

  if($('#history-int').hasClass( "active" )){

    fetch_initiated_events();
  }else if($('#history-interest').hasClass( "active" )) {

    fetch_interested_events();
  }else if($('#history-att').hasClass( "active" )) {
     
     fetch_attended_events();
  }
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
  var parts = time.split(':');
  hour      = parts[0],
  minutes   = parts[1];
  
  if (hour > 12) {
    timeStr = (hour - 12) + ' pm';
  } else if (hour == 0) {
    timeStr = 12 + ' am';
  } else if (hour == 12) {
    timeStr = hour + ' pm';
  } else {
    timeStr = '  ' + hour + ' am';
  }
  return timeStr;
}

function getHour(time){
  
  // alert(time);
  var timeStr; 
  var parts = time.split(':'),
  hour = parts[0];  
  return parseInt(hour);    
}

function archandleMouseClick (argument) {

  if(!ispredisplay){
    display_actions();
  }else{
   hide_actions();
  }
  ispredisplay = !ispredisplay;
}
  
function displayLabel(){
       
  stage.addChild( preflabel);
  stage.addChild(newevtlabel);
  stage.addChild(historylabel);
}

function display_actions(){

 createjs.Tween.get(prefcircle,{loop:false,override:true})
           .to({ x: 40,y:-190}, 1000, createjs.Ease.get(1)); // jump to the new scale properties (default duration of 0)
  
  // //120 280
  createjs.Tween.get(newevtcircle,{loop:false, override:true})
          .to({ x: 128,y:-180}, 1000, createjs.Ease.get(1)); 
  
  //150 360
  createjs.Tween.get(historycircle,{loop:false, override:true})
          .to({ x: 140,y:-95}, 1000, createjs.Ease.get(1)).call(displayLabel); 

  stage.addChild(prefcircle);
  stage.addChild(newevtcircle);
  stage.addChild(historycircle);

  stage.update(); 
}

function hide_actions(){

  stage.removeChild(preflabel);
  stage.removeChild(newevtlabel );
  stage.removeChild(historylabel);

  createjs.Tween.get(prefcircle,{loop:false,override:true})
             .to({ x:-40, y:190}, 1000, createjs.Ease.get(1)); // jump to the new scale properties (default duration of 0)
    
    // //120 280
  createjs.Tween.get(newevtcircle,{loop:false, override:true})
            .to({ x:-125, y:180}, 1000, createjs.Ease.get(1)); 
    
    //150 360
  createjs.Tween.get(historycircle,{loop:false, override:true})
            .to({ x:-150, y:100}, 1000, createjs.Ease.get(1)); 

  stage.update(); 
}

function drawEvent(  event , time_inc  ){


  if($cat_type != 0 && $cat_type != event.type){
    return;
  }

  var fillstartangle ;
  var fillendangle ;
  if(event.fillPCent <= 0){
    fillstartangle =  0;
    fillendangle   =  0;
    
  }
  else if(event.fillPCent <= 10){
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

  var timeDiff = event.time_diff;
  if(timeDiff  != 0){ 
    timeDiff = timeDiff/time_inc ;
  }
  
  //alert( "time_inc " + time_inc + " timeDiff " + timeDiff +  " timediff" + event.time_diff); 
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
  arc.onMouseOver = function(evt) { 
    evt.target.cursor = 'pointer' ;
  }
  arc.name = event.id;
  

  arc = new createjs.Shape();
  arc.graphics.beginFill("#fff");
  arc.graphics.setStrokeStyle(2);
  arc.graphics.beginStroke("#FF99CC").arc(linewd * (timeDiff + 1), distance , radius/2 ,  event.mratio * Math.PI , 2 * Math.PI, false);
  stage.addChild(arc);
  

  arc.name = event.id;
  //arc.user = user_id;
  arc.addEventListener("click", popup_evt_details);
  
  arc.onMouseOver = function(evt) { 
    evt.target.cursor = 'pointer' ;
  }
  
  
  //// Animation code start here
 
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
  
  if( event.type ==  "1"){
    eventtypeimg.src = './web/img/football-icon.png';  
  } else if ( event.type ==  "2"){
    eventtypeimg.src = './web/img/prof.png'; 
  } else if ( event.type ==  "3"){
    eventtypeimg.src = './web/img/education.png'; 
  } else if ( event.type ==  "4"){
    eventtypeimg.src = './web/img/help.png';  
  } else if ( event.type ==  "5"){
    eventtypeimg.src = './web/img/arts.png'; 
  } else if ( event.type ==  "6"){
    eventtypeimg.src = './web/img/adventure.png';  
  } else if ( event.type ==  "7"){
    eventtypeimg.src = './web/img/party.png';  
  } else if ( event.type ==  "8"){
    eventtypeimg.src = './web/img/social.png';  
  }
  
  eventtypeimg.name = 'event1';
  eventtypeimg.onload = function() {
    
  var eventtypeimgB = new createjs.Bitmap(eventtypeimg);
  eventtypeimgB.x = linewd * ( timeDiff + 1) - (logoradius/2) -5  ;
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

function popup_evt_details(evt){
    
  // console.log(evt.target.name + " Was Clicked");

  for (var i=0; i< eventlist.length; i++){
    if(eventlist[i].id  == evt.target.name ){
      
      eventlist[i].bubble.gotoAndPlay('die');
      fetch_event_details(eventlist[i].id);
      break;
    }
  }
}

$('#eventdetails').on('hidden.bs.modal', function () {
     poppedBubble.gotoAndStop('stand');
});

function fetchEvents(){

  $time_interval = $("#ti").val(); 
  $cat_type      = $("#category").val();
  $search_t      = $("#search_t").val();

  document.cookie = "ti="+$time_interval;
  document.cookie = "category="+$cat_type;

  var dt = new Date()
  var tz = dt.getTimezoneOffset();

  var url  = 'fetch_event.php';
  var data = "time_interval=" + $time_interval   +  "&cat_type=" + $cat_type  + "&tz=" + tz + '&s=' + $search_t; 
  
  // alert(data);
  $.ajax({
      type: "POST",
      dataType: "json",
      url: url,
      data: data,
      success: fetch_event_success
    });
}

function fetch_event_success(data, textStatus, jqXHR){
  
  if(data.exit_cd == 0 ){
      // alert(data.events.length);
    redraw(data.events , true);

  }else{
      alert(data.msg);
  }
 
}