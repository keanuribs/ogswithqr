<?php 
// Include config file 
include_once '../db/config.php'; 

 
// Database connection info 
$dbDetails = array( 
    'host' => $hostName, 
    'user' => $dbUser, 
    'pass' => $dbPassword, 
    'db'   => $dbName 
); 

// DB table to use 
$table = 'tblstudents'; 
 
// Table's primary key 
$primaryKey = 'id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'id',  'dt' => 0 ), 
    array( 'db' => 'last_name',  'dt' => 1 ), 
    array( 'db' => 'first_name', 'dt' => 2 ), 
    array( 'db' => 'middle_name', 'dt' => 3 ), 
    array( 'db' => 'student_number', 'dt' => 4 ), 
    array( 'db' => 'course', 'dt' => 5 ),
    array( 'db' => 'year', 'dt' => 6 ),
    array( 'db' => 'section', 'dt' => 7 ),
    array( 
      'db'        => 'id', 
      'dt'        => 8, 
      'formatter' => function ($d, $row) { 
          return ' 
              <a href="javascript:void(0);" class="btn btn-success edit-btn" 
                  data-user-data="' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . '">
                  Edit </a>&nbsp; 
              <a href="javascript:void(0);" class="btn btn-primary delete-btn" data-student-id="' . $d . '">Archive</a>
          '; 
      }
  ) 
); 


 

// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
);