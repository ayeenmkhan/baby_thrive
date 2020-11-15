<?php echo $header_script;?>
<?php echo $header;?>

<div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <div class="row">
            <div class="col-lg-6">  
              <h2 class="no-margin-bottom">Welcome to dashboard</h2>
            </div>
          
            </div>
            </div>
          </header>
  

<!-- Tabs -->
<section id="tabs" class="updates no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
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
      <div class="col-md-12 ">
                  <div class="daily-feeds card"> 
                  
                    <div class="card-header">
                     
          <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm pull-right">Add User</button>
                     <h3>USERS</h3>
                    </div>

              <div class="card-body no-padding">
                <div class="table-responsive">
                    <table id="datatable2"  class="table">
                      <thead>
                        <tr>
                          <th>Sr#</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php $count=1;foreach($users as $res){?>
                        <tr>
                          <td><?php echo $count;?></td>
                          <td><?php echo $res['full_name'];?></td>
                          <td><?php echo $res['username'];?></td>
                          <td><?php echo $res['email_id'];?></td>
                          <td><?php echo $res['phone_no'];?></td>
                          <td>
                            <p>
                              <a href="#" data-toggle="modal" data-target="#userModal" onclick="EditUser(<?php echo $res['id']?>)"><i class="fa fa-edit fa-2x"></i></a>
                              <a href="<?php echo SURL?>admin/delete_user/<?php echo $res['id'];?>" onclick="return confirm('Are you sure want to delete ?') "><i class="fa fa-trash fa-2x"></i></a>
                            </p>
                          </td>
                        </tr>
                        <?php $count++;}?>                                              

                      </tbody>
                    </table>
                  </div>
                      <!-- Item-->
                    </div>
            <!--USER Modal-->
                      <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">User Profile</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                      <form action="<?php echo SURL?>admin/add_user" method="post" class="form-validate" enctype="multipart/form-data" >
                            <div class="modal-body">
                               
                                <div class="form-group">       
                                  <label>Full Name</label>
                                  <input type="text" placeholder="Name..." name="name" class="form-control" required="" data-msg="Please enter a valid name">
                                </div> 
                                <div class="form-group">       
                                  <label>Phone Number</label>
                                  <input type="text" placeholder="Phone..." name="phone_no" class="form-control" required="" data-msg="Please enter a valid name">
                                </div> 
                                <div class="form-group">       
                                  <label>Email ID</label>
                                  <input type="text" placeholder="Email" name="email" class="form-control" required="" data-msg="Please enter a valid name">
                                </div> 
                                  
                                  <div class="form-group">       
                                  <label>Username</label>
                                  <input type="text" placeholder="Username" name="username" class="form-control" required="" data-msg="Please enter a valid name">
                                  </div> 
                                  <div class="form-group">       
                                  <label>Password</label>

                                  <input type="password" placeholder="*************" name="password" class="form-control" required="" data-msg="Please enter a valid name">
                                </div>                                
                              
                            </div>
                            <div class="modal-footer">
                              <input type="submit" value="Submit" name="save" class="btn btn-primary">
                            </div>
                            </form>
                          </div>
                        </div>

                      </div>
                    

                      <!-- User modal end -->

                       <!--Edit USER Modal-->
                      <div id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">Update User</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                             <form action="<?php echo SURL?>admin/edit_user"  method="post" class="form-validate" enctype="multipart/form-data">
                            <div class="modal-body" id="editModal_body">
                             
                                
                              
                            </div>
                            <div class="modal-footer">
                              <input type="submit" value="Save Changes" name="save" class="btn btn-primary">
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
</div>
<!-- ./Tabs -->
<?php echo $footer;?>

<script type="text/javascript">

  function EditUser(id){
      $.ajax({

                type: "POST",
                url: "<?php echo SURL; ?>admin/edit_user",
                data: {user_id:id},
                success: function(result){
                $("#editModal_body").html(result);
           
           }
                        

                }); 
} 


    $(document).ready(function() {
        // alert('yess');
        $('#dataTables').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                // { extend: 'copy'},
                // {extend: 'csv'},
                // {extend: 'excel', title: 'ExampleFile'},
                // {extend: 'pdf', title: 'ExampleFile'},

                // {extend: 'print',
                //  customize: function (win){
                //         $(win.document.body).addClass('white-bg');
                //         $(win.document.body).css('font-size', '10px');

                //         $(win.document.body).find('table')
                //                 .addClass('compact')
                //                 .css('font-size', 'inherit');
                // }
                // }
            ]

        });
    });

</script>


