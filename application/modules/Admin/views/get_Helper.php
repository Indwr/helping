
<?php
  require_once 'header.php';
?>
<style>
  
  #request {
    width: 100%;
    padding: 5px 0px;
    font-size: 18px;
}
#request option {
    color: #fff;
}

  .alert-danger {
    color: #ffffff;
    background-color: #0e5d76;
    border-color: #f5365c;
}
.alert .alert-message {
    display: table-cell;
    padding: 20px 15px 20px 15px;
    font-size: 14px;
}
.alert .contrast-alert {
    background-color: rgba(255, 255, 255, 0.2);
}

</style>

<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">
     <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
       
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-10">
          <div class="card">
           <!--  <div class="card-header text-uppercase">
               PAYMENT REQUEST 
            </div> -->
                <!-- <?php //echo $this->session->flashdata('message'); ?> -->
           <?php echo form_open('','id="myform"');?>

            <div class="card-body">
                  <h3><?php echo $header;?></h3>
           
                      
                     <div class="form-group">
                      <label for="userName">User Id *</label>
                      <input class="form-control" type="text" name="user_id" value="" id="user_id" onblur="check_user();" placeholder="User Id">
                  </div>
                   <div class="form-group">
                      <label for="userName">User Name *</label>
                      <input class="form-control" type="text" name="user_name" id="user_name" value="" placeholder="User Name" readonly="">
                  </div>
                
            <!-- </div> -->
                  <div class="form-group">
                      <label for="userName">Amount*</label>
                      <input class="form-control" type="number" name="helpamount"  value="" placeholder="Help Amount">
                  </div>
                  <!-- <div class="form-group">
                      <label for="userName">Proof Image*</label>
                      <input class="form-control" type="file" name="pimage"  value="">
                  </div> -->
                  <div class="form-group">
                              <input type="submit" class="btn btn-info" value="submit">
                          </div>
                          <br>
                               <?php 
                               if($this->session->flashdata('message')){
                                ?>
                               <div class="alert alert-danger alert-dismissable" role="alert">
                                   <div class="alert-icon contrast-alert"><i class="fa fa-times"></i></div>
                                   <div class="alert-message">

                                   <span>
                                      <?php echo $this->session->flashdata('message'); ?>
                                    </span>
                                   </div>
                                 </div>
                                 
                                 <?php
                                     }
                               ?>
                    </div> 
           
        <!-- End Row-->
  </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
    <script>

      $(document).on('blur', '#user_id', function () {
      check_user();
      })
      function check_user() {
      var user_id = $('#user_id').val();
      if (user_id != '') {
      var url = '<?php echo base_url("Admin/Dashboard/userName/") ?>' + user_id;
      $.get(url, function (res) {
      $('#user_name').val(res);
      })
      }
      }
      check_user();
      $(document).on('submit', '#myform', function () {
      if (confirm('Please Check All The Fields Before Submit')) {
      yourformelement.submit();
      } else {
      return false;
      }
      })

 </script>
</div>
</div>
</div>
</div>
  
  <?php
    require_once 'footer.php';
  ?>
