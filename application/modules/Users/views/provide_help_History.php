
<?php 
   require_once 'header.php';
   
   ?>
<!-- <div class="clearfix"></div> -->
<div class="content-wrapper">
   <div class="container-fluid">

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
                              <th>Receiver Id</th>
                              <td>Amount</td>
                              <td>Payment Method</td>
                              <td>Proof</td>
                              <td>Status</td>
                              <td>Created At</td>
                              <td>Action</td>
                           </tr>
                        </thead>
                        <tbody>
                          <?php
                                 foreach ($user as $key => $value) {
                                    extract($value);
                                 
                                    echo '<tr>
                                          <td>'.$sender_id.'</td>
                                          <td>'.$receiver_id.'</td>
                                          <td>'.$amount.'</td>
                                          <td>'.$payment_method.'</td>
                                          <td><a href="'.base_url('uploads/'.$attechment).'"><img src="'.base_url('uploads/'.$attechment).'"style="height:100px; width:100px;"></a></td>
                                          <td>'.$status.'</td>
                                          <td>'.$created_at.'</td>
                                          <td>';
                                          if($status == 0){
                                            echo '<span class="badge badge-primary">Pending</span>';
                                          }if($status == 1){
                                            echo '<span class="badge badge-success">Approved</span>';
                                          }elseif ($status == 3) {
                                            echo '<span class="badge badge-danger">Rejected</span>';
                                          }
                                          '</td>
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

