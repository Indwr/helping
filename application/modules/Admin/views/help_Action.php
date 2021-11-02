
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
<!-- <div class="clearfix"></div> -->
<div class="content-wrapper">
   <div class="container-fluid">
     <div class="row">
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

         <div class="col-lg-12">
            <div class="card">
               <div class="card-header"><h3><?php echo $first;?></h3></div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="default-datatable" class="table table-bordered">
                        <thead>
                           <tr>
                              <!-- <th>Id</th> -->
                              <th>Id</th>
                              <th>User Id</th>
                              <th>Bank Name</th>
                              <th>Account Number</th>
                              <th>Account Holder Name</th>
                              <th>IFSE </th>
                              <th>Created At</th>
                              
                        </tr>
                        </thead>
                        <tbody>
                         <?php
                               
                             foreach ($data as $key => $value) {
                              // print_r($value);
                              // die('okk');
                              extract($value);
                           
                            echo '<tr>
                                    <td>'.($id).'</td>
                                    <td>'.$user_id.'</td>
                                    <td>'.$bank_name.'</td>
                                    <td>'.$bank_account_number.'</td>
                                    <td>'.$account_holder_name.'</td>
                                    <td>'.$ifsc_code.'</td>
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


<!-- <div class="content-wrapper">
   <div class="container-fluid"> -->
     <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header"><h3><?php echo $second;?></h3></div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="default-datatable" class="table table-bordered">
                        <thead>
                           <tr>
                              <th>Id</th>
                              <th>Sender Id</th>
                              <th>Receiver Id</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Created At</th>
                           </tr>
                        </thead>
                        <tbody>
                          <?php
                            
                             foreach ($data1 as $key => $value) {
                              extract($value);
                           
                            echo '<tr>
                                    
                                    <td>'.($key +1).'</td>
                                    <td>'.$sender_id.'</td>
                                    <td>'.$receiver_id.'</td>
                                    <td>'.$amount.'</td>
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

     
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header"><h3><?php echo $third;?></h3></div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="default-datatable" class="table table-bordered">
                        <thead>
                           <tr>
                              <th>Select</th>
                              <th>Id</th>
                              <th>User Id</th>
                              <th>Amount</th>
                              <th>Type</th>
                              <th>Mode</th>
                              <th>Status</th>
                              <th>Created At</th>
                           </tr>
                        </thead>
                        <tbody>
                       
                        <?php
                              
                             foreach ($user as $key => $value) {
                              extract($value);
                           
                            echo '<tr>
                                    <td>'.form_open('').'
                                    <input type="hidden" name="amount[]" value="'.$amount.'">
                                    <input name="id[]" value="'.$id.'" type="checkbox">
                                     '.'</td>
                                    <td>'.($key +1).'</td>
                                    <td>'.$user_id.'</td>
                                    <td>'.$amount.'</td>
                                    <td>'.str_replace('_', ' ', $type) .'</td>
                                    <td>'.$mode.'</td>
                                    <td>'.$status.'</td>
                                    <td>'.$created_at.'</td>
                                  
                               </tr>';
                               // $i++;

                            }
                        ?>
                        </tbody>
                              <!-- <?php //echo $this->pagination->create_links();?> -->

                     </table><br>
                     <button type="submit" class="btn btn-info">Create Link</button> 
                     </form>
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
   require_once 'footer.php'
   ;?>

