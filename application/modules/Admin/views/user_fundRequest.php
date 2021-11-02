
<?php 
require_once 'header.php';

?>

<!-- <div class="clearfix"></div> -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <!-- <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">User Fund Request</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Dashtreme</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Request</li>
         </ol>
     </div>

     </div> -->
    <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><h4><?php echo $header;?></h4></div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <?php $this->session->flashdata('message'); ?>
                <thead>
                    <tr>
                      <th>User Id</th>
                      <th>Method</th>
                      <th>Amount</th>
                      <th>Transation Id</th>
                      <th>Image</th>
                      <th>Remark</th>
                      <th>Created at</th>
                      <th>Action</th>
                     </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($user as $key => $value) {
                      extract($value);

                echo '<tr>
                      <th>'.$user_id.'</th>
                      <th>'.$payment_method.'</th>
                      <th>'.$amount.'</th>
                      <th>'.$transation_id.'</th>
                      <th><a href="'.base_url('uploads/'.$image).'"><img src="'.base_url('uploads/'.$image).'"style="height:100px; width:100px;"></a></th>
                      <th>'.str_replace('_', ' ',$remarks).'</th>
                      <th>'.$created_at.'</th>';

              if($status == 0){
               echo'<th> <a href="'.base_url('Admin/Userfund_Request_Management/fund_management/1/'.$user_id.'/'.$id).'" class="btn btn-block btn-success"><p>Approve</p>
              </a><a href="'.base_url('Admin/Userfund_Request_Management/fund_management/2/'.$user_id.'/'.$id).'" class="btn btn-block btn-danger"><p>Reject</p></a></th>';
              }

              if($status == 1){
                echo'<th><a href="" class="btn btn-block btn-success"><h2><i class="fa fa-check" aria-hidden="true"></h2></a>';
              }

              if($status == 2){
                echo'<th><a href="" class="btn btn-block btn-danger"><h2><i class="fa fa-times" aria-hidden="true"></i>
                     </h2></a>';
              }

               echo '</tr>';
                 }
              ?>
                </tbody>
               
            </table>
            </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->


      <!-- End Row-->
<!--start overlay-->
    <div class="overlay"></div>
  <!--end overlay-->
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
 
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->


<?php 
require_once 'footer.php'
;?>