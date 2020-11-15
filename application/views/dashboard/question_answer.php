<?php echo $header_script;?>
<style type="text/css">
.post {
  width: 30%;
  /*margin: 10px auto;*/
  border: 1px solid #cbcbcb;
  padding: 5px 10px 0px 10px;
}
.like, .unlike, .likes_count {
  color: blue;
}
.hide {
  display: none;
}
.fa-thumbs-up, .fa-thumbs-o-up {
  transform: rotateY(-180deg);
  font-size: 1.3em;
}
</style>
<?php echo $header;?>

        <div class="content-inner">
            <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <div class="row">
            <div class="col-lg-6">  
              <h2 class="no-margin-bottom">Welcome To School Learning Management System </h2>
            </div>
          
            </div>
            </div>
          </header>
          <section>
            <div class="container-fluid">
              <div class="card">
                <div class="card-header">
                  <h4>Courses Report</h4>
                </div>

                <div class="card-body">
                 
                  <div class="table-responsive">
                   <a href="#" data-toggle="modal" data-target="#questionModal" class="btn btn-success btn-sm ">Add New Question</a>
                    <table id="datatable1" style="width: 100%;" class="table">
                      <thead>
                        <tr>
                          <th>Course Name</th>
                          <th>Question</th>
                          <th>Likes</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php foreach($question as $res){?>
                          <?php $coursesInfo = getCourseInfoByID($res['course_id']);?>	
                        <?php if($coursesInfo){?>
                        <tr>
                        <td><a href="javascript:void(0)" class="text-muted"><?php echo $coursesInfo['name'];?></a></td>
                         <td><?php echo $res['question']?></td>
                          <td> <div class="post"><span class="likes_count"><?php echo $res['no_like']?> likes</span></div></td>
                          <td>
                            <?php $likes= getStudentsLikes($res['user_id'],$res['id']);
                            if($likes){
                            ?>
                          <a href="#">
                            <p><span class="unlike fa fa-thumbs-up fa-2x" data-id="<?php echo $res['id']; ?>"></span> 
                            <span class="like hide fa fa-thumbs-o-up fa-2x" data-id="<?php echo $res['id']; ?>"></span></p>
                          </a>
                          <?php }else {?>
                            <a href="#">
                            <p>
                              <!-- user has not yet liked post -->
                            <span class="like fa fa-thumbs-o-up fa-2x" data-id="<?php echo $res['id']; ?>"></span> 
                            <span class="unlike hide fa fa-thumbs-up fa-2x" data-id="<?php echo $res['id']; ?>"></span>
                            </p>
                          </a>
                          <?php }?>
                          </td>  
                        </tr>
                       <?php }?>
                       <?php }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!--USER Modal-->
                      <div id="questionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">Add Question</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                             <form action="<?php echo SURL?>admin/add_question" method="post" class="form-validate" enctype="multipart/form-data">
                            <div class="modal-body">
                        
                         
                                <div class="form-group">       
                                  <label>Course</label>
                                     <select class="form-control" name="course_id" required="" data-msg="Please Select">
                                    <option value="">Select</option>
                                    <?php foreach($student_courses as $res){?>
                                  <?php $coursesInfo = getCourseInfoByID($res['course_id']);?>
                                    <option value="<?php echo $res['course_id'];?>"><?php echo $coursesInfo['name'];?></option>
                                  <?php } ?>
                                    
                                  </select>
                                </div>
                                <div class="form-group">       
                                  <label>Question</label>
                                  <textarea name="question" class="form-control"></textarea>
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
<?php echo $footer;?>

<script type="text/javascript">
  
  $(document).ready(function(){
    // when the user clicks on like
    $('.like').on('click', function(){
      var question_id = $(this).data('id');
       // alert(question_id);

      $.ajax({
        url: '<?php echo SURL;?>admin/like',
        type: 'post',
        data: {
          'liked': 1,
          'question_id': question_id
        },
        success: function(response){
          setTimeout(function(){location.reload(); }, 1000);
         //  $('.post').parent().find('span.likes_count').text(response + " likes");
         //  $('.post').addClass('hide');
         // $('.post').siblings().removeClass('hide');
        }
      });
    });

    // when the user clicks on unlike
    $('.unlike').on('click', function(){
      var question_id = $(this).data('id');

      $.ajax({
        url: '<?php echo SURL;?>admin/unlike',
        type: 'post',
        data: {
          'unliked': 1,
          'question_id': question_id
        },
        success: function(response){
          setTimeout(function(){location.reload(); }, 1000);
          // $('.post').parent().find('span.likes_count').text(response + " likes");
          // $('.post').addClass('hide');
          // $('.post').siblings().removeClass('hide');
        }
      });
    });
  });
</script>