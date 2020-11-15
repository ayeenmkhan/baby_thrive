<div class="">
  <?php 
  header("X-XSS-Protection: 1; mode=block");
  header("X-Frame-Options: 1; mode=block");
  header("X-Content-Type-Options: 1; mode=block");
// auto_logout();
// var_dump($this->session->all_userdata());
  ?>
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="<?php echo SURL;?>admin/home" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>Baby</span><strong>Thrive</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BCD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Logout    -->
                <li class="nav-item"><a href="<?php echo SURL?>admin/logout_user" class="nav-link logout"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <?php $user= getUserByID($this->session->userdata('user_id'));?>
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center"><a href="#" data-toggle="modal" data-target="#profileModal">
              <div class="avatar"><img src="<?php if(@$user['image_url']!=''){ echo @$user['image_url']; } else{echo SURL."assets/img/placeholder.png";}  ?>" alt="..." class="img-fluid rounded-circle"></div></a>
        
<!-- echo SURL;?>assets/img/placeholder.png  -->

            <div class="title">
              <h1 class="h4"><?php echo @$user['full_name'];?></h1>
              <p>Admin</p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
    
        <li class="<?php echo @$_GET['h']?>"><a href="<?php echo SURL?>admin/home?h=active"> <i class="fa fa-users"></i>Users</a></li>
        <li class="<?php echo @$_GET['sr']?>"><a href="<?php echo SURL?>admin/survey_report?sr=active"> <i class="fa fa-list"></i>Survey Report</a></li>
        </nav>

          <!--USER Modal-->
                    <div id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">Edit Profile</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                             <form action="<?php echo SURL?>admin/edit_profile" method="post" class="form-validate" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label>Name</label>
                                  
                                <input type="text" name="name" required="" data-msg="Please enter a valid Name" class="form-control" value="<?php echo $user['full_name']?>">
                                </div>
                                 <div class="form-group"> 
                                 <input type="hidden" name="old_password" value="<?php echo $user['password'];?>">      
                                  <label>Change Password</label>
                                  <input type="password" placeholder="Password" minlength="5" name="password" class="form-control">
                                </div> 
                                <div class="form-group">      
                                  <label>Picture <small>( only jpg, png is allows and the file size should be 1 MB )262x262</small></label>
                                  <input type="hidden" name="old_image" value="<?php echo @$user['image_name']?>">
                                  <input type="file" id="profilePicture" name="picture" onchange="return validateFile(this)" class="form-control">
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
                                            <script type="text/javascript">
                        function validateFile(fld) {
      let input= document.getElementById('profilePicture');
      // console.log("FILE Size is ",input.files[0].size)
      let size= input.files[0].size;
      if(Number(size) > Number(1000000)){
        alret("Image size increase from the required limit!");
        fld.form.reset();
        fld.focus(); 
        return false;
      }
    if(!/(\.bmp|\.gif|\.jpg|\.jpeg|\.png)$/i.test(fld.value) ) {
        alert("Invalid image file type ! Please Select Valid Image Type");      
        fld.form.reset();
        fld.focus();        
        return false;   
    }   
    return true; 
 }
                      </script>