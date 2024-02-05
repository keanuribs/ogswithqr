<?php

$currentPage = basename($_SERVER['PHP_SELF']);

session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if ($query) {
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $name = $row['name'];
    } else {
        $name = "User Not Found"; // Set a default name for this case
    }
} else {
    die("Query failed: " . mysqli_error($conn)); // Display any SQL query errors
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>DCS | Professors</title>

    <!-- Bootstrap CSS for styling and layout components -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>

    <!-- Font Awesome icons for additional styling and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- Favicon for the website tab -->
    <link rel="icon" href="image/dcss.png" type="image"/>

    <!-- Custom styles for the post dashboard -->
    <link rel="stylesheet" href="css/postdashboard.css"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    <!-- DataTables CSS for enhanced HTML tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>

    <!-- DataTables Responsive extension CSS for responsive tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css"/>

    <!-- JavaScript module for application logic -->
    <script src="js/professors.js" type="module"></script>
</head>
<body>

<section class="content">
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Professors List</h1>
                <ul class="breadcrumb">
                </ul>
            </div>
        </div>

        <div class="datatable-container">
            <div class="top-panel">
                <a href="#" class="btn btn-success" id="addProfessorBtn"><i class="fas fa-plus"></i></a>
            </div>
            <table id="professorList" class="table table-striped border" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </main>
</section>

<div class="modal fade" id="professorDataModal" tabindex="-1" aria-labelledby="professorAddEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="professorModalLabel">Add New Professor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="professorDataFrm" id="professorDataFrm">
                <div class="modal-body">
                    <div class="frm-status"></div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="professorLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="professorLastName" placeholder="Enter Last Name" required>
                        </div>
                        <div class="col">
                            <label for="professorFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="professorFirstName" placeholder="Enter First Name" required>
                        </div>
                        <div class="col">
                            <label for="professorMiddleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="professorMiddleName" placeholder="Enter Middle Name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="professorEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="professorEmail" placeholder="Enter professor email" required>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="professorID" value="0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="submitProfessorBtn">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>