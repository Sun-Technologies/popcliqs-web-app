<!DOCTYPE HTML>
<html>
<head>
  <title>Popcliqs - Reset Password</title>
  <link rel="stylesheet" type="text/css" href="web/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="web/css/popcliqs.css">
  <meta name="viewport" content="width=device-width">
</head>
<body>
<!-- nav bar--> 

<div class=" navbar-fixed-top navbar-blue" >
    <div class="navbar-header">
      <div class="container" style="height:70px;">
        <a class="brand" href="home.php"> <span  style="position:relative;top:6px;" ><img src="./web/img/3.png"/></span></a>
      </div>
    </div>
</div>
<br/>

<div class="container">
    <div class="row"  style="padding-top:80px;">

       <form class="form-horizontal" method="post" action="reset.php">

          <?php if(isset($erro_msg)) {?>
             <div class="alert alert-danger"> <?php echo $erro_msg; ?> </div>
          <?php } ?>
          <div class="form-group">

            <label for="password" class="col-sm-4 control-label">New Password</label>
            <div class="col-sm-3">
                <input type="hidden" name="key" value="<?php echo isset($_GET['key']) ? $_GET['key'] :  $key ?>" />
                <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter New Password....">
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-4 control-label">New Password Again</label>
            <div class="col-sm-3">
                <input type="password" class="form-control" name="pwd2" id="pwd2" placeholder="Re Enter New Password....">
            </div>
          </div>
          <div class="form-group">
          <label for="password" class="col-sm-4 control-label"></label>
           <div class="col-sm-5">
            <button type="submit" class="btn btn-success backgroundColor1 col-lg-6">Submit</button>
           </div>
          </div>
        </form>
    </div>
</div>
<div class="container">
     <div class="row">
      <div class="col-md-12">
        <hr/>
          <p>&copy; 2014 popcliqs, <a href="#">About</a> | <a data-toggle="modal" href="#myModal">Terms & Privacy</a> | <a data-toggle="modal" href="#myModalabout">Help</a></p>
      </p>
     </div>
    </div>
    </div>      
           
    
       
<?php 
require 'terms.tmpl.php';
require 'forgot_password.tmpl.php';




 ?>
    
<!--script src="js/jquery.js" ></script-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="web/js/bootstrap.js" ></script>
<script src="web/js/popcliqs_actions.js" ></script>

<script type="text/javascript">
    
    $('document').ready(function(){

      <?php if(isset($status)) {?>
         $(' <?php echo $error_id; ?>').popover('show'); 
      <?php } ?>

      <?php if( isset($login_status) ) {?>
                alert("<?php echo $login_status; ?>"); 
      <?php } ?>   
      
    });




</script>
</body>
</html>
