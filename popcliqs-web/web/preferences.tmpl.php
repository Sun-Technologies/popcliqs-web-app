<!-- Modal-->
<div class="modal fade" id="mypref" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Preferences</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <img src="./web/img/football-icon.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Sports</label>
            <div class="col-lg-7">
              <input type="radio" id="cat_1_0" name="cat_1" value="0" placeholder="" />
              <input type="radio" id="cat_1_1" name="cat_1" value="1" placeholder="" />
              <input type="radio" id="cat_1_2" name="cat_1" value="2" placeholder="" />
            </div>
        </div><br/>
        <div class="form-group">
            <img src="./web/img/prof.png"  class="col-lg-1 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Professional</label>
            <div class="col-lg-7">

              <input type="radio" id="cat_2_0" name="2" value="0" placeholder="" />
              <input type="radio" id="cat_2_1" name="2" value="1" placeholder="" />
              <input type="radio" id="cat_2_2" name="2" value="2" placeholder="" />

            </div>
        </div><br/>
        <div class="form-group">
            <img src="./web/img/arts.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Arts</label>
            <div class="col-lg-7">

              <input type="radio" id="cat_3_0" name="3" value="0" placeholder="" />
              <input type="radio" id="cat_3_1" name="3" value="1" placeholder="" />
              <input type="radio" id="cat_3_2" name="3" value="2" placeholder="" />

            </div>
        </div><br/>
        <div class="form-group">
            <img src="./web/img/education.png"  class="col-lg-1 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Education</label>
            <div class="col-lg-7">

              <input type="radio" id="cat_4_0" name="4" value="0" placeholder="" />
              <input type="radio" id="cat_4_1" name="4" value="1" placeholder="" />
              <input type="radio" id="cat_4_2" name="4" value="2" placeholder="" />

            </div>
        </div><br/>
        <div class="form-group">
            <img src="./web/img/help.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Support Group</label>
            <div class="col-lg-7">

              <input type="radio" id="cat_5_0" name="5" value="0" placeholder="" />
              <input type="radio" id="cat_5_1" name="5" value="1" placeholder="" />
              <input type="radio" id="cat_5_2" name="5" value="2" placeholder="" />

            </div>
        </div><br/>
        <div class="form-group">
            <img src="./web/img/adventure.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Outdoor</label>
            <div class="col-lg-7">

              <input type="radio" id="cat_6_0" name="6" value="0" placeholder="" />
              <input type="radio" id="cat_6_1" name="6" value="1" placeholder="" />
              <input type="radio" id="cat_6_2" name="6" value="2" placeholder="" />

            </div>
        </div><br/>
        <div class="form-group">
            <img src="./web/img/event.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Party</label>
            <div class="col-lg-7">
              <input type="radio" id="cat_7_0" name="7" value="0" placeholder="" />
              <input type="radio" id="cat_7_1" name="7" value="1" placeholder="" />
              <input type="radio" id="cat_7_2" name="7" value="2" placeholder="" />
            </div>
        </div><br/>
        <div class="form-group">
            <img src="./web/img/event.png"  class="col-lg-2 control-label" style="width:60px;" /> 
            <label for="1" class="col-lg-3 control-label">Social</label>
            <div class="col-lg-7">
              <input type="radio" id="cat_8_0" name="8" value="0" placeholder="" />
              <input type="radio" id="cat_8_1" name="8" value="1" placeholder="" />
              <input type="radio" id="cat_8_2" name="8" value="2" placeholder="" />
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  onclick="update_user_pref();">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->