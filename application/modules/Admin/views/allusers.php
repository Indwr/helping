
<?php 
   require_once 'header.php';
  ?>
<style>
  
#request {
    width: 98%;
    padding: 5px 0px;
    font-size: 18px;
}
#request option {
    color: #fff;
}

  .alert-danger {
    color: #ffffff;
    background-color: #0e5d76;
    border-color: #f5365c;
}
.alert .alert-message {
    display: table-cell;
    padding: 20px 15px 20px 15px;
    font-size: 20px;
    display: inline-block;
    text-align: center;
    width: 100%;
    margin: auto;
}
.alert .contrast-alert {
    background-color: rgba(255, 255, 255, 0.2);
}

</style>
<div class="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
         <div class="col-sm-9">
            <h6 class="page-title"><?php echo $searcher;?></h6>
            <!-- <ol class="breadcrumb">
               <li class="breadcrumb-item active" aria-current="page">Epin Table</li>
            </ol> -->
         </div>
      </div>
      <!-- End Breadcrumb-->
      <div class="s-btn">
          <form action="" method="get">
              <div class="input-group col-md-4">
                      <select name="type">
                        <option value="user_id" style="color: white;">User id</option>
                        <option value="sponser_id" style="color: white;">Sponser id</option>
                      </select>
            <input class="form-control form-control-navbar" name="value" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                 <button class="btn btn-navbar" type="submit" style="color: white;">Search</button>
                 </div>
              </div>
        </form>
     </div></br>
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header"><h4><?php echo $header;?></h4></div>

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
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="default-datatable" class="table table-bordered">
                        <thead>
                           <tr>
                              <th>Id</th>
                              <th>User id</th>
                              <th>Password</th>
                              <th>Name</th>
                              <th>Sponser id</th>
                              <th>Phone</th>
                              <th>E-mail</th>
                              <th>Master Key</th>
                              <th>Paid Stastus</th>
                              <th>Created at</th>
                              <th>Action</th>
                              <th>Activation</th>
                           </tr>
                        </thead>
                        <tbody>
                          <?php
                                $i = $segment +1;
                            foreach ($user as $key => $value) {
                             extract($value);
                           
                                  echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$user_id.'</td>
                                    <td>'.$password.'</td>
                                    <td>'.$name.'</td>
                                    <td>'.$sponser_id.'</td>
                                    <td>'.$phone.'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$master_key.'</td>';
                                    if($paid_status == 1){

                                   echo '<td><label class="badge btn-success">Activate</label></td>';
                                    }else{

                                    echo '<td><label class="badge btn-danger">Deactivate</label></td>';
                                    }
                                   echo '<td>'.$created_at.'</td>

                       <td><a href="'.base_url('Admin/Dashboard/user_login/'.$user_id.'').'" class="btn btn-primary" target="_blank">Login</a>| 
                       <a href="'.base_url('Admin/Dashboard/edit_user/'.$user_id.'').'" class="btn btn-info">Edit</a>|';
                         if($disabled == 0){
                       echo '<a href="'.base_url('Admin/Dashboard/block_user/'.$user_id.'/3/'.$status).'" class="btn btn-danger">Block</a>';

                         }else{
                           echo '<a href="'.base_url('Admin/Dashboard/block_user/'.$user_id.'/0/'.$status).'" class="btn btn-success">Unblock</a>';
                           }
                        '</td>';

                           if($paid_status == 0){
                       echo '<td><a href="'.base_url('Admin/Activation/activation/'.$user_id.'/0').'" class="btn btn-success">Active</a></td>';

                         }else{
                           echo '<td><a href="'.base_url('Admin/Activation/activation/'.$user_id).'" class="btn btn-warning">Paid User</a></td>';
                           }
                              
                              echo '</tr>';
                               $i++;

                                }
                              ?>
                        </tbody>
                     </table>
                           <span>
                             
                              <?php echo $this->pagination->create_links();?>
                           </span>

                      <span class="">
                      <input style="margin:8px;" type="number" onchange="loadDoc()" id="row" min="1"   max="<?php echo ceil($total_rows/10); ?>"> of <?php echo ceil($total_rows/10); ?>
                      </span>

                  </div>
               </div>
            </div>
         </div>
      </div>
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
</div>
<script>
    function loadDoc() {
    var url = "<?php echo base_url('Admin/Dashboard/allusers/'.$status);?>";
    var id = document.getElementById("row").value;
    var newid = id*10;
    var newurl = url+'/'+newid;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("row").value = id;
    window.location.href=newurl;

    }

    };
    xhttp.open("GET", url, true);
    xhttp.send();
    }
</script>
<?php 
   require_once 'footer.php'
   ;?>

