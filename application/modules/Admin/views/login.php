<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/dashtreme/demo/transparent-admin/vertical-layout/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Dec 2020 08:38:53 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?php echo title;?> | Login</title>
  <!-- loader-->
  <!-- <link href="<?php //echo base_url('Assets/Admin/');?>css/pace.min.css" rel="stylesheet"/>
  <script src="<?php //echo base_url('Assets/Admin/');?>js/pace.min.js"></script> -->
  <!--favicon-->
  <link rel="icon" href="<?php echo base_url(logo);?>" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url('Assets/Admin/');?>css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?php echo base_url('Assets/Admin/');?>css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo base_url('Assets/Admin/');?>css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="<?php echo base_url('Assets/Admin/');?>css/app-style.css" rel="stylesheet"/>
  
</head>
<style>
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

<body class="bg-theme bg-theme1">


<!-- Start wrapper-->
 <div id="wrapper">

 <div class="height-100v d-flex align-items-center justify-content-center">
 
	<div class="card card-authentication1 mb-0">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="<?php echo base_url(logo);?>" alt="logo icon" style="width: 70%;">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Sign In</div>
		    <!-- <form action="<?php //echo base_url('Admin/Dashboard/index');?>" method="post"> -->
            

		    	<?php echo form_open(''); ?>
			  <div class="form-group">
			  <label for="exampleInputUsername" class="sr-only">Username</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="exampleInputUsername" class="form-control input-shadow" name="admin_id" placeholder="Enter Username" value="admin">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			  <label for="exampleInputPassword" class="sr-only">Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="exampleInputPassword" class="form-control input-shadow" name="pass" placeholder="Enter Password" value="mlm_company">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			<div class="form-row">
			 <div class="form-group col-6">
			   <div class="icheck-material-white">
                <input type="checkbox" id="user-checkbox" checked="" />
                <label for="user-checkbox">Remember me</label>
			  </div>
			 </div>
			 <!-- <div class="form-group col-6 text-right">
			  <a href="authentication-reset-password.html">Reset Password</a>
			 </div> -->
			</div>
			 <button type="submit" class="btn btn-light btn-block">Sign In</button>

       <br>
       <?php 
       if($this->session->flashdata('message')){
        ?>
			   <div class="alert alert-danger alert-dismissable" role="alert">
           <div class="alert-icon contrast-alert"><i class="fa fa-times"></i></div>
           <div class="alert-message">

           <span>
              <?php echo $this->session->flashdata('message'); ?>
           </span>
           </div>
         </div>
         <?php
       }
       ?>
			 </form>
		   </div>
		  </div>
		  <div class="card-footer text-center py-3">
		    <p class="text-warning mb-0"><a href="<?php echo base_url();?>">Go to Home</a></p>
		  </div>
	     </div>
	   </div>
    
     <!--Start Back To Top Button-->
    <a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('Assets/Admin/');?>js/jquery.min.js"></script>
  <script src="<?php echo base_url('Assets/Admin/');?>js/popper.min.js"></script>
  <script src="<?php echo base_url('Assets/Admin/');?>js/bootstrap.min.js"></script>
	
  <!-- Metismenu js -->
  <script src="<?php echo base_url('Assets/Admin/');?>plugins/metismenu/js/metisMenu.min.js"></script>
  
  <!-- Custom scripts -->
  <script src="<?php echo base_url('Assets/Admin/');?>js/app-script.js"></script>
  
</body>

<!-- Mirrored from codervent.com/dashtreme/demo/transparent-admin/vertical-layout/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Dec 2020 08:38:53 GMT -->
</html>
