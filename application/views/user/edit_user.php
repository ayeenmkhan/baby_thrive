<?php echo $header_script;?>
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>

	<div id="wrapper" class="preload">
		    <?php echo $header;?><!-- /top-nav-->
		<!-- /top-nav-->
        <!--Start Left Panel-->
        <?php echo $sidebar;?>	
		<!--End Left Panel-->
        
<div id="main-container">
    <div id="breadcrumb">
        <div id="topbar">
  <ol class="breadcrumb"><li class="active">Dashboard</li></ol>
</div>
    </div><!-- /breadcrumb-->
    <div class="main-header clearfix">
        <div class="page-title">
            <h3 class="no-margin">Edit User</h3>
            <!--<span>Welcome back Mr.Admin</span>-->
        </div><!-- /page-title -->
        
        <ul class="page-stats">
            
            <!--<li>
                <div class="value">
                    <span>My Income</span>
                    <h4>$<strong id="currentBalance">150</strong></h4>
                </div>
                
            </li>-->
        </ul><!-- /page-stats -->
    </div><!-- /main-header -->
    
    
    
    <div class="padding-md">
    <div class="costom-border-line">
        <form action="<?php echo SURL?>manage_user/edit_user_process" enctype="multipart/form-data" method="post" id="frm_add" >
        <div id="pass_res"></div>
        <!-- /.row -->
        <div class="costom-forem">
        <div class="row">
        <div class="col-md-6">
        <label class="">First Name</label>
       <input type="text" value="<?php echo ucfirst($user_detail[0]['first_name']);?>" placeholder="First Name" required id="shop_title" name="first_name" class="form-control">
        </div><!--end of col-->
        <div class="col-md-6">
        <label class="">Middle Name</label>
       <input type="text" value="<?php echo ucfirst($user_detail[0]['last_name']);?>" placeholder="Last Name" required id="shop_title" name="last_name" class="form-control">
        </div><!--end of col-->
        <div class="col-md-6">
        <label class="">Last Name</label>
       <input type="text" value="<?php echo ucfirst($user_detail[0]['last_name']);?>" placeholder="Last Name" required id="shop_title" name="last_name" class="form-control">
        </div><!--end of col-->
     
        </div><!--end of row-->
        <br>
        <div class="row">
        <div class="col-md-6">
        <label class="">User Name</label>
       <input type="text" readonly="readonly" value="<?php echo $user_detail[0]['user_name'];?>" placeholder="Shop Login" required name="User Name" class="form-control">
        </div><!--end of col-->
        <div class="col-md-6">
        <label class="">Password</label>
       <input type="password" placeholder="Password" id="password" name="password" class="form-control">
        </div><!--end of col-->
     
        </div><!--end of row-->
        <br>
        <div class="row">
        <div class="col-md-6">
        <label class="">Confirm Password</label>
       <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" class="form-control">
        </div><!--end of col-->
        <div class="col-md-6">
        <label class="">Status</label>
		<select name="status" class="form-control">
        	<option <?php if($user_detail[0]['status'] == 1){?> selected="selected" <?php }?> value="1">Active</option>
            <option <?php if($user_detail[0]['status'] == 0){?> selected="selected" <?php }?> value="0">In-Active</option>
        </select>
        </div><!--end of col-->
     
        </div><!--end of row-->
        <div class="row">
        <div class="col-md-12">
        <br><input type="hidden"  name="id" value="<?php echo $user_detail[0]['basic_detail_id']; ?>" class="form-control">
        <input type="submit" id="save" value="Update" class="btn btn-success btn-sm bounceIn animation-delay5 pull-right submit" />
        <!--<button class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right submit" id="save" type="submit" name="submit" value="submit" ><i class="fa fa-sign-in"></i> Update</button>-->
        </div>
        </div>
        </div>
        </form>
	</div>
    </div><!-- /.padding-md -->
</div>
<script>
	$(function () {
        $("#save").click(function () {
            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();
            if (password != confirmPassword) {
				//$("#pass_res").text("Passwords do not match.");
				$("#pass_res").html("<div class='alert alert-danger'>Password Mismatch</div>");
                return false;
            }
            return true;
        });
    });
	</script>	
	</div><!-- /wrapper -->

<?php echo $footer;?>