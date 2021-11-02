
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
               <div class="card-header"><h3><?php echo $header;?></h3></div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="default-datatable" class="table table-bordered">
                        <thead>
                           <tr>
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
                                // $i = $segment +1;
                            foreach ($user as $key => $value) {
                              extract($value);
                           
                            echo '<tr>
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

                              <a href="<?php echo base_url('Admin/Provide_help/get_helper_form');?>" class="btn btn-info">Get Help</a>

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

