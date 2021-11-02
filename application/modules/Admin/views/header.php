<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/dashtreme/demo/transparent-admin/vertical-layout/dashboard-healthcare.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Dec 2020 08:38:23 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?php echo title;?></title>
  <!-- loader-->
  <!-- <link href="<?php //echo base_url('Assets/Admin/');?>css/pace.min.css" rel="stylesheet"/>
  <script src="<?php //echo base_url('Assets/Admin/');?>js/pace.min.js"></script> -->
  <!--favicon-->
  <link rel="icon" href="<?php echo base_url(logo);?>" type="image/x-icon">
  <!-- simplebar CSS-->
  <!-- <link href="<?php //echo base_url('Assets/Admin/');?>plugins/simplebar/css/simplebar.css" rel="stylesheet"/> -->
  <!-- Apex chart CSS-->
  <link href="<?php echo base_url('Assets/Admin/');?>plugins/apexcharts/apexcharts.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url('Assets/Admin/');?>css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?php echo base_url('Assets/Admin/');?>css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo base_url('Assets/Admin/');?>css/icons.css" rel="stylesheet" type="text/css"/> 
   <!-- Sidebar CSS-->
  <link href="<?php echo base_url('Assets/Admin/');?>css/sidebar-menu.css" rel="stylesheet" type="text/css"/>
  <!-- Metismenu CSS-->
  <link href="<?php echo base_url('Assets/Admin/');?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="<?php echo base_url('Assets/Admin/');?>css/app-style.css" rel="stylesheet"/>
 <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-replace-svg="nest"></script>

 <style>
 a#dropdownMenuLink {
    background: transparent;
       box-shadow: none;
}
a.btn.btn-secondary {
    background: transparent;
    box-shadow: none;
}
.dropdown-toggle::after {
    position: absolute;
    right: 8px;
}
.dropdown-menu.w-100.show li i {
    margin-right: 13px;
}
 </style>
</head>

<body class="bg-theme bg-theme1">

 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
    <img src="<?php echo base_url(logo);?>" class="logo-icon" alt="logo icon" style="width: 60%;">
    
    <div class="close-btn"><i class="zmdi zmdi-close"></i></div>
   </div>
   <ul class="metismenu" id="menu">
     
<div class="dropdown">
    <a class="btn btn-secondary" href="<?php echo base_url('Admin'); ?>"><span>Dashboard</span></a>

</div>
      
   <div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Users</a>

  <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
        <li><a href="<?php echo base_url('Admin/Dashboard/allusers/0');?>"><i class="fas fa-users"></i>All Users</a></li>
        <li><a href="<?php echo base_url('Admin/Dashboard/allusers/1');?>"><i class="fas fa-users"></i>Paid Users</a></li>
        <li><a href="<?php echo base_url('Admin/Dashboard/allusers/2');?>"><i class="zmdi zmdi-dot-circle-alt"></i>Unpaid Users</a></li>
        <li><a href="<?php echo base_url('Admin/Dashboard/allusers/3');?>"><i class="fa fa-ban" aria-hidden="true"></i>Block Users</a></li>
        <!-- <li><a href="<?php echo base_url('Admin/Incomes/scriptData');?>"><i class="fa fa-ban" aria-hidden="true"></i>Script Data</a></li>  -->
  </div>
</div>
    
   <div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Incomes Report</span></a>

  <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
          <?php
           $income = incomeType();
           $incomes = explode(',',$income);
      
          foreach ($incomes as $key => $value){
             echo '<li><a href="'.base_url('Admin/Incomes/incomeTable/'.$value). '"><i class="zmdi zmdi-dot-circle-alt"></i>'.ucfirst(str_replace('_',' ',$value)).'</a></li>';
          }
        ?>
  </div>
</div>   

   <div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Fund Management</span></a>

  <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
       <li><a href="<?php echo base_url('Admin/Userfund_Request_Management/userFund_Request/0'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Fund Requests</a></li>
          <li><a href="<?php echo base_url('Admin/Userfund_Request_Management/userFund_Request/1'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Approve Request</a></li>
          <li><a href="<?php echo base_url('Admin/Userfund_Request_Management/userFund_Request/2'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Reject Request</a></li>
  </div>
</div>

   <div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Provide Help Users</span></a>

  <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
       <li><a href="<?php echo base_url('Admin/Provide_help/provide_helpers'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Provide Help Users</a></li>
        <li><a href="<?php echo base_url('Admin/Provide_help/get_Help'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Get Help Users</a></li>  
  </div>
</div>

   <div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Epins</span></a>

  <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
      <li><a href="<?php echo base_url('Admin/Management_epin/genrateepin');?>"><i class="fa fa-circle-o"></i>Genrate Epin</a></li>
        <li><a href="<?php echo base_url('Admin/Management_epin/epinHistory/0');?>"><i class="fa fa-circle-o"></i>Available Epins</a></li>
        <li><a href="<?php echo base_url('Admin/Management_epin/epinHistory/1');?>"><i class="fa fa-circle-o"></i>Used Epins</a></li>
        <li><a href="<?php echo base_url('Admin/Management_epin/epinHistory/2');?>"><i class="fa fa-circle-o"></i>Transfer Epins History</a></li>
  </div>
