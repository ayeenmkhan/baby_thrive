<?php echo $header_script;?>
<style type="text/css">
  #g-recaptcha-response {
    display: block !important;
    position: absolute;
    margin: -78px 0 0 0 !important;
    width: 302px !important;
    height: 76px !important;
    z-index: -999999;
    opacity: 0;
}
</style>
<?php //var_dump($this->session->userdata('attempt'));?>
<div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <!-- <div class="logo" style="position: relative;left: 230px;"> -->
                   <!-- <img src="<?php// echo SURL;?>assets/img/PTCL_Logo.png" width="70" height="70"> -->
                    <!-- <h1>PTCL</h1> -->
                  <!-- </div> -->
                  <div class="text-center">
                   <!-- <img src="<?php echo SURL;?>uploads/logo.png" height="200px"> -->
                    <h1 class="text-center">Baby Thrive App</h1>
                  </div>
             
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">

                  <form method="post" action="<?php echo SURL;?>admin/login_process" class="form-validate">
                               <?php
                       if($this->session->flashdata('err_message')) { ?>
            <div class="form-group">
            <div class="alert alert-danger"><center><?php echo $this->session->flashdata('err_message'); ?><center></div>
            </div>
                        <?php }?>
                    <div class="form-group">
                      <input id="login-username" type="text" name="username" required data-msg="Please enter your username" class="input-material">
                      <label for="login-username" class="label-material">User Name</label>
                    </div>
                    <div class="form-group">
                      <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                      <label for="login-password" class="label-material">Password</label>
                    </div>
                  <div id="Loginbutton">
                  <input type="hidden" name="counter" id="counter" value="<?php echo ($this->session->userdata('attempt') ? $this->session->userdata('attempt') : 0);?>">
                  <?php if($this->session->userdata('attempt')>=3){?>
                    <div class="form-group">
                    <div class="g-recaptcha"  data-sitekey="6Ldp4mcUAAAAAAl7-yRVDM1YQ3YG0kGI_Az30frh"></div>
                  </div>
                  <?php }?>
                  
                    <input type="submit" name="submit" value="Login" class="btn btn-primary">
                  </div>
                  <div id="LoginMessage" style="display: none;">
                    <h3 style="color: red;">Your account is suspended for for 15 Minutes</h3>
                  </div>
                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                  </form><!-- <a href="#" class="forgot-pass">Forgot Password?</a><br><small>Do not have an account? </small><a href="register.html" class="signup">Signup</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
  window.onload = function() {
    // alert("test")
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "Please Verify that you are human");
    }
 localStorage.setItem("counter", $('#counter').val());  
 var counter= localStorage.getItem("counter");
 if(counter>=7){
    localStorage.setItem("logtime",new Date().getTime());
    $('#Loginbutton').hide();
    $('#LoginMessage').show();
 }
 var currentTime= new Date().getTime();
 var logTime= localStorage.getItem("logtime");
 var diff = parseInt(currentTime) - parseInt(logTime);
   // var_dump("expression");exit;
  if (diff > 900){
    $('#Loginbutton').show();
    $('#LoginMessage').hide();
  }
};

</script>
    <?php echo $footer;?>