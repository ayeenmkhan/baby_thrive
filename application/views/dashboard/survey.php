<?php echo $header_script;?>
<?php echo $header;?>
<style>
  .marginbottom{
    margin-bottom: 4px;
  }
</style>
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
             <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm">Add Survey</button>
            </div>

              <div class="card-body no-padding">
             
                <div class="table-responsive">
                    <table id="datatable2"  class="table">
                      <thead>
                        <tr>
                          <th>Sr#</th>
                          <th>Survey Question</th>
                          <th>Category</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody> 
                      <?php $survey = getAllSurveyQuestions();?>
                      <?php $count=1; foreach($survey as $res){?>
                      <?php $category= getCategoryByID($res['category_id'])?> 
                        <tr>
                          <td> <?php echo $count;?></td>
                          <td><?php echo $res['question'];?></td>
                          <td><?php if($category){ echo $category['category_name'];}else{ echo $res['category_id'];}?></td>
                          <td>
                          <p>
                          <a href="#" data-toggle="modal" data-target="#userModal" onclick="Edit(<?php echo $res['id']?>)"><i class="fa fa-edit fa-2x"></i></a>
                          <a href="<?php echo SURL?>admin/delete_survey/<?php echo $res['id'];?>" onclick="return confirm('Are you sure want to delete ?') "><i class="fa fa-trash fa-2x"></i></a>
                        </p>
                          </td>
                        </tr>
                      <?php $count++;}?>
                      </tbody>                                                                                      </tbody>
                    </table>
                  </div>
                      <!-- Item-->
                    </div>
            <!--USER Modal-->
                      <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">New Survey</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <form action="<?php echo SURL?>admin/add_survey" method="post" class="form-validate" enctype="multipart/form-data">
                            <div class="modal-body">
                            <div class="form-group">       
                              <input type="hidden" name="playlist_id" value="<?php echo $playlist_id;?>">
                                  <label>Category</label>
                                  <select class="form-control" name="category" required>
                                  <option value=''>Select Category</option>
                                  <?php $categories = getallCategories();?>
                                  <?php foreach($categories as $res) {?>
                                    <option value="<?php echo $res['id'];?>"><?php echo $res['category_name'];?></option>
                                  <?php }?>
                                  </select>
                            </div> 

                                <div class="form-group">       
                                  <label>Question</label>
                                  <input type="text" placeholder="Survey Question" name="question" class="form-control" required="" data-msg="Please enter a valid">
                                </div> 
                                <table id="survey">
                                <tr id="row-1">
                                <td>
                                <div class="form-group" id="newOption">       
                                <label>Option 1</label>
                                <input type="text" placeholder="survey option" name="option[]" class="form-control marginbottom" required="" data-msg="Please enter a valid" >                                
                                </div>
                                </td>
                              
                                <td>
                                <a href='#' onclick="removeRow('survey',1)"><i class='fa fa-close' style='color: red;font-size:18px;'></i></a>
                                </td>
                                </tr>
                               
                                </table> 
                                <div class="form-group"> 
                                <input type="button" onClick="add_options()" value="Add New" class="btn btn-primary btn-sm">
                                </div>            
                            </div>
                            <div class="modal-footer no-margin">
                              <input type="submit" value="Save" name="save" class="btn btn-primary">
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
                              <h4 id="exampleModalLabel" class="modal-title">Update Survey inforamtion</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                             <form action="<?php echo SURL?>admin/edit_survey"  method="post" class="form-validate">
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
 function add_options(){
       var i = $('#newOption .marginbottom').length;
       var rows = "";
       i=i+1;
       rows += "<tr id='row-" + i + "'><td><div class='form-group' id='newOption'>"+       
                                "<label>Options "+i+"</label>"+
                                "<input type='text' placeholder='survey option' name='option[]' class='form-control marginbottom' required='' data-msg='Please enter a valid' >"+                                
                                "</div>"+
                                "</td>"+
                                "<td>"+
                                "<a href='#'' onclick=removeRow('survey',"+i+")><i class='fa fa-close' style='color: red;font-size:18px;'></i></a>"+
                                "</td> </tr>";
        $(rows).appendTo("#survey");
  }
      function removeRow(table, row) {
       // alert(table);
    $('#' + table + ' ' + '#row-' + row).remove();
}

  function Edit(id){
      $.ajax({

                type: "POST",
                url: "<?php echo SURL; ?>admin/edit_survey",
                data: {question_id:id},
                success: function(result){
                $("#editModal_body").html(result);
           
           }
                        

                }); 
} 

</script>
<?php echo $footer;?>


