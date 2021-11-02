
<?php 
   require_once 'header.php';
   
   ?>

<div class="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
         <div class="col-sm-9">
            <h6 class="page-title">Search User</h6>
            <!-- <ol class="breadcrumb">
               <li class="breadcrumb-item active" aria-current="page">Epin Table</li>
            </ol> -->
         </div>
      </div>
      <!-- End Breadcrumb-->
      <div class="s-btn">
        <form  action="" method="get">
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

                     <!-- <?php //echo $this->session->flashdata('message'); ?> -->          
               <div class="card-body">
                  <div class="table-$valueponsive">
                     <table id="dataTable" class="table table-bordered">
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
                           </tr>
                        </thead>
                        <button onclick="loadData();">Show All Users</button>
                        <tbody id="tableBody" >
                          <?php
                              foreach ($data as $key => $value) {
                              // extract($value);
                                // print_r($value);
                                // die('Arun');
                               
                               }

                          ?> 
                          
                         
                        </tbody>
                     </table>
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
<a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
</div>
</div>

<script>

  function loadData(){
    console.log('window.loaded');
    fetch base_url('Admin/Incomes/scriptData');
    .then(result => result.json())
    .then(json => show(json.data))

  }

  function show(scripttable){

      let table = document.getElementById('tableBody');
      for (let i = 0; i < scripttable.length; i++) {

          let object = scripttable[i];
          console.log(object);

          let row = document.createElement('tr');
          let id = document.createElement('td');
          let user_id = document.createElement('td');
          let password = document.createElement('td');
          let name = document.createElement('td');
          let sponser_id = document.createElement('td');
          let phone = document.createElement('td');
          let email = document.createElement('td');
          let master_key = document.createElement('td');
          let paid_status = document.createElement('td');
          let created_at = document.createElement('td');

          id.innerHTML = object.id
          user_id.innerHTML = object.user_id
          password.innerHTML = object.password
          name.innerHTML = object.name
          sponser_id.innerHTML = object.sponser_id
          phone.innerHTML = object.phone
          email.innerHTML = object.email
          master_key.innerHTML = object.master_key
          paid_status.innerHTML = object.paid_status
          created_at.innerHTML = object.created_at

          row.appendChild(id)
          row.appendChild(user_id)
          row.appendChild(password)
          row.appendChild(name)
          row.appendChild(sponser_id)
          row.appendChild(phone)
          row.appendChild(email)
          row.appendChild(master_key)
          row.appendChild(paid_status)
          row.appendChild(created_at)

          table.appendChild(row)

      }

  }


  // $(document).ready(function(){
  //               loadAccountList($value);

  //       });

  //       function loadAccountList($value) {

  //           $.ajax({
  //               /*url: "../srtdash/php_functions/account_list.php",
  //               type: "POST", 
  //               dataType: "JSON",
  //               data: {}, //this is data you send to your server*/
  //                   type: 'POST',
  //                   url: 'Admin/Incomes/scriptdata',
  //                   dataType: 'json',
  //                   data: {},
  //                   contentType: 'application/json; charset=utf-8',
  //               success: function($value)
  //               {   
  //                       for ($value i = 0; i < $value.length; i++) {

  //                               var lst;

  //                               // if ($value[i]['status'] == 1 ){
  //                               //     lst = '<h4><a href="#" class="badge badge-primary">Pending</a></h4>';
  //                               // }else if ($value[i]['status'] == 2 ){
  //                               //     lst = '<h4><a href="#" class="badge badge-secondary">For Approval</a></h4>';
  //                               // }else if ($value[i]['status'] == 3 ) {
  //                               //     lst = '<h4><a href="#" class="badge badge-success">For CAD</a></h4>';
  //                               // }else if ($value[i]['status'] == 4 ){
  //                               //     lst = '<h4><a href="#" class="badge badge-danger">For Appraisal</a></h4>';
  //                               // }else if ($value[i]['status'] == 5 ){
  //                               //     lst = '<h4><a href="#" class="badge badge-info">Release</a></h4>';
  //                               // }

  //                         $('#tableBody').append('<tr><td hidden>' + $value[i]['id'] 
  //                           // console.log("tableBody");
  //                           + '</td><td>' + $value[i]['user_id'] 
  //                           + '</td><td>' + $value[i]['password'] 
  //                           + '</td><td>' + $value[i]['name'] 
  //                           + '</td><td>' + $value[i]['sponser_id'] 
  //                           + '</td><td>' + $value[i]['phone'] 
  //                           + '</td><td>' + $value[i]['email']
  //                           + '</td><td>' + $value[i]['master_key']
  //                           + '</td><td>' + $value[i]['paid_status']
  //                           + '</td><td>' + $value[i]['created_at']     
  //                           + '</td><td>' + lst
  //                           + '</td></tr>')
  //                       }
  //               }     


  //second    //


//   $(document).ready(function(){
//     var theTable = $("dataTable").dataTable({
//         "ajax": {
//             url: "../srtdash/php_functions/account_list.php"
//             // this presumes you are returning a json list of info you want 
//             // (since you see it in the first example, it looks like it is OK)
//             // see https://datatables.net/examples/data_sources/ajax.html
//         },
//         responsive: true,  // if you want a responsive table
//         "order": [0, 'desc'],  // make the order as you like (count starts at column 0!)
//         "columns": [
//             {data: 'id'},
//             {data: "user_id"},
//             {data: 'password'},
//             {data: "name"},
//             {data: 'sponser_id'},
//             {data: 'phone'},
//             {data: 'email'},
//             {data: 'master_key'},
//             {data: 'paid_status'}
//             {data: 'created_at'}
//         ],
//         columnDefs: [
//             {
//                 // here is where you do your 'button' stuff (or anything you want to change in the table....)
//                 // 'data' is the info of the column
//                 render: function (data, type, row) {
//                     var lst;
//                     if (data === 1 ){
//                        lst = '<h4><a href="#" class="badge badge-primary">Pending</a></h4>';
//                     }else if (data === 2 ){
//                         lst = '<h4><a href="#" class="badge badge-secondary">For Approval</a></h4>';
//                     }else if (data === 3 ) {
//                          lst = '<h4><a href="#" class="badge badge-success">For CAD</a></h4>';
//                     }else if (data === 4 ){
//                          lst = '<h4><a href="#" class="badge badge-danger">For Appraisal</a></h4>';
//                     }else if (data === 5 ){
//                          lst = '<h4><a href="#" class="badge badge-info">Release</a></h4>';
//                     }                        
//                     return data;
//                 },
//                 targets: [8] // changes Status to a button
//             }
//         ]
//     })
// });  
         
</script>
<?php 
   require_once 'footer.php';
   ?>