<?php 
// Include config file 
include_once 'config.php';

 
// Database connection info 
$dbDetails = array( 
    'host' => $hostName, 
    'user' => $dbUser, 
    'pass' => $dbPassword, 
    'db'   => $dbName 
); 
 
// DB table to use 
$table = 'tblsection'; 
 
// Table's primary key 
$primaryKey = 'section_id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'section_id',  'dt' => 0 ), 
    array( 'db' => 'section_name',  'dt' => 1 ), 
    array( 
      'db'        => 'section_id', 
      'dt'        => 2, 
      'formatter' => function ($d, $row) { 
          return ' 
              <a href="javascript:void(0);" class="btn btn-success edit-btn" 
                  data-section-data="' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . '">
                  Edit </a>&nbsp; 
              <a href="javascript:void(0);" class="btn btn-primary delete-btn" data-section-id="' . $d . '">Archive</a>
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