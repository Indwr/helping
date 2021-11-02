
<?php 
   require_once 'header.php';
   
   ?>
<!-- <div class="clearfix"></div> -->
<div class="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumb-->
     <!--  <div class="row pt-2 pb-2">
         <div class="col-sm-9">
            <h4 class="page-title">Epin Table</h4> -->
            <!-- <ol class="breadcrumb">
               <li class="breadcrumb-item active" aria-current="page">Epin Table</li>
            </ol> -->
        <!--  </div>
      </div> -->
      <!-- End Breadcrumb-->
      <!-- <div class="s-btn">
        <form  action="" method="get">
              <div class="input-group col-md-4">
                      <select name="type">
                        <option value="user_id" style="color: white;">User id</option>
                      </select>
          <input class="form-control form-control-navbar" name="value" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                 <button class="btn btn-navbar" type="submit" style="color: white;">Search</button>
                 </div>
              </div>
        </form>
     </div></br> -->
     
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header"><h3><?php echo $header;?>(<?php echo 'Rs='.$total['total'];?>)</h3></div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="default-datatable" class="table table-bordered">
                        <thead>
                           <tr>
                              <th>Sender Id</th>
                              <td>Amount</td>
                              <td>Payment Method</td>
                              <td>Proof</td>
                              <td>Status</td>
                              <td>Created At</td>
                           </tr>
                        </thead>
                        <tbody>
                          <?php
                           foreach ($Users as $key => $value) {
                              extract($value);
                           
                              echo '<tr>
                                    <td>'.$sender_id.'</td>
                                    <td>'.$amount.'</td>
                                    <td>'.$payment_method.'</td>
                                    <td><a href="'.base_url('uploads/'.$attechment).'"><img src="'.base_url('uploads/'.$attechment).'"style="height:100px; width:100px;"></a></td>
                                    <td>'.$status.'</td>
                                    <td>'.$created_at.'</td>
                                    </tr>';
                                  }
                             ?> 
                        </tbody>

                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- End Row-->
      <!-- End Row-->
      <!--start overlay-->
      <div class="overlay"></div>
      <!--end overlay-->
   </div>
   <!-- End container-fluid-->
</div>
<!--End content-wrapper-->
<!--Start Back To Top Button-->
<a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
</div>
<?php 
   require_once 'footer.php';

   ?>

