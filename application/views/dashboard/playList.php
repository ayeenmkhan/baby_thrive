<?php echo $header_script;?>
<?php echo $header;?>

<div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <div class="row">
            <div class="col-lg-6">  
              <h2 class="no-margin-bottom">Welcome to Dashboard </h2>
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
             <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm">Add New Video</button>
            </div>

              <div class="card-body no-padding">
             
                <div class="table-responsive">
                    <table id="datatable2"  class="table">
                      <thead>
                        <tr>
                          <th>Sr#</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Video File</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>  
                      <?php $count=1; foreach($playList as $res){?>
                        <tr>
                          <td><?php echo $count;?> </td>
                          <td><?php echo $res['english_title'];?></td>
                          <td><?php echo $res['english_desc'];?></td>
                          <td><video width="180" height="100" controls>
                                <source src="<?php echo $res['file_path'];?>" type="video/mp4">
                                <source src="<?php echo $res['file_path'];?>" type="video/ogg">
                              </video>
                          </td>
                          <td>
                          <p>
                             <a href="<?php echo SURL?>admin/survey/<?php echo $res['id'];?>?r=active"><i class="fa fa-arrow-circle-right fa-2x"></i></a>  
                             <a href="#" data-toggle="modal" data-target="#userModal" onclick="Edit(<?php echo $res['id']?>)"><i class="fa fa-edit fa-2x"></i></a> 
                          <a href="<?php echo SURL?>admin/delete_audio/<?php echo $res['id'];?>" onclick="return confirm('Are you sure want to delete ?') "><i class="fa fa-trash fa-2x"></i></a>
                        </p>
                          </td>
                        </tr>                                                             
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                      <!-- Item-->
                    </div>
            <!--USER Modal-->
                      <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">New Video File</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <form action="<?php echo SURL?>admin/add_video" method="post" class="form-validate" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">       
                                  <label>Title</label>
                                  <input type="text" placeholder="English Name" name="name_en" class="form-control" required="" data-msg="Please enter a valid">
                                </div>  
                                <div class="form-group">       
                                  <label>Description</label>
                                  <textarea class="form-control" name="description_en" placeholder="Description"></textarea>
                                </div>
                              
                                  <div class="form-group">       
                                  <label>Video File</label>
                                  <input type="file" name="video_file" class="form-control">
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
                              <h4 id="exampleModalLabel" class="modal-title">Update PlayList</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                             <form action="<?php echo SURL?>admin/edit_playlist"  method="post" class="form-validate" enctype="multipart/form-data">
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

<script type="text/javascript">

  function Edit(id){
      $.ajax({

                type: "POST",
                url: "<?php echo SURL; ?>admin/edit_playlist",
                data: {audio_id:id},
                success: function(result){
                $("#editModal_body").html(result);
           
           }
                        

                }); 
} 


</script>
<?php echo $footer;?>


