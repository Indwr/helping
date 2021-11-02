
<?php
  require_once 'header.php';

?>

<style>

.card-msg {
    color: #ffffff;
    background-color: #0e5d76;
    border-color: #f5365c;
    display: table-cell;
    padding: 15px 15px 15px 15px;
    font-size: 20px;
    display: inline-block;
    text-align: center;
    width: 100%;
    margin: auto;
    margin-bottom: 20px;
}
.alert .alert-message {
}
.alert .contrast-alert {
    background-color: rgba(255, 255, 255, 0.2);
}

</style>
<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">
      <!--Start Dashboard Content-->
      <div class="row mt-3">
        <div class="col-12 col-lg-6 col-xl-3 col-sm-6">
          <div class="card bg-pattern-primary">
            <div class="card-body">
              <div class="media align-items-center">
              <div class="media-body text-left">
                <h4 class="text-white mb-0"><?php echo $user_info['user_id'];?></h4>
                <span class="text-white">User Id</span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-basket-loaded text-white"></i></div>
             </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3 col-sm-6">
          <div class="card bg-pattern-danger">
            <div class="card-body">
              <div class="media align-items-center">
               <div class="media-body text-left">
                <h4 class="text-white mb-0"><?php echo $user_info['name'];?></h4>
                <span class="text-white">User Name</span>
              </div>
               <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-wallet text-white"></i></div>
            </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3 col-sm-6">
          <div class="card bg-pattern-success">
            <div class="card-body">
              <div class="media align-items-center">
              <div class="media-body text-left">
                <h4 class="text-white mb-0"><?php echo $total;?></h4>
                <span class="text-white">Total Users</span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-pie-chart text-white"></i></div>
            </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3 col-sm-6">
          <div class="card bg-pattern-warning">
            <div class="card-body">
              <div class="media align-items-center">
              <div class="media-body text-left">
                <h6 class="text-white mb-0">Total Directs: (<?php echo $user_info['total_directs'];?>)</h6>
                <h6 class="text-white mb-0">Paid: (<?php echo $user_info['directs'];?>)</h6>
                <h6 class="text-white mb-0">Unpaid: (<?php echo abs($user_info['total_directs']-$user_info['directs']);?>)</h6>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-user text-white"></i></div>
            </div>
            </div>
          </div>
        </div>
    <?php
         $data = incomes();
         foreach ($data as $key => $value) {
      echo '<div class="col-12 col-lg-6 col-xl-3 col-sm-6">
             <div class="card bg-pattern-success">
               <div class="card-body">
                 <div class="media align-items-center">
                 <div class="media-body text-left">
                   <h4 class="text-white mb-0">'.currency.$value['amount'].'</h4>
                   <span class="text-white">'.ucfirst(str_replace('_', ' ', $value['type'])).'</span>
                 </div>
                 <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                   <i class="icon-pie-chart text-white"></i></div>
               </div>
               </div>
             </div>
           </div>';

        }
      ?> 
       <div class="col-12 col-lg-6 col-xl-3 col-sm-6">
          <div class="card bg-pattern-success">
            <div class="card-body">
              <div class="media align-items-center">
              <div class="media-body text-left">
                <h4 class="text-white mb-0"></h4>
                <span class="text-white">Users</span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-pie-chart text-white"></i></div>
            </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-3 col-sm-6 d-none">
          <div class="card bg-pattern-success">
            <div class="card-body">
              <div class="media align-items-center">
              <div class="media-body text-left">
                <h4 class="text-white mb-0"></h4>
                <span class="text-white">Users</span>
              </div>
              <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                <i class="icon-pie-chart text-white"></i></div>
            </div>
            </div>
          </div>
        </div>
               <?php 
                  if($this->session->flashdata('message')){
                ?>
                    <div class="col-md-12">
                      <div class="card-msg">
                         <?php echo $this->session->flashdata('message');?>
                      </div>
                    </div>
              <?php
                 }
                ?>
      <?php 
        foreach ($helper as $key => $value) {

             echo '<div class="col-md-12">
                      <div class="card bg-pattern-'.($value['sender_id'] == $this->session->userdata['user_id'] ? 'danger' : 'success').' text-center">';
                          if($value['status'] == 0){
                      echo '<h4 class="text-white mb-0">'.($value['sender_id'] == $this->session->userdata('user_id') ? 'Provide Help' : 'Receiver Help').'</h4>
                            
                       <div class="row">
                         <div class="col-md-6">
                                <h5 class="text-white mb-0">Receiver Details</h5>
                                <div class="badge badge-primary">User ID: '.$value['receiver_id'].'</div><br>
                                <div class="badge badge-primary">Name: '.$value['receiver_details']['name'].'</div><br>
                                <div class="badge badge-primary">Phone No.: '.$value['receiver_details']['phone'].'</div><br>
                              </div>
                        <div class="col-md-6">
                          <h5 class="text-white mb-0">Provider Details</h5>
                            <div class="badge badge-primary">User ID: '.$value['sender_id'].'</div><br>
                            <div class="badge badge-primary">Name: '.$value['sender_details']['name'].'</div><br>
                            <div class="badge badge-primary">Phone No.: '.$value['sender_details']['phone'].'</div><br>
                          </div>
                          </div>
                          <br>
                          <div class="col-md-12">
                          
                          '.($value['receiver_id'] == $this->session->userdata('user_id') ? '<a href="'.base_url('Users/Help_result/receive_proof/'.$value['id']).'" class="btn btn-info">Receive Proof</a> <br><br><a href="'.base_url('Users/Help_result/help_result/'.$value['id'].'/1/'.$value['status']).'" class="btn btn btn-success">Approve</a> <a href="'.base_url('Users/Help_result/help_result/'.$value['id'].'/3/'.$value['status']).'" class="btn btn btn-danger">Reject</a>' : '<a href="'.base_url('Users/Help_result/sendProof_form/'.$value['id']).'">Click here to pay Rs. '.$value['amount'].'/-').'</a>
                          <br> <br>
                          </div>

                          <div class="badge badge-info font-weight-bold"> Your '.($value['sender_id'] == $this->session->userdata('user_id') ? 'Provide Help' : 'Receiver Help').' Amount is Rs. '.$value['amount'].'/- </div>';
                      }   
                    echo'</div>
                      </div>';
          // }
        }

        ?>
        
        </div>
      </div><!--End Row-->
 
         </div>
      </div><!--End Row-->

      <!--End Dashboard Content-->

     <!--start overlay-->
    <div class="overlay toggle-menu"></div>
  <!--end overlay-->
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  
<?php
  require_once 'footer.php';

?>