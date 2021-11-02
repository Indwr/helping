
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
    background-color: #0e5d76;;
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
               <h4><?php echo $header;?></h4> 
            </div>
            <div class="card-body">
           <?php echo form_open(''); ?>
                  <div>
                     <?php 
                           if($this->session->flashdata('message')){
                            ?>
                           <div class="alert alert-danger alert-dismissable" role="alert">
                               <!-- <div class="alert-icon contrast-alert"><i class="fa fa-times"></i></div> -->
                               <div class="alert-message">

                               <span>
                                  <?php echo $this->session->flashdata('message'); ?>
                                </span>
                               </div>
                             </div>
                             <?php
                           }
                           ?>
                      <!-- <h3>Account</h3> -->
                      <section>
                        <div class="form-group">
                              <label class="col-lg-12 control-label">User id*</label>
                              <input class="form-control" type="text" value="<?php echo $user['user_id'];?>" readonly="">
                          </div>
                          <div class="form-group">
                              <label for="userName">User name *</label>
                              <input class="form-control" type="text" name="userName" value="<?php echo $user['name'];?>">
                          </div>
                          <div class="form-group">
                              <label for="password"> Phone *</label>
                              <input type="number" class="form-control" name="phone" value="<?php echo $user['phone'];?>">
                          </div>
                          <div class="form-group">
                              <label>E-Mail *</label>
                              <input name="email" type="email" class="form-control" value="<?php echo $user['email'];?>">
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
