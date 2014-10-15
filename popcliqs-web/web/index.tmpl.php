<?php  
$month_list = array(
1 => 'JAN', 
2 => 'FEB',
3 => 'MAR',
4 => 'APR',
4 => 'MAY',
6 => 'JUN',
7 => 'JUL',
8 => 'AUG',
9 => 'SEP',
10 => 'OCT',
11 => 'NOV',
12 => 'DEC'
);

$form_er_class ="form-group has-error has-feedback";
$form_class    ="form-group";
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
  <title>Popcliqs - Login</title>
  <link rel="stylesheet" type="text/css" href="web/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="web/css/popcliqs.css">

</head>
<body>
<!-- nav bar--> 

<div class=" navbar-fixed-top navbar-blue" >
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed btn-success backgroundColor1" data-toggle="collapse" data-target=".navbar-collapse" >
        Sign In
      </button>
      <div class="container" style="height:70px;">
          <a class="brand" href="home.php"> <span  style="position:relative;top:6px;" ><img src="./web/img/3.png"/></span></a>
      </div>
    </div>
    <div class="navbar-collapse collapse backgroundColor" id="navbar_id" style="height:1px;">
      <form class="navbar-form navbar-right" action="login.php" method="post" >
        <div class="form-group">
          <input type="text" name="email" placeholder="Email" class="form-control" required value=""  />
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success backgroundColor1">Sign in</button>
        <span id="forgot_pwd" style="">
            <a data-toggle="modal" href="#forgotPassword">Forgot Password</a>
        </span> 
      </form>
              
    </div>
</div>
<br/>

<?php require 'web/signup.tmpl.php' ?>
<div class="container">
     <div class="row">
     <hr/>
      <div class="col-sm-4">
        
          <p>&copy; 2014 popcliqs</p>
      
     </div>
     <div class="col-sm-8">
          <p><a data-toggle="modal" href="#myModalabout">About</a> | <a data-toggle="modal" href="#myModal">Terms &amp; Privacy</a> | <a data-toggle="modal" href="#myModalabout">Help</a></p>
     </div>
    </div>
</div>      
  
  <div class="modal fade" id="errorModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title" style="text-align:center;">
         <span class="glyphicon glyphicon-warning-sign"></span> Error</h4>
      </div>
      <div class="modal-body">
        <p><?php echo $login_status; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->        
    
       
<?php 
require 'terms.tmpl.php';
require 'forgot_password.tmpl.php';
require 'about.tmpl.php';
?>
    
<!--script src="js/jquery.js" ></script-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="web/js/bootstrap.js" ></script>
<script src="web/js/popcliqs_actions.js" ></script>

<script type="text/javascript">
    
    $('document').ready(function(){
      <?php if( isset($login_status) ) {?>
                $('#errorModal').modal('show') ;
      <?php } ?>   
      
    });

</script>
</body>
</html>
