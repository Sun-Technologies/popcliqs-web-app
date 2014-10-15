<?php 
  error_log("ti =  " .$_COOKIE["ti"])
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=0">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <title>Popcliqs - Home</title>
  <link rel="stylesheet" type="text/css" href="web/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="web/css/popcliqs.css">
  <link rel="stylesheet" type="text/css" href=" http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery.ui.all.css">
  <link href='http://fonts.googleapis.com/css?family=Baumans' rel='stylesheet' type='text/css'>
</head>
<body onresize="redraw()">
<!-- nav bar--> 
<!-- <div class="navbar-fixed-top navbar-green" >
</div> -->

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
       <div class="container" style="height:70px;">
            <a class="brand" href="home.php"> <span  style="position:relative;top:6px;" ><img src="./web/img/3.png"/></span></a>
      </div>
    </div>
    <div class="navbar-collapse collapse backgroundColor" id="navbar_id" style="height:1px;">
      <form class="navbar-form navbar-right" method="post" action="logout.php">
        <button type="submit" class="btn backgroundColor1"> 
          <span class="glyphicon glyphicon-off"></span>
        </button>
      </form>
      
      <form class="navbar-form navbar-right" action="javascript:fetchEvents();" >
        <div class="form-group">
          <?php
            $cat_selected = isset($_COOKIE["category"]) ? $_COOKIE["category"] : 0;
          ?>
          <select name="category" id="category" onchange="fetchEvents()" class="form-control" >
            <option value="0" <?php echo $cat_selected == 0 ?  "selected" : ""?> >All</option>
            <option value="1" <?php echo $cat_selected == 1 ?  "selected" : ""?> >Sports</option>
            <option value="2" <?php echo $cat_selected == 2 ?  "selected" : ""?> >Professional</option>
            <option value="3" <?php echo $cat_selected == 3 ?  "selected" : ""?> >Arts</option>
            <option value="4" <?php echo $cat_selected == 4 ?  "selected" : ""?> >Education</option>
            <option value="5" <?php echo $cat_selected == 5 ?  "selected" : ""?> >Support Group</option>
            <option value="6" <?php echo $cat_selected == 6 ?  "selected" : ""?> >Outdoor</option>
            <option value="7" <?php echo $cat_selected == 7 ?  "selected" : ""?> >Party</option>
            <option value="8" <?php echo $cat_selected == 8 ?  "selected" : ""?> >Social</option>
          </select>
        </div>
        <div class="form-group">
          <?php
            $ti_selected = isset($_COOKIE["ti"]) ? $_COOKIE["ti"] : 24;
          ?>
          <select name="ti" id="ti" onchange="fetchEvents()" class="form-control" 
              value="<?php echo isset($_COOKIE["ti"]) ? $_COOKIE["ti"] : 24 ?>">
            <option value="24" <?php echo $ti_selected == 24 ?  "selected" : ""?> >24 Hours</option>
            <option value="8"  <?php echo $ti_selected == 8  ?  "selected" : ""?> >8 Hours</option>
            <option value="72" <?php echo $ti_selected == 72 ?  "selected" : ""?> >3 Days</option>
          </select>
        </div>
        <div class="form-group">
         <input type="search" name="search_t" id="search_t"  placeholder="Search" class="form-control">
        </div> 
        <button type="button" class="btn backgroundColor1" onclick="fetchEvents()">
          <span class="glyphicon glyphicon-search"></span>
        </button>
        <br><span  class="pull-right" style="margin-top:5px;cursor:pointer;">
        <a href"#" onclick="fetch_acc_setting()">
          <?php
              echo $_SESSION['email'] . '<span style="color:#818181"> 
              (Home:<span id="zip_code_str">'.$_SESSION['zip'] .'<span/><span/>)' ;
          ?>
         </a>
      </form>

    </div>
  </div>
  <br>
  <div class="container">
   <div class="row" style="margin-top:80px;">
    <div class="col-lg-12 visible-lg" id ="wapper-canvas-lg">
       <canvas height="500" width="1200" style="width:1200px;" id="mainCanvas-lg"></canvas>     
    </div>
    <div class="col-md-12 visible-md" style="" id ="wapper-canvas-md">
        <canvas   width="992" height="500" style="background:;" id="mainCanvas-md"></canvas>    

    </div>
    <div class="col-sm-12 visible-sm"  style="" id ="wapper-canvas-sm" >
      <canvas   width="768" height="500" style="background:;" id="mainCanvas-sm"></canvas>    

    </div>
    <div class="col-xs-12 visible-xs"  style="" id ="wapper-canvas-xs"> 
      <canvas  width="767" height="500" style="" id="mainCanvas-xs"></canvas>    
    </div>
     <div class="col-xs-12 visible-xs"  style="" id ="wapper-canvas-mob"> 
      <canvas  width="450" height="400" style="" id="mainCanvas-mob"></canvas>    
    </div>
          
    </div>
  </div>
<hr>
<div class="container">
  <footer>
    <p>&copy; 2014 popcliqs, <a data-toggle="modal" href="#myModalabout">About</a> | <a data-toggle="modal" href="#myModal">Terms & Privacy</a> | <a data-toggle="modal" href="#myModalabout">Help</a></p>
  <?php 
