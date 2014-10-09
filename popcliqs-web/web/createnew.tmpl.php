<!-- Modal -->
<div class="modal fade" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" id="event_form" name="event_form" method="post" action="event.php">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="eventdetails_title" style="text-align:center">New Cliq</h4>
        </div>
        <div class="modal-body" style="width: 100%; height: 400px; overflow-y: scroll;">

          
           <div class="form-group"  id="title_fr" >
            <label for="title" class="col-lg-2 control-label">Title</label>
            <div class="col-lg-8">
              <input type="text" id="title" name="title" class="form-control" placeholder="" />
               <input type="hidden" id="event_id" name="event_id"/>
               <span class="help-block" id="title_sp" style="display:none">Enter a valid title.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="description" class="col-lg-2 control-label">Description</label>
            <div class="col-lg-8">
              <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
          </div>
          <div class="form-group" id="category_fr">
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
                <option value="8">Social</option>
              </select>
              <span class="help-block" id="category_sp" style="display:none">Select a valid category.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="location" class="col-lg-2 control-label">Venue</label>
            <div class="col-lg-8">
             <input type="text" id="location" name="location"  class="form-control" placeholder="" />
          </div>
          </div>
          <div class="form-group">
            <label for="address" class="col-lg-2 control-label">Address</label>
            <div class="col-lg-8">
              <textarea id="autocomplete" class="form-control" name="address" onFocus="geolocate()"  rows="4"></textarea>
            </div>
          </div>
          <div class="form-group"  id="zip_fr">
            <label for="postal_code" class="col-lg-2 control-label">Zip</label>
            <div class="col-lg-8">
              <input type="text" id="postal_code" name="postal_code" class="form-control" placeholder=""  />
              <input type="hidden" id="lat" name="lat"   />
              <input type="hidden" id="lon" name="lon"   />
              <input type="hidden" id="geozip" name="geozip"   />
              <span class="help-block" id="zip_sp" style="display:none">Enter a valid zip.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="contact-email" class="col-lg-2 control-label" style="padding-top:0px;">Age limit</label>
            <div class="col-lg-8" style="padding-top:0px;">
              <input type="radio" id="age_limit_0" value="1"  placeholder=""> Anyone    &nbsp;
              <input type="radio" id="age_limit_18" value="2" placeholder=""> Above 18  &nbsp;
              <input type="radio" id="age_limit_21" value="3"  placeholder=""> Above 21  &nbsp;
            </div>
          </div>
          <div class="form-group" id="capacity_fr">
            <label for="capacity" class="col-lg-2 control-label">Capacity</label>
            <div class="col-lg-8">
              <input type="text" id="capacity" name=="capacity" value="" class="form-control" placeholder="" />
               <span class="help-block" id="capacity_sp" style="display:none">Enter a valid numberic value.</span>
            </div>
          </div>
           <div class="form-group" id="stdt_fr">
            <label for="start_date" class="col-lg-2 control-label" style="padding-left:0px;">Start time</label>
            <div class="col-lg-8">
              <input type="text" id="start_date" name="start_date" class="form-control" placeholder="" style="width:192px;display:inline-block;" />
              <select id="start_time" name="start_time" class="form-control" style="width:140px;display:inline-block;">
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
                 <span class="help-block" id="stdt_sp" style="display:none">Enter a valid start date time.</span>
            </div><br/>
           
          </div>
          <div class="form-group" id="endt_fr">
            <label for="end_date" class="col-lg-2 control-label">End time</label>
            <div class="col-lg-8">
              <input type="text" id="end_date" name="end_date" class="form-control" placeholder="" style="width:190px;display:inline-block;"/>
              <select id="end_time" name="end_time" class="form-control" style="width:140px;display:inline-block;">
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
              <span class="help-block" id="endt_sp" style="display:none">Enter a valid end date time.</span>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="close_event_window();">Close</button>
        <button type="button"  id="submit_btn" class="btn btn-primary" onclick="create_event();">Create</button>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->