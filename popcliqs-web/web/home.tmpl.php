<!DOCTYPE HTML>
<html>
<head>
  <title>Popcliqs - Home</title>
  <link rel="stylesheet" type="text/css" href="web/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="web/css/popcliqs.css">
  <link rel="stylesheet" type="text/css" href=" http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery.ui.all.css">
 
  <meta name="viewport" content="width=device-width">
</head>
<body onresize="redraw()">
<!-- nav bar--> 
<div class="navbar-fixed-top navbar-green" >
</div>

<div class=" navbar-fixed-top navbar-blue" >
    <div class="navbar-header">
      <form class="" method="post" action="logout.php">
        <button type="submit" class="navbar-toggle collapsed backgroundColor1" >
         <span class="glyphicon glyphicon-off"></span>
        </button>
      </form>
      <button type="button" class="navbar-toggle collapsed backgroundColor1" data-toggle="collapse" data-target=".navbar-collapse" >
       <span class="glyphicon glyphicon-search"></span>
      </button>
       <div class="container" style="height:60px;">
            <a class="brand" href="home.php"> <span  style="position:relative;top:-20px;" ><img src="web/img/4.png"/></span></a>
      </div>
    </div>
    <div class="navbar-collapse collapse backgroundColor" style="height:1px;">
      <form class="navbar-form navbar-right" method="post" action="logout.php">
        <button type="submit" class="btn backgroundColor1"> 
          <span class="glyphicon glyphicon-off"></span>
        </button>
      </form>
      &nbsp;&nbsp;&nbsp;
      <form class="navbar-form navbar-right" >
        <div class="form-group">
          <select name="category" id="category" onchange="this.form.submit()" class="form-control">
            <option value="0">All</option>
            <option value="4">Sports</option>
            <option value="6">Professional</option>
            <option value="7">Education</option>
            <option value="5">Support Group</option>
            <option value="1">Arts</option>
            <option value="3">Outdoor</option>
            <option value="2">Party</option>
            <option value="8">Other</option>
          </select>
        </div>
        <div class="form-group">
          <select name="ti" id="ti" onchange="this.form.submit()" class="form-control">
            <option value="8">8 Hours</option>
              <option value="24">24 Hours</option>
              <option value="72">3 Days</option>
          </select>
        </div>
        <div class="form-group">
         <input type="search" name="search_t" id="search_t" placeholder="Search" class="form-control">
        </div> 
        <button type="submit" class="btn backgroundColor1">
          <span class="glyphicon glyphicon-search"></span>
        </button>
      </form>
    </div>
  </div>
  <br>
  <div class="container">
   <div class="row" style="margin-top:80px;">
    <div class="col-lg-12 visible-lg" id ="wapper-canvas-lg">
       <canvas   width="1200" height="500" style="background:;" id="mainCanvas-lg"></canvas>     
    </div>
    <div class="col-md-12 visible-md" style="" id ="wapper-canvas-md">
        <canvas   width="992" height="500" style="background:;" id="mainCanvas-md"></canvas>    

    </div>
    <div class="col-sm-12 visible-sm"  style="" id ="wapper-canvas-sm" >
      <canvas   width="768" height="500" style="background:;" id="mainCanvas-sm"></canvas>    

    </div>
    <div class="col-sm-12 visible-xs"  style="" id ="wapper-canvas-xs"> 
      <canvas   width="480" height="500" style="background:;" id="mainCanvas-xs"></canvas>    
    </div>
          
    </div>
  </div>
<hr>
<div class="container">
  <footer>
    <p>&copy; 2013 Popcliqs.com, <a href="#">About</a> | <a href="#">Privacy</a> | <a href="#">Terms</a></p>
  </footer>
</div>

