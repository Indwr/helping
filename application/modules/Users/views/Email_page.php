
<!DOCTYPE html>
<html>
<head>
<style >
	.body{

		background-color: #6fb2bd;
		color:#fff; 
 		text-align: center;
	}
	.logo-icon {
    width: 11%;
    margin-top: 7px;
}

</style>
</head>
<body class="body">
<div class="container">
	  <div class="brand-logo">
       <!-- <a href="">
        <img src="<?php //echo base_url(logo);?>" class="logo-icon" alt="logo icon">
      </a> -->
       <a href="">
      <img src="<?php echo base_url('uploads/Arun2.jpg');?>" class="logo-icon" alt="logo icon">
  </a>
   </div>
	 <?php
	if(!empty($msg)){
	echo $msg;
	}
    	
	?> 
<!-- </h1> -->
</body>
</html>



