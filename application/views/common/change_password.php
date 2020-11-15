password<?php echo $header_script;?>

<?php echo $sidebar;?>	

<?php echo $header;?>


   <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Basic Form</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Forms</a>
                        </li>
                        <li class="active">
                            <strong>Add User Form</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change Password <small>Employee Information</small></h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="<?php echo SURL?>admin/change_password" enctype="multipart/form-data" class="form-horizontal">
                                <div class="hr-line-dashed"></div>
                                <?php $profile= getEmployeeProfileByID($this->session->userdata('p_no'))?>
                                <div class="form-group"><label class="col-sm-2 control-label">Username *</label>
                                    <div class="col-sm-10"><input type="text" placeholder="Username" value="<?php echo $profile['username']?>" name="username" class="form-control" readonly>  </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Old Password *</label>

                               <div class="col-sm-10"><input type="password" placeholder="Password" name="old" class="form-control" name="password" required></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Password *</label>

                               <div class="col-sm-10"><input type="password" placeholder="Password" name="password" class="form-control" name="password" required></div>
                                </div>
                                <!-- <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label">Profile Picture</label>

                                    <div class="col-lg-10"><input type="file" name="picture" class="form-control "></div>
                                </div> -->
                               
                                <div class="hr-line-dashed"></div>
    
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                            
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<script type="text/javascript">
	
	        function getSection(){
	        	// alert("yess")
	        	var dep=$('#department').val();
            $.ajax({

                type: "POST",

                url: "<?php echo SURL; ?>admin/get_section",

                data: {department_id:dep},

                success: function(result){
					 $("#section").html(result);
					 
					 }
                        

                });       

        }
</script>

<?php echo $footer;?>