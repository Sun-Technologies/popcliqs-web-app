<div class="container">
    <div class="row"  style="padding-top:80px;">
      <div class="col-sm-5">
          <div class="container">
            <h4>All Social... no media</h4>
          </div>
          <div class="videoWrapper">

          <!-- <iframe src="//player.vimeo.com/video/81890061" width="450" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>  -->
          <iframe width="450" height="281" src="http://www.youtube.com/embed/DvpPPNS47XY?wmode=transparent&amp;autoplay=0&amp;theme=dark&amp;controls=1&amp;autohide=0&amp;loop=0&amp;showinfo=0&amp;rel=0" frameborder="0" allowfullscreen></iframe>
          </div>
      </div>
      <div class="col-sm-7 col-sm-offset-0">
        <div style="margin-bottom:20px;">
          <h4 style="display:inline;">Sign Up</h4> (Or you may never find out what XXXXX means! )
        </div>
        <form action="index.php" method="post" autocomplete="off" >
          <div class="row" style="padding-bottom:10px;">
            <?php 
              $has_email_err = isset($error_map) ? array_key_exists ( '#semail' , $error_map ) : false;  
            ?>
            <div class="<?php echo $has_email_err ? $form_er_class : $form_class ?>"  >
              <div class="col-sm-3">
                <label for="email" class="control-label">Email</label>
              </div>
              <div class="col-sm-8">
                <input type="text" id="semail"  name="semail" class="form-control" placeholder=""  value="<?php echo isset($_POST['semail']) ? $_POST['semail'] : ''; ?>"/>
                 <span class="help-block"><?php echo isset($error_map['#semail']) ?  $error_map['#semail'] : "" ?></span>
              </div>
            </div>
          </div>
          <?php 
              $has_reemail_err = isset($error_map) ? array_key_exists ( '#sreemail' , $error_map ) : false;  
          ?>
          <div class="row" style="padding-bottom:10px;">
            <div class="<?php echo $has_reemail_err ? $form_er_class : $form_class ?>">
              <div class="col-sm-3">
                <label for="reemail" class="control-label">Email again</label>
              </div>
              <div class="col-sm-8">
                <input type="email" id="sreemail"  name="sreemail" class="form-control" placeholder=""  value="<?php echo isset($_POST['sreemail']) ? $_POST['sreemail'] : ''; ?>" />
                <span class="help-block"><?php echo isset($error_map['#sreemail']) ?  $error_map['#sreemail'] : "" ?></span>
              </div>
            </div>
          </div>
          <?php 
              $has_password_err = isset($error_map) ? array_key_exists ( '#spassword' , $error_map ) : false ;  
          ?>
          <div class="row" style="padding-bottom:10px;">
            <div class="<?php echo $has_password_err ? $form_er_class : $form_class ?>">
              <div class="col-sm-3">
                <label for="password" class="control-label">Password</label>
              </div>
              <div class="col-sm-8">
                <input type="password" id="spassword"  name="spassword" class="form-control" placeholder="" value="<?php echo isset($_POST['spassword']) ? $_POST['spassword'] : ''; ?>"/>
                <span class="help-block"><?php echo isset($error_map['#spassword']) ?  $error_map['#spassword'] : "" ?></span>
              </div>
            </div>
          </div>
          <?php 
              $has_gender_err = isset($error_map) ? array_key_exists ( '#sex' , $error_map ): false;  
          ?>
          <div class="row" style="padding-bottom:10px;">
            <div class="<?php echo $has_gender_err ? $form_er_class : $form_class ?>">
              <div class="col-sm-3">
                <label for="sex" class="control-label">I am</label>
              </div>
              <div class="col-sm-8">
              <?php 
                if (isset($_POST['sex']) && $_POST['sex']== 'male' ) { ?>
                 <input type="radio" name="sex" value="1" id="sex" checked="true" /> Male &nbsp;
                  <input type="radio" name="sex" value="2"> Female 
               <?php   } elseif (isset($_POST['sex']) && $_POST['sex'] == 'female') { ?>
                 <input type="radio" name="sex" value="1" id="sex" /> Male &nbsp;
                  <input type="radio" name="sex" value="2" checked="true"> Female 
              <?php   } else {?>
               <input type="radio" name="sex" value="1" id="sex"  /> Male &nbsp;
                  <input type="radio" name="sex" value="2" > Female 
              <?php  }?> 
                   <span class="help-block"><?php echo isset($error_map['#sex']) ?  $error_map['#sex'] :"" ?></span>
              </div>
            </div>
          </div>
          <?php 
              $has_dob_err = isset($error_map) ? array_key_exists ( '#dob' , $error_map ) : false;  
          ?>
          <div class="row" style="padding-bottom:10px;">
            <div class="<?php echo $has_dob_err ? $form_er_class : $form_class ?>">
              <div class="col-sm-3">
                <label for="dob" class="control-label">I was born</label>
              </div>
              <div class="col-sm-8">
                <select name="month" id="month"> 
                  <option value="">MMM</option>
                  <?php foreach ($month_list as $key => $value) {
                    if (isset($_POST['month']) && $key == $_POST['month']) {
                      echo " <option value='$key' selected>$value</option>";
                    }
                    else{
                      echo " <option value='$key'>$value</option>";
                    }
                  } ?>
            
                </select>  /
                <select name="day" id="day" >
                  <option value="">DD</option>
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
                <select name="year" id="year">
                  <option value="">YYYY</option>
                    <?php 
                 
                  for ($index = 2014; $index >=1920 ; $index-- ) { 
                 
                    if (isset($_POST['year']) && $_POST['year'] == $index) {
                     echo " <option value=$index selected>$index</option>";
                    }else{
                      echo "<option value=$index>$index</option>";

                    }
                  }
                   ?>
                </select>
                <span class="help-block"><?php echo isset($error_map['#dob']) ? $error_map['#dob'] : "" ?></span>
              </div>
            </div>
          </div>
          <?php 
              $has_zip_err = isset($error_map) ? array_key_exists ( '#zip' , $error_map ) :false;  
          ?>
          <div class="row" style="padding-bottom:10px;">
            <div class="<?php echo $has_zip_err ? $form_er_class : $form_class ?>">
              <div class="col-sm-3">
                <label for="zip" class="control-label">Home Zip</label>
              </div>
              <div class="col-sm-8">
                <input type="text" id="zip"  name="zip" class="form-control" placeholder="" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : ''; ?>" />
                <span class="help-block"><?php echo isset($error_map['#zip']) ?  $error_map['#zip'] : "" ?></span>
              </div>
            </div>
          </div>
          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-sm-3">
              </div>
              <div class="col-sm-7">
                By signing up, I agree to the <a data-toggle="modal" href="#myModal">Terms of Use and Privacy Policy</a>.
              </div>
            </div>
          </div>

          <div class="row" style="padding-left:20px;padding-top:20px;"> 
              <button type="submit" class="btn btn-success backgroundColor1 col-sm-offset-3 col-lg-6">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
</div>