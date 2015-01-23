<!-- Modal-->
<?php 
  $category_arr = array(
                    "Sports"        => "./web/img/football-icon.png",
                    "Professional"  => "./web/img/prof.png",
                    "Arts"          => "./web/img/arts.png",
                    "Education"     => "./web/img/education.png",
                    "Support Group" => "./web/img/help.png",
                    "Outdoor"       => "./web/img/adventure.png",
                    "Party"         => "./web/img/party.png",
                    "Social"        => "./web/img/social.png"
                  );

?>
<div class="modal fade" id="mypref" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:left">Settings</h4>
      </div>
      <div class="modal-body">
        <table>
      <thead>
        <td>

        </td>
        <td>
        <div class="col-md-12">
          Not for me
          </div>
        </td>
        <td>
        <div class="col-md-12">
          Why not
          </div>
        </td>
        <td>
        <div class="col-md-12">
        Won't miss
        </div>
        </td>
      </thead>
      <?php 
        $val_index = 1 ;
        foreach ($category_arr as $cat => $log_url) {
        ?>
        <tr>
          <td nowrap>
              <!-- <div class="form-group"> -->
              <img src="<?php echo $log_url?>" title="<?php echo $cat?>" class="col-md-3 control-label" style="width:60px;" />
          </td> 
          <td style="border-right: 1px solid #1186D8;">
          <div align="center">
            <input type="radio" id="cat_<?php echo $val_index?>_0" name="cat_<?php echo $val_index?>" value="0" placeholder="" />
          </div>
          </td>
          <td style="border-right: 1px solid #1186D8;">
          <div align="center">
            <input type="radio" id="cat_<?php echo $val_index?>_1" name="cat_<?php echo $val_index?>" value="1" placeholder="" />
          </div>
          </td> 
          <td>
          <div align="center">
          <input type="radio" id="cat_<?php echo $val_index?>_2" name="cat_<?php echo $val_index?>" value="2" placeholder="" />
          </div>
          </td>
        </tr>
      <?php
        $val_index++;
      }
      ?>
      </table>
      </div> <!-- modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        <button type="button" class="btn btn-primary"  onclick="update_user_pref();">save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->