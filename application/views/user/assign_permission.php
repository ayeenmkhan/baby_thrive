<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add user</title>
</head>

<body>
    
    <div style="text-align:center"><h2>Add shop</h2><a href="<?php echo base_url();?>manage_user">Manage user</a></div>
    
    <div class="col-md-12">
             <?php
                    if($this->session->flashdata('err_message')){
                ?>
                        <div class="alert alert-danger"><center><?php echo $this->session->flashdata('err_message'); ?><center></div>
                <?php
                    }//end if($this->session->flashdata('err_message'))
                ?>
            </div>
    
    <div style="text-align:center">
        <form action="<?php echo SURL?>manage_user/add_user_process" enctype="multipart/form-data" method="post" id="frm_add" >
        	<table width="400" border="0">
                <tr>
                    <td><label>First Name</label></td>
                    <td><input type="text" placeholder="First Name" required id="first_name" name="first_name" class="form-control"></td>
                </tr>
                <tr>
                    <td><label>Last Name</label></td>
                    <td><input type="text" placeholder="Last Name" required name="last_name" class="form-control"></td>
                </tr>
                <tr>
                    <td><label>User Name</label></td>
                    <td><input type="text" placeholder="User Name" required name="user_name" class="form-control"></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" placeholder="Password" required id="password" name="password" class="form-control"></td>
                </tr>
                <tr>
                    <td><label>Confirm Password</label></td>
                    <td><input type="password" placeholder="Confirm Password" required id="confirm_password" name="confirm_password" class="form-control"></td>
                </tr>
                <tr>
                    <td><div id="pass_res"></div>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" id="save" value="Save" class="btn btn-default pull-left custom-marg" />
                    <a href="#" class="btn btn-danger pull-left custom-marg">Cancel</a></td>
                </tr>
            </table>
            
            
        </form>
    </div>
    <script src="<?php echo SURL; ?>assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    
    <script>
	$(function () {
        $("#save").click(function () {
            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();
            if (password != confirmPassword) {
				$("#pass_res").text("Passwords do not match.");
                return false;
            }
            return true;
        });
    });
	</script>
</body>
</html>
