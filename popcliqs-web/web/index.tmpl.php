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

<!-- <div class="navbar-fixed-top navbar-green" >
</div> -->

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
    </div>
</div>
<br/>
<div class="container">
    <div class="row"  style="padding-top:80px;">
      <div class="col-md-5 col-md-offset-0">
          <div class="container">
            <h4>All Social... no media</h4>
          </div>
      		<iframe width="100%"  style="height:300px;" src="http://www.youtube.com/embed/3RyvMmlSZr0" frameborder="0" allowfullscreen>
          </iframe>
      </div>
      <div class="col-md-6 col-lg-offset-0">
        <div style="margin-bottom:20px;">
          <h4 style="display:inline;">Sign Up</h4> (Or you may never find out what XXXXX means! )
         <!-- <?php if(isset($status)) {?>
      <h3 class="notice"><?php echo $status ; }?></h3> -->
        </div>
        <form action="" method="post">
          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="email" class="control-label">Email</label>
              </div>
              <div class="col-lg-8">
                <input type="email" id="email"  name="email" class="form-control" placeholder="me@friends.com"   data-content="<?php if(isset($status)) { echo $email_status ; }?>" data-placement="top" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"/>
              </div>
            </div>
          </div>

          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="reemail" class="control-label">Email again</label>
              </div>
              <div class="col-lg-8">
                <input type="email" id="reemail"  name="reemail" class="form-control" placeholder="me@friends.com" data-content="Re Enter the Email address" data-placement="top" value="<?php echo isset($_POST['reemail']) ? $_POST['reemail'] : ''; ?>" />
              </div>
            </div>
          </div>

          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="password" class="control-label">Password</label>
              </div>
              <div class="col-lg-8">
                <input type="password" id="password"  name="password" class="form-control" placeholder="" data-content="Please Enter a valid Password (length greater than six)." data-placement="top" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>"/>
              </div>
            </div>
          </div>

          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="sex" class="control-label">I am</label>
              </div>
              <div class="col-lg-8">
              <?php 
                if (isset($_POST['sex']) && $_POST['sex']== 'male' ) { ?>
                 <input type="radio" name="sex" value="male" id="sex" data-content="select the gender" data-placement="top" checked="true" /> Male &nbsp;
                  <input type="radio" name="sex" value="female"> Female 
               <?php   } elseif (isset($_POST['sex']) && $_POST['sex'] == 'female') { ?>
                 <input type="radio" name="sex" value="male" id="sex" /> Male &nbsp;
                  <input type="radio" name="sex" value="female" checked="true"> Female 
              <?php   } else {?>
               <input type="radio" name="sex" value="male" id="sex" data-content="select the gender" data-placement="top"  /> Male &nbsp;
                  <input type="radio" name="sex" value="female" > Female 
              <?php  }?> 
                  
              </div>
            </div>
          </div>

          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="dob" class="control-label">I was born</label>
              </div>
              <div class="col-lg-8">
                <select name="month" id="month" data-content="select Month" data-placement="top"> 
                  <option value="">Month:</option>
                  <?php foreach ($month_list as $key => $value) {
                    if (isset($_POST['month']) && $key == $_POST['month']) {
                      echo " <option value='$key' selected>$value</option>";
                    }
                    else{
                      echo " <option value='$key'>$value</option>";
                    }
                  } ?>
            
                </select>  /
                <select name="day" id="day" data-content="select day" data-placement="top">
                  <option value="">Day:</option>
                  <?php 
                 
                  for ($index = 1; $index <=31 ; $index++) { 
                 
                    if (isset($_POST['day']) && $_POST['day'] == $index) {
                     echo " <option value=$index selected>$index</option>";
                    }else{
                      echo "<option value=$index>$index</option>";

                    }
                  }
                   ?>
              
                </select> / 
                <select name="year" id="year" data-content="select Year" data-placement="top">
                  <option value="">Year:</option>
                    <?php 
                 
                  for ($index = 1900; $index <=2012 ; $index++) { 
                 
                    if (isset($_POST['year']) && $_POST['year'] == $index) {
                     echo " <option value=$index selected>$index</option>";
                    }else{
                      echo "<option value=$index>$index</option>";

                    }
                  }
                   ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="zip" class="control-label">Home Zip</label>
              </div>
              <div class="col-lg-8">
                <input type="text" id="zip"  name="zip" class="form-control" placeholder="" data-content="Enter valid zip !!! " data-placement="top" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : ''; ?>" />
              </div>
            </div>
          </div>
          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
              </div>
              <div class="col-lg-7">
                By signing up, I agree to the <a data-toggle="modal" href="#myModal">Terms</a> of Use and <a href="#">Privacy Policy</a>.
              </div>
            </div>
          </div>

          <div class="row" style="padding-left:20px;padding-top:20px;"> 
              <button type="submit" class="btn btn-success backgroundColor1 col-lg-offset-3 col-lg-6">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
</div>
<div class="container">
     <div class="row">
      <div class="col-md-12">
        <hr/>
        <p>&copy; 2013 Popcliqs.com, <a href="#">About</a> | <a href="#">Privacy</a> | <a data-toggle="modal" href="#myModal">Terms</a>
      </p>
     
                 
<?php 
require 'terms.tmpl.php';
 ?>
    
<!--script src="js/jquery.js" ></script-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="web/js/bootstrap.js" ></script>

<script type="text/javascript">
    
    $('document').ready(function(){

      <?php if(isset($status)) {?>
      $(' <?php echo $error_id; ?>').popover('show'); 
      <?php } ?>   
    });

</script>
</body>
</html>
