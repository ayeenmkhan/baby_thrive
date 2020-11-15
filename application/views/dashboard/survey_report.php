survey_report<?php echo $header_script;?>
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
             <!-- <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm">Add Survey</button> -->
            </div>

              <div class="card-body no-padding">
             
                <div class="table-responsive">
                    <table id="datatable2"  class="table">
                      <thead>
                        <tr>
                          <th>Sr#</th>
                          <th>Question ID</th>
                          <th>Sub Question ID</th>
                          <th>User Name</th>
                          <th>Total Score</th>
                          <th>Obtain Score</th>
                          <th>Attempts</th>
                          <th>TimeStamp</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody> 
                    
                      <?php $count=1; foreach($report as $res){?>
                      <?php $username= getUserByID($res['user_id'])?> 
                      <?php $question= getQuestionByID($res['question_id'])?> 
                        <tr>
                          <td> <?php echo $count;?></td>
                          <td><?php echo $question['question'];?></td>
                          <td><?php echo $res['sub_q'];?></td>
                          <td><?php echo $username['full_name'];?></td>
                          <td><?php echo $res['total_score'];?></td>
                          <td><?php echo $res['obtain_score'];?></td>
                          <td><?php echo $res['attempt'];?></td>
                          <td><?php echo $res['timestamp'];?></td>
                          <td>
                          <p>
                          <a href="<?php echo SURL?>admin/delete_report/<?php echo $res['id'];?>" onclick="return confirm('Are you sure want to delete ?') "><i class="fa fa-trash fa-2x"></i></a>
                        </p>
                          </td>
                        </tr>
                      <?php $count++;}?>
                      </tbody>                                                                                      </tbody>
                    </table>
                  </div>
                      <!-- Item-->
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


