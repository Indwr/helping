
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
    background-color: #f5365c;
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
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header text-uppercase">
               Request Fund 
            </div>
            <div class="card-body">

            <?php 
            echo validation_errors();
            echo $this->session->flashdata('message'); ?>
           <?php echo form_open_multipart('');?>
                      <!-- <h3>Account</h3> -->
             <section>
                  <div class="form-group">

                  <label for="">Request Method*</label>
                <select  id="request"  name="pay">
                  <option value='Paytm'>Paytm</option>
                  <option value='Google Pay'>Google Pay</option>
                  <option value='Phone Pay'>Phone Pay</option> 

                </select>
                 </div>

                        <div class="form-group">
                            <label>Amount *</label>
                            <input name="amount" type="number" class="form-control" value="" placeholder="Enter Amount">
                        </div>
                        <div class="form-group">
                            <label>Transation Password*</label>
                            <input name="txn_id" type="number" class="form-control" value="" placeholder="Enter Transation Password">
                        </div>
                        <div class="form-group">
                            <label>Image *</label>
                            <input name="proof_img" type="file" class="form-control" value="">
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="submit">
                        </div>
                    </section>
                          
                </div> 
            </div>
        <!-- End Row-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
           
          </div>
        </div>
      </div><!-- End Row-->
<!--start overlay-->
    <div class="overlay"></div>
  <!--end overlay-->
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  </div>
</div>
</div>
</div>
  <?php
    require_once 'footer.php';
  ?>
