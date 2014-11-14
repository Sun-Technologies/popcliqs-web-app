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

<div class="modal fade" id="resetpwd" tabindex="-1" role="dialog" aria-hidden="true">
 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 style="text-align:center" style="text-align:left;">Account Settings</h4>
            </div>
            <div class="modal-body">
             <form class="form-horizontal">
              <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">Change Password</label>
                    <div class="col-sm-6">
                        <label class="checkbox-inline">
                            <input type="checkbox" id="pwd" value="option1" onclick="enableTextbox()">
                        </label>
                        
                        </div>
                     </div>
                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">Old Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="pwd1" disabled="true" placeholder="Enter Old Password....">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">New Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="pwd2" disabled="true" placeholder="Enter New Password....">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">New Password Again</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="pwd3" disabled="true"  placeholder="Re Enter New Password....">
                    </div>
                </div>
                    
                

                    <div class="form-group">
                    <label for="zip" class="col-sm-4 control-label">Zip</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Enter Zip....">
                    </div>
                </div>
                     
              

                    
            </form>

            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="" data-dismiss="modal">close</button>
                <button type="button" class="btn btn-primary" onclick="save_acc_setting()">save</button>
              </div>
        </div>
    </div>
</div>