<?php
	require_once 'header.php';
?>
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <!-- <div class="container-fluid"> -->

    <!-- <div class="card">
        <div class="card-header text-uppercase">Users Management</div> -->
         <div class="row mt-3" style="margin: 0px;">
         <div class="col-12 col-md-6 col-lg-3 col-xl-3">
         <div class="card">
        <div class="card-body">
          <div class="media align-items-center">
          <div class="media-body">
            <h5 class="mb-0"><?php echo $total;?></h5>
            <a href="<?php echo base_url('Admin/Dashboard/allusers/0');?>">Total Users</a>
            <!-- <p class="mb-0"></p> -->
          </div>
          <div class="w-icon"><i class="zmdi zmdi-face text-white"></i></div>
          </div>
          <div class="progress-wrapper mt-3">
              <div class="progress mb-0" style="height: 5px;">
              <div class="progress-bar" role="progressbar" style="width: 45%"></div>

            </div>
         </div>
        </div>
        </div>
     </div>
     <div class="col-12 col-md-6 col-lg-3 col-xl-3">
         <div class="card">
        <div class="card-body">
          <div class="media align-items-center">
          <div class="media-body">
            <h5 class="mb-0"><?php echo $paid;?></h5>
            <a href="<?php echo base_url('Admin/Dashboard/allusers/1');?>">Paid Users</a>
            <!-- <p class="mb-0">Paid Users</p> -->
          </div>
          <div class="w-icon"><i class="zmdi zmdi-accounts-alt text-white"></i></div>
          </div>
          <div class="progress-wrapper mt-3">
              <div class="progress mb-0" style="height: 5px;">
              <div class="progress-bar" role="progressbar" style="width: 55%"></div>
            </div>
         </div>
        </div>
        </div>
     </div>
     
     <div class="col-12 col-md-6 col-lg-3 col-xl-3">
         <div class="card">
        <div class="card-body">
          <div class="media align-items-center">
          <div class="media-body">
            <h5 class="mb-0"><?php echo $unpaid;?></h5>
            <a href="<?php echo base_url('Admin/Dashboard/allusers/2');?>">Unpaid Users</a>
            <!-- <p class="mb-0">Unpaid Users</p> -->
          </div>
          <div class="w-icon"><i class="zmdi zmdi-balance-wallet text-white"></i></div>
          </div>
          <div class="progress-wrapper mt-3">
              <div class="progress mb-0" style="height: 5px;">
              <div class="progress-bar" role="progressbar" style="width: 65%"></div>
            </div>
         </div>
        </div>
        </div>
     </div>
     <div class="col-12 col-md-6 col-lg-3 col-xl-3">
         <div class="card">
           <div class="card-body">
             <div class="media align-items-center">
              <div class="media-body">
                <h5 class="mb-0"><?php echo $block?></h5>
                <a href="<?php echo base_url('Admin/Dashboard/allusers/3');?>">Block Users</a>
            <!-- <p class="mb-0">Block Users</p> -->
             </div>
             <div class="w-icon"><i class="zmdi zmdi-male-female text-white"></i></div>
           </div>
           <div class="progress-wrapper mt-3">
              <div class="progress mb-0" style="height: 5px;">
              <div class="progress-bar" role="progressbar" style="width: 75%"></div>
            </div>
            </div>
           </div>
         </div>
     </div>
     <?php 
      $data = incomes();
        foreach ($data as $key => $value) {
          echo '<div class="col-12 col-md-6 col-lg-3 col-xl-3">
             <div class="card">
            <div class="card-body">
              <div class="media align-items-center">
              <div class="media-body">
                <h5 class="mb-0">'.currency.$value['total_amount'].'</h5>
                <a href="#">'.ucfirst(str_replace('_', ' ', $value['type'])).'</a>
                <!-- <p class="mb-0">Unpaid Users</p> -->
              </div>
              <div class="w-icon"><i class="zmdi zmdi-balance-wallet text-white"></i></div>
              </div>
              <div class="progress-wrapper mt-3">
                  <div class="progress mb-0" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 65%"></div>
                </div>
             </div>
            </div>
            </div>
         </div>';
        }
     ?>
     <div class="col-12 col-md-6 col-lg-3 col-xl-3">
         <div class="card">
           <div class="card-body">
             <div class="media align-items-center">
              <div class="media-body">
                <h5 class="mb-0"><?php echo $total_provide_help['amount'];?></h5>
                <a href="<?php echo base_url('Admin/Dashboard/index');?>">Total Provide Help Amount</a>
            <!-- <p class="mb-0">Block Users</p> -->
             </div>
             <div class="w-icon"><i class="zmdi zmdi-male-female text-white"></i></div>
           </div>
           <div class="progress-wrapper mt-3">
              <div class="progress mb-0" style="height: 5px;">
              <div class="progress-bar" role="progressbar" style="width: 75%"></div>
            </div>
            </div>
           </div>
         </div>
     </div>
     <div class="col-12 col-md-6 col-lg-3 col-xl-3">
         <div class="card">
           <div class="card-body">
             <div class="media align-items-center">
              <div class="media-body">
                <h5 class="mb-0"><?php echo $total_get_help['amount'];?></h5>
                <a href="<?php echo base_url('Admin/Dashboard/index');?>">Total Get Help Amount</a>
            <!-- <p class="mb-0">Block Users</p> -->
             </div>
             <div class="w-icon"><i class="zmdi zmdi-male-female text-white"></i></div>
           </div>
           <div class="progress-wrapper mt-3">
              <div class="progress mb-0" style="height: 5px;">
              <div class="progress-bar" role="progressbar" style="width: 75%"></div>
            </div>
            </div>
           </div>
         </div>
     </div>
   </div>
 </div>
</div>
    <!--end row-->
      
       <!--start overlay-->
              <div class="overlay"></div>

            <!--end overlay-->
      <!-- End container-fluid-->

   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
    
	
<?php
	require_once 'footer.php';

?>