<!-- Modal -->
<div class="modal fade" id="mypref" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Prefrences</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <img src="/web/img/football-icon.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Sports</label>
            <div class="col-lg-7">
              <input type="radio" id="cat_1_0" name="cat_1" value="0" placeholder="" />
              <input type="radio" id="cat_1_1" name="cat_1" value="1" placeholder="" />
              <input type="radio" id="cat_1_2" name="cat_1" value="2" placeholder="" />
            </div>
        </div><br/>
        <div class="form-group">
            <img src="/web/img/prof.png"  class="col-lg-1 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Professional</label>
            <div class="col-lg-7">

              <input type="radio" id="cat_2_0" name="2" value="0" placeholder="" />
              <input type="radio" id="cat_2_1" name="2" value="1" placeholder="" />
              <input type="radio" id="cat_2_2" name="2" value="2" placeholder="" />

            </div>
        </div><br/>
        <div class="form-group">
            <img src="/web/img/arts.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Arts</label>
            <div class="col-lg-7">

              <input type="radio" id="cat_3_0" name="3" value="0" placeholder="" />
              <input type="radio" id="cat_3_1" name="3" value="1" placeholder="" />
              <input type="radio" id="cat_3_2" name="3" value="2" placeholder="" />

            </div>
        </div><br/>
        <div class="form-group">
            <img src="/web/img/education.png"  class="col-lg-1 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Education</label>
            <div class="col-lg-7">

              <input type="radio" id="cat_4_0" name="4" value="0" placeholder="" />
              <input type="radio" id="cat_4_1" name="4" value="1" placeholder="" />
              <input type="radio" id="cat_4_2" name="4" value="2" placeholder="" />

            </div>
        </div><br/>
        <div class="form-group">
            <img src="/web/img/help.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Self Help</label>
            <div class="col-lg-7">

              <input type="radio" id="cat_5_0" name="5" value="0" placeholder="" />
              <input type="radio" id="cat_5_1" name="5" value="1" placeholder="" />
              <input type="radio" id="cat_5_2" name="5" value="2" placeholder="" />

            </div>
        </div><br/>
        <div class="form-group">
            <img src="/web/img/adventure.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Outdoor</label>
            <div class="col-lg-7">

              <input type="radio" id="cat_6_0" name="6" value="0" placeholder="" />
              <input type="radio" id="cat_6_1" name="6" value="1" placeholder="" />
              <input type="radio" id="cat_6_2" name="6" value="2" placeholder="" />

            </div>
        </div><br/>
        <div class="form-group">
            <img src="/web/img/event.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Party</label>
            <div class="col-lg-7">
              <input type="radio" id="cat_7_0" name="7" value="0" placeholder="" />
              <input type="radio" id="cat_7_1" name="7" value="1" placeholder="" />
              <input type="radio" id="cat_7_2" name="7" value="2" placeholder="" />
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  onclick="update_user_pref();">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="event_form" name="event_form" method="post" action="event.php">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">PopcliQ! - Create New Event</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="title" class="col-lg-2 control-label">Title</label>
            <div class="col-lg-8">
              <input type="text" id="title" name="title" class="form-control" placeholder="" />
            </div>
          </div>
          <div class="form-group">
            <label for="description" class="col-lg-2 control-label">Description</label>
            <div class="col-lg-8">
              <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="category_id" class="col-lg-2 control-label">Category</label>
            <div class="col-lg-8">
              <select id="category_id" name="category_id" class="form-control" >
                <option value="">[Select]</option>
                <option value="1">Sports</option>
                <option value="2">Professional</option>
                <option value="3">Education</option>
                <option value="4">Support Group</option>
                <option value="5">Arts</option>
                <option value="6">Outdoor</option>
                <option value="7">Party</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="location" class="col-lg-2 control-label">Location</label>
            <div class="col-lg-8">
              <input type="text" id="location" name="location"  class="form-control" placeholder="" />
            </div>
          </div>
          <div class="form-group">
            <label for="address" class="col-lg-2 control-label">Address</label>
            <div class="col-lg-8">
              <textarea class="form-control" name="address" id="address" rows="4"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="postal_code" class="col-lg-2 control-label">Zip</label>
            <div class="col-lg-8">
              <input type="text" id="postal_code" name="postal_code" class="form-control" placeholder=""  />
            </div>
          </div>
          <div class="form-group">
            <label for="contact-email" class="col-lg-2 control-label" style="padding-top:0px;">Age limit</label>
            <div class="col-lg-8" style="padding-top:0px;">
              <input type="radio" id="age_limit" value="1"  placeholder=""> Anyone    &nbsp;
              <input type="radio" id="age_limit" value="2" placeholder=""> Above 18  &nbsp;
              <input type="radio" id="age_limit" value="3"  placeholder=""> Above 21  &nbsp;
            </div>
          </div>
          <div class="form-group">
            <label for="capacity" class="col-lg-2 control-label">Capacity</label>
            <div class="col-lg-8">
              <input type="text" id="capacity" name=="capacity" value="" class="form-control" placeholder="" />
            </div>
          </div>
           <div class="form-group">
            <label for="start_date" class="col-lg-2 control-label" style="padding-left:0px;">Start time</label>
            <div class="col-lg-8">
              <input type="text" id="start_date" name="start_date" class="form-control" placeholder="" style="width:192px;display:inline-block;" />
              <select id="start_time" name="start_time" class="form-control" style="width:150px;display:inline-block;">
                  <option value="00:00">12:00 AM</option>
                  <option value="00:30">12:30 AM</option>
                  <option value="01:00">1:00 AM</option>
                  <option value="01:30">1:30 AM</option>
                  <option value="02:00">2:00 AM</option>  
                  <option value="02:30">2:30 AM</option>  
                  <option value="03:00">3:00 AM</option>
                  <option value="03:30">3:30 AM</option>
                  <option value="04:00">4:00 AM</option>
                  <option value="04:30">4:30 AM</option>
                  <option value="05:00">5:00 AM</option>  
                  <option value="05:30">5:30 AM</option>   
                  <option value="06:00">6:00 AM</option>
                  <option value="06:30">6:30 AM</option>
                  <option value="07:00">7:00 AM</option>
                  <option value="07:30">7:30 AM</option>
                  <option value="08:00">8:00 AM</option>   
                  <option value="08:30">8:30 AM</option>   
                  <option value="09:00">9:00 AM</option>
                  <option value="09:30">9:30 AM</option>   
                  <option value="10:00">10:00 AM</option>
                  <option value="10:30">10:30 AM</option>
                  <option value="11:00">11:00 AM</option>
                  <option value="11:30">11:30 AM</option>
                  <option value="12:00">12:00 PM</option> 
                  <option value="12:30">12:30 PM</option>  
                  <option value="13:00">1:00 PM</option>
                  <option value="13:30">1:30 PM</option>
                  <option value="14:00">2:00 PM</option>
                  <option value="14:30">2:30 PM</option>
                  <option value="15:00">3:00 PM</option>
                  <option value="15:30">3:30 PM</option>
                  <option value="16:00">4:00 PM</option>
                  <option value="16:30">4:30 PM</option>
                  <option value="17:00">5:00 PM</option>
                  <option value="17:30">5:30 PM</option>
                  <option value="18:00">6:00 PM</option>
                  <option value="18:30">6:30 PM</option>
                  <option value="19:00">7:00 PM</option>
                  <option value="19:30">7:30 PM</option>
                  <option value="20:00">8:00 PM</option>
                  <option value="20:30">8:30 PM</option>
                  <option value="21:00">9:00 PM</option> 
                  <option value="21:30">9:30 PM</option>
                  <option value="22:00">10:00 PM</option>
                  <option value="22:30">10:30 PM</option>
                  <option value="23:00">11:00 PM</option>
                  <option value="23:30">11:30 PM</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label for="end_date" class="col-lg-2 control-label">End time</label>
            <div class="col-lg-8">
              <input type="text" id="end_date" name="end_date" class="form-control" placeholder="" style="width:190px;display:inline-block;"/>
              <select id="end_time" name="end_time" class="form-control" style="width:150px;display:inline-block;">
                <option value="00:00">12:00 AM</option>
                <option value="00:30">12:30 AM</option>
                <option value="01:00">1:00 AM</option>
                <option value="01:30">1:30 AM</option>
                <option value="02:00">2:00 AM</option>  
                <option value="02:30">2:30 AM</option>  
                <option value="03:00">3:00 AM</option>
                <option value="03:30">3:30 AM</option>
                <option value="04:00">4:00 AM</option>
                <option value="04:30">4:30 AM</option>
                <option value="05:00">5:00 AM</option>  
                <option value="05:30">5:30 AM</option>   
                <option value="06:00">6:00 AM</option>
                <option value="06:30">6:30 AM</option>
                <option value="07:00">7:00 AM</option>
                <option value="07:30">7:30 AM</option>
                <option value="08:00">8:00 AM</option>   
                <option value="08:30">8:30 AM</option>   
                <option value="09:00">9:00 AM</option>
                <option value="09:30">9:30 AM</option>   
                <option value="10:00">10:00 AM</option>
                <option value="10:30">10:30 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="11:30">11:30 AM</option>
                <option value="12:00">12:00 PM</option> 
                <option value="12:30">12:30 PM</option>  
                <option value="13:00">1:00 PM</option>
                <option value="13:30">1:30 PM</option>
                <option value="14:00">2:00 PM</option>
                <option value="14:30">2:30 PM</option>
                <option value="15:00">3:00 PM</option>
                <option value="15:30">3:30 PM</option>
                <option value="16:00">4:00 PM</option>
                <option value="16:30">4:30 PM</option>
                <option value="17:00">5:00 PM</option>
                <option value="17:30">5:30 PM</option>
                <option value="18:00">6:00 PM</option>
                <option value="18:30">6:30 PM</option>
                <option value="19:00">7:00 PM</option>
                <option value="19:30">7:30 PM</option>
                <option value="20:00">8:00 PM</option>
                <option value="20:30">8:30 PM</option>
                <option value="21:00">9:00 PM</option> 
                <option value="21:30">9:30 PM</option>
                <option value="22:00">10:00 PM</option>
                <option value="22:30">10:30 PM</option>
                <option value="23:00">11:00 PM</option>
                <option value="23:30">11:30 PM</option>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="create_event();">Save</button>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">History</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" id="historyTab">
          <li class="active" id="history-att"><a href="#attended" data-toggle="tab">Attended</a></li>
          <li id="history-int"><a href="#initiated" data-toggle="tab">Initiated</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="attended">...</div>
          <div class="tab-pane" id="initiated">...</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="eventdetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Event Details</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="title" class="col-lg-2 control-label">Title</label>
          <div class="col-lg-8">
            <P id="e_title"></P>
          </div>
        </div><br>
        <div class="form-group">
          <label for="title" class="col-lg-2 control-label">Description</label>
          <div class="col-lg-8">
            <P id="e_desc"></P>
          </div>
        </div>
        <br/>
        <div class="form-group">
          <label for="title" class="col-lg-2 control-label">Start</label>
          <div class="col-lg-8">
            <P id="e_start"></P>
          </div>
        </div>
        <br/>
        <div class="form-group">
          <label for="title" class="col-lg-2 control-label">End</label>
          <div class="col-lg-8">
            <P id="e_end"></P>
          </div>
        </div>
        <br>
        <div class="form-group">
          <label for="title" class="col-lg-2 control-label">Location</label>
          <div class="col-lg-8">
            <P id="e_loc"></P>
          </div>
        </div>
        <br/>
        <div class="form-group">
          <label for="title" class="col-lg-2 control-label">Address</label>
          <div class="col-lg-8">
            <P id="e_add"></P>
          </div>
        </div>
        <br/>
         <div class="form-group">
          <label for="title" class="col-lg-2 control-label">Zip</label>
          <div class="col-lg-8">
            <P id="e_zip"></P>
          </div>
        </div>
        <br/>
        <div class="form-group">
          <label for="title" class="col-lg-2 control-label">Distance</label>
          <div class="col-lg-8">
            <P id="e_dist"></P>
          </div>
        </div>
        <br/>
        <div class="form-group">
          <label for="title" class="col-lg-2 control-label">Age Limit</label>
          <div class="col-lg-8">
            <P id="e_alimit"></P>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="save_btn" class="btn btn-primary">Pop It!</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--script src="js/jquery.js" ></script-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="web/js/easeljs-0.6.0.min.js"></script>
<script type="text/javascript" src="web/js/tweenjs-0.4.0.min.js"></script>
<script src="web/js/bootstrap.js" ></script>
<script src="web/js/popcliqs_canvas.js" ></script>
<script src="web/js/popcliqs_actions.js" ></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
  
  $(function() { 
     fetchEvents();
     // redraw();
  });
  $('#historyTab').click(function (e) {
    alert("history" + e.target);
  });

  $(function() {
    $( "#start_date" ).datepicker();
  });

  $(function() {
    $( "#end_date" ).datepicker();
  });

</script>
</script>
</body>
</html>
