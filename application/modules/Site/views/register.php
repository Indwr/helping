<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/rocker/demo/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 03 Jan 2021 09:42:39 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?php echo title;?> | Register </title>
  <!--favicon-->
  <link rel="icon" href="<?php echo base_url(logo);?>" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url('Assets/Dashboard/');?>css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?php echo base_url('Assets/Dashboard/');?>css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo base_url('Assets/Dashboard/');?>css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="<?php echo base_url('Assets/Dashboard/');?>css/app-style.css" rel="stylesheet"/>
  
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

<body>
 <!-- Start wrapper-->
 <div id="wrapper">
    <div class="height-100v d-flex align-items-center justify-content-center">
	<div class="card border-primary border-top-sm border-bottom-sm card-authentication1 mx-auto my-5 animated bounceInDown">
		<div class="card-body" style="background:#e1e1fb">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="<?php echo base_url(logo);?>" style="width: 68%;">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Register Now</div>
		    <!-- <form> -->

		    	<?php echo form_open('','id="myform"'); ?>
		    	<div class="form-group">
			   <div class="position-relative has-icon-right">
				  <!-- <label for="exampleInputUsername" class="sr-only">Sponser Id</label> -->
				  <input type="text" id="sponser_id" class="form-control form-control-rounded" name="sponser_id" placeholder="Enter Sponser Id" onblur="check_user();">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <!-- /<label for="exampleInputUsername" class="sr-only">Sponser Name</label> -->
				  <input type="text" id="sponser_name" class="form-control form-control-rounded" name="sponsername" readonly="" placeholder="Sponser Name">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <!-- <label for="exampleInputUsername" class="sr-only">Username</label> -->
				  <input type="text" id="exampleInputUsername" class="form-control form-control-rounded" name="username" placeholder="Username">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <!-- <label for="exampleInputPassword" class="sr-only">E-Mail</label> -->
				  <input type="email" id="exampleInputPassword" class="form-control form-control-rounded" name="email" placeholder="Enter Email">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <!-- <label for="exampleInputPassword" class="sr-only">Phone NO.</label> -->
				  <input type="number" id="exampleInputPassword" class="form-control form-control-rounded" name="phone" placeholder="Enter Phone No.">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <!-- <label for="exampleInputUsername" class="sr-only">Epin</label> -->
				  <input type="text" id="c_epin" class="form-control form-control-rounded" name="epin" onblur="check_epin();" placeholder="Enter Epin">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <!-- /<label for="exampleInputUsername" class="sr-only">Sponser Name</label> -->
				  <input type="text" id="check_epn" class="form-control form-control-rounded" name="epincheck" readonly="" placeholder="Enter Epin">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			<div class="form-row mr-0 ml-0">
			 <div class="form-group col-6">
			   <div class="icheck-primary">
                <input type="checkbox" id="user-checkbox" checked="" />
                <label for="user-checkbox">Remember me</label>
			  </div>
			 </div>
			 <!-- <div class="form-group col-6 text-right">
			  <a href="authentication-reset-password.html">Reset Password</a>
			 </div> -->
			</div>
			 <button type="submit" class="btn btn-primary shadow-primary btn-round btn-block waves-effect waves-light">Register</button>

			  <br><br>
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
				<hr>
				<p class="text-muted mb-0">Do you have an account? <a href="<?php echo base_url('Users/Dashboard/login');?>"> Login</a></p>
			  </div> 
			 </form>
		   </div>
		  </div>
	     </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('Assets/Dashboard/');?>js/jquery.min.js"></script>
  <script src="<?php echo base_url('Assets/Dashboard/');?>js/popper.min.js"></script>
  <script src="<?php echo base_url('Assets/Dashboard/');?>js/bootstrap.min.js"></script>
  
</body>
<script>

        $(document).on('blur', '#sponser_id', function () {
        check_sponser();
        })
        function check_sponser() {
        var user_id = $('#sponser_id').val();
        if (user_id != '') {
        var url = '<?php echo base_url("Users/Dashboard/sponser_name/") ?>' + user_id;
        $.get(url, function (res) {
        $('#sponser_name').val(res);
        })
        }
        }
        check_sponser();
        $(document).on('submit', '#myform', function () {
        if (confirm('Please Check All The Fields Before Submit')) {
        yourformelement.submit();
        } else {
        return false;
        }
        })

 </script>
 <script>

        $(document).on('blur', '#c_epin', function () {
        check_epin();
        })
        function check_epin() {
        var user_id = $('#c_epin').val();
        if (user_id != '') {
        var url = '<?php echo base_url("Users/Dashboard/check_epin/") ?>' + user_id;
        $.get(url, function (res) {
        $('#check_epn').val(res);
        })
        }
        }
        check_sponser();
        $(document).on('submit', '#myform', function () {
        if (confirm('Please Check All The Fields Before Submit')) {
        yourformelement.submit();
        } else {
        return false;
        }
        })

 </script>

<!-- Mirrored from codervent.com/rocker/demo/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 03 Jan 2021 09:42:39 GMT -->
</html>
