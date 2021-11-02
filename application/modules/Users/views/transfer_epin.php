
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
            <div class="card-header text-uppercase">
               Transfer Epins 
            </div>
            <?php echo'<div class="text-danger">'.$this->session->flashdata('error').'</div>'; ?>
            <?php echo '<div class="text-success">'.$this->session->flashdata('success').'</div>'; ?>
           <?php echo form_open('');?>

            <div class="card-body">
                  <!-- <h3>Account</h3> -->
                        
                     <div class="form-group">
                      <label for="userName">User Id *</label>
                      <input class="form-control" type="text" name="user_id" id="user_id" value=""  onblur="check_user();" placeholder="User Id">
                  </div>
                   <div class="form-group">
                      <label for="userName">User Name *</label>
                      <input class="form-control" type="text" name="user_name" id="user_name" value="" placeholder="User Name" readonly="">
                  </div>
                 <!--  <div class="form-group">
                        <label for="">Select Package</label>
                        <select class="form-control" id="input-6" name="package" >
                        </select>
                  </div> -->
                  <div class="form-group">
                      <label for="userName">NO. E-pins*</label>
                      <input class="form-control" type="number" name="nepins"  value="" placeholder="Transfer Epin">
                  </div>
                  <div class="form-group">
                      <label for="userName">Transation Password*</label>
                      <input class="form-control" type="number" name="txnpass"  value="" placeholder="Transation Password">
                  </div>
                  <div class="form-group">
                              <input type="submit" class="btn btn-info" value="submit">
                          </div>
                  </div> 
           
        <!-- End Row-->
  </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
    <a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
    <script>

        $(document).on('blur', '#user_id', function () {
        check_user();
        })
        function check_user() {
        var user_id = $('#user_id').val();
        if (user_id != '') {
        var url = '<?php echo base_url("Users/Dashboard/sponser_name/") ?>' + user_id;
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
