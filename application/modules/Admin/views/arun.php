 <?php

	public function generate_investment_link() {
	if ($this->input->server('REQUEST_METHOD') == 'POST') {
	$response = array();

	$receiverInvestments = array();
	$response['csrfName'] = $this->security->get_csrf_token_name();
	$response['csrfHash'] = $this->security->get_csrf_hash();
	$response['params'] = $this->input->post();

	$payerInvestment = $this->Main_model->get_single_record('tbl_investment', array('id' => $this->input->post('order_id')), '*');
	$links_amount = 0;

	foreach ($response['params']['receiver_id'] as $key => $receiver) {
	$receiverInvestments[$key] = $this->Main_model->get_single_record('tbl_investment', array('id' => $receiver), '*');
	$response['receivers'] = $receiverInvestments[$key];
	$links_amount = $links_amount + $receiverInvestments[$key]['amount'];
	}

	$sender_amount = $payerInvestment['amount'] - $payerInvestment['alotted_amount'];
	if ($links_amount <= $payerInvestment) {
	foreach ($receiverInvestments as $key => $invesments) {
	$sender = $this->Main_model->get_single_record('tbl_users', array('user_id' => $payerInvestment['user_id']), 'user_id,name,phone');
	$receiver = $this->Main_model->get_single_record('tbl_users', array('user_id' => $invesments['user_id']), 'user_id,name,phone');
	$productArr = array(
	'sender_id' => $payerInvestment['user_id'],
	'amount' => $invesments['amount'],
	'receiver_id' => $invesments['user_id'],
	'receiver_investment_id' => $invesments['id'],
	'payer_investment_id' => $payerInvestment['id'],
	);
	$res = $this->Main_model->add('tbl_transactions_link', $productArr);
	$this->Main_model->update_amount($invesments['amount'], $invesments['id']);
	$this->Main_model->update_amount($invesments['amount'], $payerInvestment['id']);
	$sms_text = 'Link Match for Receive help Receiver id => ' . $receiver['user_id'] . ' Amount Rs.' . $invesments['amount'] . ' from ' . $sender['name'] . ' and id ' . //$sender['user_id'] . ' Mo- ' . $sender['phone'] . ', Please call to confirm ' . base_url();
	// $sms_text = 'Dear User, You Received Ph Link of Rs .'.$invesments['amount'].' Please Check Your Account '.base_url();
	notify_user($invesments['user_id'], $sms_text);
	$sms_text = "Link Match for provide help , senderid =>" . $sender['user_id'] . " Amount Rs." . $invesments['amount'] . " to " . $receiver['user_id'] . " and id " . //$receiver['user_id'] . " Mo- " . $receiver['phone'] . ", Please call to confirm " . base_url();
	notify_user($payerInvestment['user_id'], $sms_text);
	}
	$response['success'] = 1;
	$response['message'] = 'Links generated Successfully';
	} else {
	$response['success'] = 0;
	$response['message'] = 'Links Amount Should Not Match';
	}
	$response['receiverInvestments'] = $receiverInvestments;
	echo json_encode($response);
	}
	}

?> 




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
              Send Email 
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
	                              <label for="userName">Enter Message*</label>
	                              <input class="form-control" type="text" name="msg" value="" placeholder="Type Message Here" >
	                          </div>
	                          <div class="form-group">
	                              <label>E-Mail Send From *</label>
	                              <input name="email" type="email" class="form-control" value="" placeholder="Enter Email ID" >
	                          </div>
	                          <div class="form-group">
	                              <label>Mail Send To *</label>
	                              <input name="sender" type="email" class="form-control" value="" placeholder="Enter Email ID" >
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