</div>
    
<div class="dropdown">
    <a class="btn btn-secondary" href="<?php echo base_url('Admin/Dashboard/logout');?>"><span>Logout</span></a>

</div>

  
      
    </ul>
   
   </div>
</div>

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
 
   <div class="toggle-menu">
     <i class="zmdi zmdi-menu"></i>
   </div>
  
   <!-- <div class="search-bar flex-grow-1 d-none">
     <div class="input-group">
      <div class="input-group-prepend search-arrow-back">
        <button class="btn btn-search-back" type="button"><i class="zmdi zmdi-long-arrow-left"></i></button>
      </div>
      <input type="text" class="form-control" placeholder="search">
      <div class="input-group-append">
        <button class="btn btn-search" type="button"><i class="zmdi zmdi-search"></i></button>
      </div>
      </div>
    </div> -->

    
     
   <ul class="navbar-nav align-items-center right-nav-link ml-auto">
  <li class="nav-item dropdown search-btn-mobile">
    <a class="nav-link position-relative" href="javascript:void();">
      <i class="zmdi zmdi-search align-middle"></i>
    </a>
   </li>
    <li class="nav-item dropdown dropdown-lg d-none">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" data-toggle="dropdown" href="javascript:void();">
      <i class="zmdi zmdi-comment-outline align-middle"></i><span class="bg-danger text-white badge-up">12</span></a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
         <li class="list-group-item d-flex justify-content-between align-items-center">
          New Messages <a href="javascript:void();" class="extra-small-font">Clear All</a>
          </li>
          <li class="list-group-item d-none">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="<?php //echo base_url('Assets/Admin/');?>images/avatars/avatar-5.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Jhon Deo</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            <small>Today, 4:10 PM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item d-none">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="<?php //echo base_url('Assets/Admin/');?>images/avatars/avatar-6.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Sara Jen</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            <small>Yesterday, 8:30 AM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item d-none">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="<?php //echo base_url('Assets/Admin/');?>images/avatars/avatar-7.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Dannish Josh</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
             <small>5/11/2018, 2:50 PM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item d-none">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="<?php //echo base_url('Assets/Admin/');?>images/avatars/avatar-8.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Katrina Mccoy</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet.</p>
            <small>1/11/2018, 2:50 PM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item text-center d-none"><a href="javaScript:void();">See All Messages</a></li>
        </ul>
        </div>
    </li>
    <li class="nav-item dropdown dropdown-lg d-none">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" data-toggle="dropdown" href="javascript:void();">
      <i class="zmdi zmdi-notifications-active align-middle"></i><span class="bg-info text-white badge-up">14</span></a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            New Notifications <a href="javascript:void();" class="extra-small-font">Clear All</a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <i class="zmdi zmdi-accounts fa-2x mr-3 text-info"></i>
            <div class="media-body">
            <h6 class="mt-0 msg-title">New Registered Users</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <i class="zmdi zmdi-coffee fa-2x mr-3 text-warning"></i>
            <div class="media-body">
            <h6 class="mt-0 msg-title">New Received Orders</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <i class="zmdi zmdi-notifications-active fa-2x mr-3 text-danger"></i>
            <div class="media-body">
            <h6 class="mt-0 msg-title">New Updates</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item text-center"><a href="javaScript:void();">See All Notifications</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item dropdown language d-none">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" data-toggle="dropdown" href="javascript:void();"><i class="flag-icon flag-icon-gb align-middle"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"><i class="flag-icon flag-icon-gb mr-3"></i>English</li>
          <li class="dropdown-item"><i class="flag-icon flag-icon-fr mr-3"></i>French</li>
          <li class="dropdown-item"><i class="flag-icon flag-icon-cn mr-3"></i>Chinese</li>
          <li class="dropdown-item"><i class="flag-icon flag-icon-de mr-3"></i>German</li>
        </ul>
    </li>
    <!-- <li class="nav-item dropdown">
      <?php //echo form_open_multipart('Admin/Dashboard/admin_Profile');?>
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" data-toggle="dropdown" href="javascript:void();">
        <span class="user-profile"><img src="<?php //echo base_url('Assets/Admin/');?>images/avatars/avatar-13.png" class="img-circle" alt="Profile"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <input type="file" name="admin_profile">
            <input type="submit" name="" value="submit" class="btn btn-sm btn-info">
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <a href="<?php //echo base_url('Admin/Dashboard/logout');?>"><li class="dropdown-item"><i class="fas fa-power-off"></i>Logout</li></a>
      </ul>
      <?php //form_close(); ?>
    </li> -->
   
  </ul>

</nav>
</header>
<!--End topbar header-->