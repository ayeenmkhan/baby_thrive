<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit User</title>
</head>

<body>
    
    <div style="text-align:center"><h2>Edit User</h2><a href="<?php echo base_url();?>manage_shop">Manage user</a></div>
    
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
        <form action="<?php echo SURL?>manage_user/edit_user_process" enctype="multipart/form-data" method="post" id="frm_add" >
        	<table width="400" border="0">
                <tr>
                    <td><label>First Name</label></td>
                    <td><input type="text" value="<?php echo $shop_detail[0]['first_name'];?>" placeholder="Shop Title" required id="shop_title" name="first_name" class="form-control"></td>
                </tr>
                <tr>
                    <td><label>Last Name</label></td>
                    <td><input type="text" value="<?php echo $shop_detail[0]['last_name'];?>" placeholder="Shop Title" required id="shop_title" name="last_name" class="form-control"></td>
                </tr>
                <tr>
                    <td><label>Shop Login</label></td>
                    <td><input type="text" readonly="readonly" value="<?php echo $shop_detail[0]['user_name'];?>" placeholder="Shop Login" required name="shop_login" class="form-control"></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" placeholder="Password" id="password" name="password" class="form-control"></td>
                </tr>
                <tr>
                    <td><label>Confirm Password</label></td>
                    <td><input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" class="form-control"></td>
                </tr>
                <tr>
                    <td><div id="pass_res"></div>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;<input type="hidden" placeholder="Confirm Password" name="id" value="<?php echo $shop_detail[0]['id']; ?>" class="form-control"></td>
                    <td><input type="submit" id="save" value="Update" class="btn btn-default pull-left custom-marg" />
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
