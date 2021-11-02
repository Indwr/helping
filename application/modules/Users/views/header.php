
<?php 
$user_info = user_info();
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from codervent.com/rocker/demo/index5.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 03 Jan 2021 09:39:14 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?php echo title;?></title>
  <!--favicon-->
  <link rel="icon" href="<?php echo base_url(logo);?>" type="image/x-icon"/>
  <!-- Vector CSS -->
  <link href="<?php echo base_url('Assets/Dashboard/');?>plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="<?php echo base_url('Assets/Dashboard/');?>plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url('Assets/Dashboard/');?>css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?php echo base_url('Assets/Dashboard/');?>css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo base_url('Assets/Dashboard/');?>css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="<?php echo base_url('Assets/Dashboard/');?>css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="<?php echo base_url('Assets/Dashboard/');?>css/app-style.css" rel="stylesheet"/>
  <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-replace-svg="nest"></script>
</head>

<body>

<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true" class="color-sidebar bg-dark">
     <div class="brand-logo">
      <a href="">
       <img src="<?php echo base_url(logo);?>" class="logo-icon" alt="logo icon" style="width: 60%; margin-top: 7px;">
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="logo-text" style="color: red;"><?php echo $user_info['name'];?></li> 
     
      <li>
        <a href="<?php echo base_url('Users/Dashboard/index');?>" class="waves-effect">
          <i class="icon-home"></i><span>Dashboard</span><i class="fas fa-dot-circle"></i>
        </a>
    </li>
   
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="icon-briefcase"></i>
          <span>Epins</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
        <li><a href="<?php echo base_url('Users/Dashboard/transfer_epin');?>"><i class="fa fa-circle-o"></i>Transfer Epin</a></li>
        
        <li><a href="<?php echo base_url('Users/Dashboard/epinsHistory/0');?>"><i class="fa fa-circle-o"></i>Available Epins</a></li>
        <li><a href="<?php echo base_url('Users/Dashboard/epinsHistory/1');?>"><i class="fa fa-circle-o"></i>Used Epins</a></li>
        <li><a href="<?php echo base_url('Users/Dashboard/epinsHistory/2');?>"><i class="fa fa-circle-o"></i>Transfer Epins History</a></li>
        
        </ul>
      </li>
      <li>
        <a href="#" class="waves-effect">
          <i class="fa fa-circle-o"></i> <span>Incomes</span>
          <i class="fa fa-angle-left float-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <?php 
            $incomes = incomeType();
            $users = explode(',', $incomes);
            foreach ($users as $key => $value) {
              // echo $value;
              echo '<li><a href="'.base_url('Users/Dashboard/incomeTable/'.$value).'"><i class="fa fa-circle-o"></i>'.ucfirst(str_replace('_', ' ', $value)).'</a></li>';

            }
          ?>
        </ul>
       </li>
       
    <li>
        <a href="#" class="waves-effect">
          <i class="fas fa-user"></i><span>Profile</span>
          <i class="fa fa-angle-left float-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url('Users/Dashboard/edit_profile'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Edit Profile</a></li>   
        </ul>
        <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url('Users/Dashboard/add_bank_Details'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Add Bank Details</a></li>   
        </ul>
    </li>
       
    <li>
        <a href="#" class="waves-effect">
          <i class="fa fa-circle-o"></i> <span>Fund Management</span>
          <i class="fa fa-angle-left float-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url('Users/Fund_Management/fund_request'); ?>"><i class="fa fa-circle-o"></i>Fund Request</a></li>
          <li><a href="<?php echo base_url('Users/Fund_Management/fund_History'); ?>"><i class="fa fa-circle-o"></i>Fund History</a></li>
          
        </ul>
    </li>
      
      <li>
        <a href="#" class="waves-effect">
          <i class="fas fa-user"></i><span>Help History</span>
          <i class="fa fa-angle-left float-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url('Users/Help_result/provide_History'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Provide Help History</a></li>   
        </ul>
        <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url('Users/Help_result/receive_History'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Receive Help History</a></li>   
        </ul>
    </li>

        <li><a href="<?php echo base_url('Users/Dashboard/logout');?>"><i class="fas fa-power-off"></i> Logout</a></li>
      
    </ul>
   
   </div>
</div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top gradient-scooter color-header">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <h4><?php echo $user_info['name'];?></h4>
      <!-- <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>

      </form> -->
    </li>
  </ul>
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item dropdown-lg d-none">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="icon-envelope-open"></i><span class="badge badge-danger badge-up">24</span></a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
         <li class="list-group-item d-flex justify-content-between align-items-center">
          You have 24 new messages
          <span class="badge badge-danger">24</span>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-1.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Jhon Deo</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            <small>Today, 4:10 PM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-2.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Sara Jen</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            <small>Yesterday, 8:30 AM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-3.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Dannish Josh</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
             <small>5/11/2018, 2:50 PM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-4.png" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title">Katrina Mccoy</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet.</p>
            <small>1/11/2018, 2:50 PM</small>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item"><a href="javaScript:void();">See All Messages</a></li>
        </ul>
        </div>
    </li>
    <li class="nav-item dropdown-lg d-none">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
    <i class="icon-bell"></i><span class="badge badge-primary badge-up">10</span></a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
          You have 10 Notifications
          <span class="badge badge-primary">10</span>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <i class="icon-people fa-2x mr-3 text-info"></i>
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
             <i class="icon-cup fa-2x mr-3 text-warning"></i>
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
             <i class="icon-bell fa-2x mr-3 text-danger"></i>
            <div class="media-body">
            <h6 class="mt-0 msg-title">New Updates</h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            </div>
          </div>
          </a>
          </li>
          <li class="list-group-item"><a href="javaScript:void();">See All Notifications</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item language d-none">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="#"><i class="flag-icon flag-icon-gb"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
        </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#" aria-expanded="false">
        <span class="user-profile"><img src="<?php echo base_url('uploads/'.$user_info['image']);?>" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="<?php echo base_url('uploads/'.$user_info['image']);?>" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title"><?php echo $user_info['name'];?></h6>
            <p class="user-subtitle"><?php echo $user_info['user_id'];?></p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        
        <a href="<?php echo('logout');?>"><li class="dropdown-item"><i class="fas fa-power-off"></i> Logout</li></a>
      </ul>
    </li>
  </ul>
  
</nav>
</header>
<!--End topbar header-->