require 'terms.tmpl.php';
 ?>
  </footer>
</div>

<!-- Preferecnes modal start  --> 
<?php require 'preferences.tmpl.php'; ?>
<!-- Preferecnes modal end  --> 
<?php require 'createnew.tmpl.php'; ?>

<!-- Modal -->
<div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="update_screen('#history')" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:center">My Cliqs</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" id="historyTab">
          <li id="history-interest" class="active" ><a href="#interest" data-toggle="tab">To Attend</a></li>
          <li id="history-att"><a href="#attended" data-toggle="tab">Attended</a></li>
          <li id="history-int"><a href="#initiated" data-toggle="tab">Created</a></li>
        </ul>
              
        <!-- Tab panes -->
     
        <td colspan="5"></td>
      <div class="scrollit">
        <div class="tab-content">
          <div class="tab-pane active" id="interest">
            <?php require 'interested.tab.php'; ?>
          </div>
          <div class="tab-pane" id="attended">
            <?php require 'attended.tab.php'; ?>
          </div>
          <div class="tab-pane" id="initiated">
            <?php require 'initiated.tab.php'; ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="update_screen('#history')" >Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
 
       
<!-- Modal -->
<div class="modal fade" id="eventdetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:center">Event Details</h4>
      </div>
      <input type="hidden" id="e_id" />
      <div class="modal-body">
        <div class="row" style="padding-bottom:2px;">
        <div class="col-md-2 "><strong>Title</strong></div>
          <div class="col-md-8">
              <span id="e_title"></span>
          </div>
        </div>
        <div class="row" style="padding-bottom:2px;">
        <div class="col-md-2"><strong>Description</strong></div>
          <div class="col-md-8">
              <span id="e_desc"></span>
          </div>
        </div>
        <div class="row" style="padding-bottom:2px;">
        <div class="col-md-2"><strong>Category</strong></div>
          <div class="col-md-8">
              <span id="e_cat"></span>
          </div>
        </div>
        <div class="row" style="padding-bottom:2px;">
        <div class="col-md-2"><strong>Start</strong></div>
          <div class="col-md-8">
              <span id="e_start"></span>
          </div>
        </div>
        <div class="row" style="padding-bottom:2px;">
          <div class="col-md-2"><strong>End</strong></div>
            <div class="col-md-8">
              <span id="e_end"></span>
            </div>
        </div>
        <div class="row" style="padding-bottom:2px;">
          <div class="col-md-2"><strong>Location</strong></div>
            <div class="col-md-8">
              <span id="e_loc"></span>
            </div>
        </div>
        <div class="row" style="padding-bottom:2px;">
          <div class="col-md-2"><strong>Address</strong></div>
            <div class="col-md-8">
              <span id="e_add"></span>
            </div>
        </div>
        <div class="row" style="padding-bottom:2px;">
          <div class="col-md-2"><strong>Zip</strong></div>
            <div class="col-md-8">
              <span id="e_zip"></span>
            </div>
        </div>
        <div class="row" style="padding-bottom:2px;">
          <div class="col-md-2"><strong>Distance</strong></div>
            <div class="col-md-8">
              <span id="e_dist"></span>
            </div>
        </div>
        <div class="row" style="padding-bottom:2px;">
          <div class="col-md-2"><strong>Age Limit</strong></div>
            <div class="col-md-8">
              <span id="e_alimit"></span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="save_btn" class="btn btn-primary" onclick="update_rspv()">Pop It!</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- message modal start --> 
<div class="modal fade" id="msgModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title" style="text-align:center;">
         <span class="glyphicon glyphicon-ok" ></span><span id="messageTitle"></span></h4>
      </div>
      <div class="modal-body">
        <h4 id="messageTxt"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="closemodal('msgModal')">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
<!-- message modal end --> 

<?php 
    require 'resetpwd.tmpl.php'; 
    require 'about.tmpl.php';
?>
<!--script src="js/jquery.js" ></script-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="web/js/easeljs-0.6.0.min.js"></script>
<script type="text/javascript" src="web/js/tweenjs-0.4.0.min.js"></script>
<script src="web/js/bootstrap.js" ></script>
<script src="web/js/myApp.js"></script>
<script src="web/js/popcliqs_canvas.js" ></script>
<script src="web/js/popcliqs_actions.js" ></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript">
  
  $(function() { 
     fetchEvents();
     // redraw();
    setInterval(function(){ fetchEvents(); },1000 * 60 * 5 );
  });

  $('#historyTab').click(function (e) {
    
    var target = e.target + "";
    if(target.indexOf("initiated") !== -1){
      fetch_initiated_events();
    }
     if(target.indexOf("interested") !== -1){
      fetch_interested_events();
    }
     if(target.indexOf("attended") !== -1){
      fetch_attended_events();
    }
  });

  $(function() {
    $( "#start_date" ).datepicker();
  });

  $(function() {
    $( "#end_date" ).datepicker();
  });

</script>
</body>
</html>
