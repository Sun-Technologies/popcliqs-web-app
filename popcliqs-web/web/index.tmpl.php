<?php  
$month_list = array(
1 => 'January', 
2 => 'February',
3 => 'March',
4 => 'April',
4 => 'May',
6 => 'June',
7 => 'July',
8 => 'August',
9 => 'September',
10 => 'October',
11 => 'November',
12 => 'December'
);

$form_er_class ="form-group has-error has-feedback";
$form_class    ="form-group";
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Popcliqs - Login</title>
  <link rel="stylesheet" type="text/css" href="web/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="web/css/popcliqs.css">
  <meta name="viewport" content="width=device-width">
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
    <div class="navbar-collapse collapse backgroundColor" style="height:1px;">
      <form class="navbar-form navbar-right" action="login.php" method="post" >
        <div class="form-group">
          <input type="text" name="email" placeholder="Email" class="form-control" required value=""  />
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success backgroundColor1">Sign in</button>
      </form>
      <span  class="pull-right" style="margin-top:45px;position:relative;left:130px;">
       <a data-toggle="modal" href="#forgotPassword">Forgot Password</a>
      </span>          
</p>

    </div>
</div>
<br/>

<?php require 'web/signup.tmpl.php' ?>
<div class="container">
     <div class="row">
      <div class="col-md-12">
        <hr/>
          <p>&copy; 2014 popcliqs, <a href="#">About</a> | <a data-toggle="modal" href="#myModal">Terms & Privacy</a> | <a data-toggle="modal" href="#myModal">Help</a></p>
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
