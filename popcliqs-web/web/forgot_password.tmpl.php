<div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" onclick="reset_forgot_password()" aria-hidden="true">&times;</button>
            <h4 style="text-align:center">FORGOT PASSWORD</h4>
            
            </div>
            <div class="modal-body" style="width: 100%; height: 100px;">
                <form class="form-horizontal" action="" method="post" id="forgot_password_form">
              <div class="form-group">
                   <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                     <input  type="email" id="user_email"  name="user_email" class="form-control" placeholder="Enter Your Email"  />
                  </div>
              </div>
              </form>
           </div>

                <div class="modal-footer">
                   <button type="button" class="btn btn-default" onclick="reset_forgot_password()" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary"  onclick="send_password()">Submit</button>
                </div>
        </div>
    </div>
</div>

