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
            <h3 class="no-margin">Assign Role/Permission</h3>
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
    <div class="col-md-12">
					 <?php
                            if($this->session->flashdata('err_message')){
                        ?>
                                <div class="alert alert-danger"><center><?php echo $this->session->flashdata('err_message'); ?><center></div>
                        <?php
                            }//end if($this->session->flashdata('err_message'))
                            
                            if($this->session->flashdata('ok_message')){
                        ?>
                                <div class="alert alert-success alert-dismissable"><center><?php echo $this->session->flashdata('ok_message'); ?><center></div>
                        <?php 
                            }
                        ?>
                </div>
    <div>&nbsp;</div>
    
    <div class="padding-md">
    <div class="costom-border-line">
        <form action="<?php echo SURL?>manage_user/edit_role_process" enctype="multipart/form-data" method="post" id="frm_add" >
        <div id="pass_res"></div>
        <!-- /.row -->
        <div class="costom-forem">
        <div class="row">
        <div class="col-md-6">
        <label class="">Account Title</label>
        <select name="user" class="form-control">
            <option value="">Select User</option>
            <?php foreach ($user as $key=>$user){?>
            <option value="<?php echo $user['id'];?>"<?php if($edit_role['user_id']==$user['id']){echo 'selected';}?>><?php echo $user['name'];?></option>
            <?php }?>
        </select>
       <!--<input type="text" placeholder="First Name" required id="first_name" name="first_name" class="form-control">-->
        </div><!--end of col-->
        <div class="col-md-6">
        <label class="">Role Type</label>
        <select name="role" class="form-control">
            <option value="">Select Role</option>
            <?php foreach ($user_role as $key=>$role){?>
            <option value="<?php echo $role['role_id'];?>"<?php if($edit_role['role_id']==$role['role_id']){echo 'selected';}?>><?php echo $role['role_title'];?></option>
            <?php }?>
        </select>
       <!--<input type="text" placeholder="Last Name" required name="last_name" class="form-control">-->
        </div><!--end of col-->
     
        </div><!--end of row-->
        <br>
      
        <div class="row">
        <div class="col-md-6">
            <label class="">Assign Permission</label><br>
       <div class="checkbox">
           
           <?php foreach ($user_permission as $key=>$per){?>
           <?php $permission= getUserPermissions($edit_role['role_id']);?>
           <?php if($permission){?>
           <?php foreach ($permission as $perm){?>
           <?php if($perm['permission_id']==$per['permission_id']){?>
           <label><input type="checkbox" name="permission[]" value="<?php echo $per['permission_id'];?>"<?php if($perm['permission_id']==$per['permission_id']){echo 'checked';}?>><?php echo $per['permission_title'];?></label>
           
           <?php } ?>
           <!--<label><input type="checkbox" name="permission[]" value="<?php echo $per['permission_id'];?>"><?php echo $per['permission_title'];?></label>-->

           <?php };?>
           <?php };?>
           <label><input type="checkbox" name="permission[]" value="<?php echo $per['permission_id'];?>"><?php echo $per['permission_title'];?></label>

           <?php }?>
           


          
        
         
    </div>
            <input type="hidden" class="form-control" name="user_id" value="<?php echo $id ?>">   
         </div>     
       
       <!--end of col-->
     
        </div><!--end of row-->
        <br>

        <div class="row">
        <div class="col-md-12">
        <br>
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