 <!-- Page Footer-->
<!--  <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>Haris Tech &copy; <?php echo date('Y');?></p>
                </div>
                <div class="col-sm-6 text-right">
                  <p>HE Management System</p>
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div> -->
            <script type="text/javascript">
var a = document.querySelectorAll(".list-unstyled li a");
for (var i = 0, length = a.length; i < length; i++) {
  a[i].onclick = function() {
    var b = document.querySelector(".list-unstyled li.active");
    if (b) b.classList.remove("active");
    this.parentNode.classList.add('active');
  };
}
    </script>
    <!-- JavaScript files-->
    <script src="<?php echo SURL; ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo SURL; ?>assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="<?php echo SURL; ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo SURL; ?>assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="<?php echo SURL; ?>assets/vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo SURL; ?>assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- <script src="<?php echo SURL; ?>assets/js/forms-validation.js">   </script> -->
    <!-- <script src="<?php echo SURL; ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script> -->
    <!-- MultiSelect-->
    <script src="<?php echo SURL; ?>assets/vendor/multiselect/js/jquery.multi-select.js"> </script>
    <!-- <script src="<?php //echo SURL; ?>assets/js/charts-home.js"></script> -->
      <!-- Data Tables-->
    <script src="<?php echo SURL; ?>assets/vendor/datatables.net/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="<?php echo SURL; ?>assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="<?php echo SURL; ?>assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo SURL; ?>assets/vendor/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo SURL; ?>assets/js/tables-datatable.js"></script>
    <!-- Notifications-->
    <script src="<?php echo SURL; ?>assets/vendor/messenger-hubspot/build/js/messenger.min.js">   </script>
    <script src="<?php echo SURL; ?>assets/vendor/messenger-hubspot/build/js/messenger-theme-flat.js"></script>
    <script src="<?php echo SURL; ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <!-- <script src="<?php echo SURL; ?>assets/js/home-premium.js"> </script> -->
    <!-- Main File-->
    <script src="<?php echo SURL; ?>assets/js/front.js"></script>
<!--     <script type="text/javascript">
      $('#formid').validate({
    rules: { cover_photo: { required: true, accept: "png|jpe?g|gif", filesize: 1048576  }},
    messages: { inputimage: "File must be JPG, GIF or PNG, less than 1MB" }
});
    
    </script> -->
  </body>
</html>