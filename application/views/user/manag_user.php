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
    
    
    <div class="padding-md">
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                        <div id="placeholder"  style="height:1px; visibility:hidden;"></div>
                
                
                </div><!-- /panel -->
                        
        
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>User Management</strong>
						<hr>
             <div class="col-md-1">           
           <a href="<?php echo base_url();?>manage_user/add_user" class="btn btn-success btn-sm bounceIn animation-delay5 "><i class="fa fa-sign-in"></i> Add User</a>
           </div>
           <div class="col-md-3">
           <div class="costom-serch-form">  
                        <input type="text" class="form-control" name="serch_user" onkeyup="serch_res()" id="serch_user" placeholder="Search"/>
                        </div>
                        </div>
        <!--<button class="btn btn-success btn-sm bounceIn animation-delay5 " id="submit" type="submit" name="submit" value="submit" ><i class="fa fa-sign-in"></i> Add</button>-->
                        <!--<span class="badge badge-info pull-right">	
                            <a href="#" style="color:#fff;">View All</a>
                        </span>-->
                    </div>
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
                    <div class="costom-table-agline">
                    <div class="clearfix"></div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="costom-thead-bg">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th  class="no-sort">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="responce_res">
                            <?php if(isset($all_user) && (count($all_user) > 0)){$count = 1;
			      foreach($all_user as $res){	
							?>
                            <tr>
                                <td><?php echo $count;?></td>
                                <?php $name= getUserCNIC($res['basic_detail_id'])?>
                                <td><?php echo ucfirst($name['first_name']); ?></td>
                                <td><?php echo $res['user_name'] ?></td>
                                <td>
                                	<?php if($res['status']==1){?>
                                    <span class="label label-success">Active</span>
                                    <?php }else if($res['status']==2){?>
                                    <span class="label label-info">Leaving HPK</span>
				  <?php } else {?>
                                    <span class="label label-danger">Inactive</span>

                                      <?php }?>
                                </td>
                                <td><?php echo date('M d Y',strtotime($res['created_date'])); ?></td>
                                <td>
                                <div class="btn-group">
                                    <button class="btn btn-success">Action</button>
                                    <button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                    <ul class="dropdown-menu slidedown">
                                        <!--<li><a href="#">View Profile</a></li>-->
                                        <li><a href="<?php echo base_url();?>manage_user/view_employee_profile/<?php echo $res['basic_detail_id']; ?>">View Profile</a></li>
                                        <li><a href="<?php echo base_url();?>manage_user/view_employee_report/<?php echo $res['basic_detail_id']; ?>">View Report</a></li>
                                        <li><a href="<?php echo base_url();?>manage_user/salary_revision/<?php echo $res['basic_detail_id']; ?>">Salary Revision</a></li>
                                        <li><a href="<?php echo base_url();?>manage_user/request_form/<?php echo $res['basic_detail_id']; ?>">Request Form</a></li>
                                        <?php if($this->session->userdata('user_role')['role_id']==2){?>
                                        <li><a href="<?php echo base_url();?>manage_user/mapping_approver/<?php echo $res['basic_detail_id']; ?>">Mapping</a></li>
                                        <?php }?>
                                        <li><a href="<?php echo base_url();?>manage_user/leaving_job/<?php echo $res['basic_detail_id']; ?>">Leave HPK</a></li>
                                        <li><a href="<?php echo base_url();?>manage_user/view_leaving_report/<?php echo $res['basic_detail_id']; ?>">View Leaving Report</a></li>
                                        <li><a href="<?php echo base_url();?>manage_user/edit_user/<?php echo $res['id']; ?>">Edit</a></li>
                                        <li><a onclick="return del_rec();" href="<?php echo base_url();?>manage_user/delete_user/<?php echo $res['id']; ?>">Delete</a></li>
                                        
                                    </ul>
                                </div>
                                </td>
                            </tr>
                            <?php $count++;}
							}else{?>
                            <tr>
                                <td colspan="4">No record Found</td>
                            </tr>
                            <?php }?>
                            
                        </tbody>
                    </table>
                     <div id="pag_dis"><?php  echo $this->pagination->create_links();?> </div>
                    </div>
                    </div>
                </div><!-- /panel -->
                
            </div><!-- /.col -->
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.padding-md -->
</div>
<script>
	function del_rec(){
		if (confirm('Are you sure you want to Delete?')) {
			return true;
		} else {
			return false;
			// Do nothing!
		}
	}
	function serch_res(){
		var serch_data = $('#serch_user').val();
		//alert(serch_data);
		$("#pag_dis").hide();
		
		$.ajax({
			type: "post",
			url: "<?php echo SURL;?>manage_user/search_user",
			cache: false,	
			data: {serch_data: serch_data},
			
			success: function(response){
			$('#responce_res').html(response);
			}
		});
	}
</script>	
	</div><!-- /wrapper -->

<?php echo $footer;?>