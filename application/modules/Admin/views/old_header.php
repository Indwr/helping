<!-- Start wrapper-->
 <div id="wrapper">

 
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
   
    <div class="brand-logo">
    <img src="<?php echo base_url(logo);?>" class="logo-icon" alt="logo icon" style="width: 60%;">
    
    <div class="close-btn"><i class="zmdi zmdi-close"></i></div>
   </div>
    
     <ul class="metismenu" id="menu">
      <li>
        <a href="<?php echo base_url('Admin'); ?>" class="waves-effect">
          <i class="icon-home"></i><span>Dashboard</span>
        </a>
    </li>

     <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fas fa-users"></i>
          <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
        <li><a href="<?php echo base_url('Admin/Dashboard/allusers/0');?>"><i class="fas fa-users"></i>All Users</a></li>
        <li><a href="<?php echo base_url('Admin/Dashboard/allusers/1');?>"><i class="fas fa-users"></i>Paid Users</a></li>
        <li><a href="<?php echo base_url('Admin/Dashboard/allusers/2');?>"><i class="zmdi zmdi-dot-circle-alt"></i>Unpaid Users</a></li>
        <li><a href="<?php echo base_url('Admin/Dashboard/allusers/3');?>"><i class="fa fa-ban" aria-hidden="true"></i>Block Users</a></li> 
        </ul>
      </li>


    <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="icon-briefcase"></i>
        <span>Epins</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url('Admin/Management_epin/genrateepin');?>"><i class="zmdi zmdi-dot-circle-alt"></i>Genrate Epin</a></li>
         <li><a href="<?php echo base_url('Admin/Management_epin/epinHistory/0');?>"><i class="zmdi zmdi-dot-circle-alt"></i>Epins Record Table</a></li>
         <li><a href="<?php echo base_url('Admin/Management_epin/epinHistory/1');?>"><i class="zmdi zmdi-dot-circle-alt"></i>Available Epins</a></li>
         <li><a href="<?php echo base_url('Admin/Management_epin/epinHistory/2');?>"><i class="zmdi zmdi-dot-circle-alt"></i>Transfer Epins</a></li>
      </ul>
    </li>
   
    <li>
      <a class="has-arrow" href="javascript:void();">
      <div class="parent-icon"><i class="zmdi zmdi-view-dashboard"></i></div>
      <div class="menu-title">Incomes Report</div>
      </a>
      <ul class="">
        <?php
           $income = incomeType();
           $incomes = explode(',',$income);
      
          foreach ($incomes as $key => $value){
             echo '<li><a href="'.base_url('Admin/Incomes/incomeTable/'.$value). '"><i class="zmdi zmdi-dot-circle-alt"></i>'.ucfirst(str_replace('_',' ',$value)).'</a></li>';
          }
        ?>
    </ul>
    </li>

    
    <li>
      <a class="has-arrow" href="javascript:void();">
      <div class="parent-icon"><i class="zmdi zmdi-view-dashboard"></i></div>
      <div class="menu-title">Fund Management</div>
      </a>
     <ul>
          <li><a href="<?php echo base_url('Admin/Userfund_Request_Management/userFund_Request/0'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Fund Request</a></li>
          <li><a href="<?php echo base_url('Admin/Userfund_Request_Management/userFund_Request/1'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Approve Request</a></li>
          <li><a href="<?php echo base_url('Admin/Userfund_Request_Management/userFund_Request/2'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Reject Request</a></li>
      </ul>
    </li>

    <li>
      <a class="has-arrow" href="javascript:void();">
      <div class="parent-icon"><i class="zmdi zmdi-view-dashboard"></i></div>
      <div class="menu-title">Provide Help Users</div>
      </a>
     <ul>
        <li><a href="<?php echo base_url('Admin/Provide_help/provide_helpers'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Provide Help Users</a></li>
        <li><a href="<?php echo base_url('Admin/Provide_help/get_Help'); ?>"><i class="zmdi zmdi-dot-circle-alt"></i>Get Help Users</a></li>
      </ul>
    </li>

    <li>
      <a href="<?php echo base_url('Admin/Dashboard/logout');?>">
      <div class="parent-icon"><i class="fas fa-power-off"></i></div>
      <div class="menu-title">Logout</div>
      </a>
    </li>
    
     </ul>
   
   </div>
</div>
   <!--End sidebar-wrapper-->