<?php 
ob_start();
session_start(); 
include_once('include/header.php');
include_once('include/oopadmin.php');
require('include/connect_db.php');
$obj_admin = new crud_admin();
$admin=$obj_admin->display_admin_info();
if(isset($_POST['submit1']))
{
  $names=$_POST['NameSurname'];
  $email=$_POST['Email'];
  $phone=$_POST['Phone'];
  if ($_FILES['file']['name']=='') {
    $image=$admin['admin_img'];
  }else{
    $image=$_FILES['file']['name'];
    $tmp_name=$_FILES['file']['tmp_name'];
    $path='adimg/';
    $image=time().$image;
    move_uploaded_file($tmp_name, $path.$image);
  }
  $obj_admin->edit_admin_info($image);
  header('location:index.php');
}
if(isset($_POST['submit2']))
{
  $oldpass=$_POST['OldPassword'];
  $newpass=$_POST['NewPassword'];
  $confirmpass=$_POST['NewPasswordConfirm'];
  if($oldpass!=$admin['admin_password'])
  {
   $oldpass_error='old password NOT CORRECT';
 }
 else
 {
  if ($newpass==$confirmpass)
  {
    $obj_admin->update_password($confirmpass);
    $success1="yes";
    header("location:index.php");
  }

}
}
?>
<script type="text/javascript">
  $("document").ready(function(){ 
    $("#NewPasswordConfirm").keyup(function(){
      $("#NewPasswordConfirm, #NewPassword").keyup(function(){
        var newpassword=$("#NewPassword").val();
        var passwordconfirm=$("#NewPasswordConfirm").val();
        if (passwordconfirm!='' && newpassword!='') {
          if(passwordconfirm==newpassword)
          { 
            $('#alertdialog').removeClass("alert");
            $('#alertdialog').removeClass("alert-warning");
            $('#alertdialog').addClass("alert ");
            $('#alertdialog').addClass("alert-success");
            $('#smalltag').html('Success new password match comfirm password');
             $('#changepassword').prop( "disabled", false );
          }
          else
          {
            $('#alertdialog').removeClass("alert");
            $('#alertdialog').removeClass("alert-success");
            $('#alertdialog').addClass("alert");
            $('#alertdialog').addClass("alert-warning");
            $('#smalltag').html('!Warning new password do not match comfirm password');
            $('#changepassword').prop( "disabled", true );
          }
        }
        else
        {
         $('#alertdialog').removeClass("alert");
         $('#alertdialog').removeClass("alert-success");
         $('#alertdialog').removeClass("alert-warning");
         $('#smalltag').html('');
       }
     });
    });
  });
</script>
<section class="content">
  <div class="container-fluid">
    <div class="col-xs-12 col-sm-9">
      <div class="card">
        <div class="body">
          <div>
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
              <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
              <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
            </ul>

            <div class="tab-content ">
              <div role="tabpanel" class="tab-pane fade in active" id="home">
                <div class="card profile-card">
                  <div class="profile-header">&nbsp;</div>
                  <div class="profile-body">
                    <div class="image-area">
                      <?php
                      echo "<img src='adimg/{$admin['admin_img']}' width=100px; alt='AdminBSB - Profile Image'>";
                      ?>
                    </div>
                    <div class="content-area">
                     <?php
                     echo "<h3>";
                     echo $admin['admin_name'];
                     echo "</h3>";
                     ?>
                     <p>Administrator</p>
                   </div>

                   <div class="profile-footer">
                    <ul>
                      <li>
                        <span>your email</span>
                        <span><?php
                        echo $admin['admin_email'];
                        ?></span>
                      </li>
                      <li>
                        <span>your phone</span>
                        <span><?php
                        echo $admin['admin_phone'];
                        ?></span>
                      </li>
                      <li>
                        <span>your date engage</span>
                        <span>
                         <?php
                         echo $admin['date_engage'];
                         ?>
                       </span>
                     </li>
                   </ul>
                 </div>
               </div>    
             </div>
           </div>
           <div role="tabpanel" class="tab-pane fade in" id="profile_settings">

            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="NameSurname" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <div class="form-line">
                    <input type="text" class="form-control" id="NameSurname" name="NameSurname" placeholder="Name Surname"  value="<?php 
                    echo $admin['admin_name']; 
                    ?>"  required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="Email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <div class="form-line">
                    <input type="email" class="form-control" id="Email" name="Email" placeholder="Email"
                    value="<?php 
                    echo $admin['admin_email']; 
                    ?>"
                    required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="Phone" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                  <div class="form-line">
                    <input type="text" class="form-control" id="Phone" name="Phone" placeholder="Phone" 
                    value="<?php 
                    echo $admin['admin_phone']; 
                    ?>"
                    required>
                  </div>
                </div>
              </div>
              <div class="form-group">
               <label for="image" class="col-sm-2 control-label">image</label>
               <div class="fallback">
                <input name="file" type="file" multiple />
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input class="btn btn-danger" type="submit" name="submit1" value="edit your information">
              </div>
            </div>
          </form>
        </div>
        <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
          <form class="form-horizontal" action="" method="post">
            <?php
            if(isset($oldpass_error))
            {
              echo "<div class='alert alert-warning'>
              <strong>Warning!</strong> old password do not match 
              </div>";
            }
            if (isset($success1))
            {
             echo "<div class='alert alert-success'>
             <strong>Success</strong> changed password 
             </div>"; 
           }
           ?>
           <div class="form-group">
            <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
            <div class="col-sm-9">
              <div class="form-line">
                <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Old Password" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
            <div class="col-sm-9">
              <div class="form-line">
                <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
            <div class="col-sm-9">
              <div class="form-line">
                <input type="password" class="form-control" id="NewPasswordConfirm" name="NewPasswordConfirm" placeholder="New Password (Confirm)" required>
              </div>
              <div id='alertdialog'>
               <small id="smalltag" >
                 
               </small>
             </div>
           </div>
         </div>
         <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <input id="changepassword" class="btn btn-danger" type="submit" name="submit2" value="change your password">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</section>
