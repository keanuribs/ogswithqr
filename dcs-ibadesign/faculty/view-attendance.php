<?php
$currentPage = basename($_SERVER['PHP_SELF']);


session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: ../index.php");
    die();
}

include '../db/config.php';// Include your database connection

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if ($query) {
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $fname = $row['fname'];
        $lname = $row['lname'];
    } else {
        $fname = "User Not Found";
        $lname = "User Not Found";
    }
} else {
    die("Query failed: " . mysqli_error($conn));
}
$roles = isset($_SESSION['ROLES']) ? $_SESSION['ROLES'] : "Role Not Found";



include '../phpqrcode/qrlib.php'; // Include the QR Code library

// Display records in a table
$query = "SELECT c.*, d.day_name, ct.class_type FROM tblclass c
          LEFT JOIN tbldays d ON c.day_id = d.day_id
          LEFT JOIN tblclasstype ct ON c.class_type = ct.id";
$result = $conn->query($query);

$htmlContent = "";
// Display records in a table
// Display records in a table
if ($result === false) {
    trigger_error('Error: ' . $conn->error, E_USER_ERROR);
} elseif ($result->num_rows > 0) {
    $htmlContent .= "<table border='1'>";
    $htmlContent .= "<tr><th>Course</th><th>Year Level</th><th>Section</th><th>Professor</th><th>Day</th><th>Time Start</th><th>End Time</th><th>Subject Code</th><th>Subject Name</th><th>Class Type</th><th>QR Code</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        // Skip rows where the day is Sunday
        if ($row['day_id'] == 7) {
            continue;
        }

        $htmlContent .= "<tr>";

        // Fetch course name
        $courseQuery = "SELECT course_name FROM tblcourse WHERE course_id = " . $row['course_id'];
        $courseResult = $conn->query($courseQuery);

        // Handle empty result more gracefully
        $courseName = ($courseResult && $courseResult->num_rows > 0) ? $courseResult->fetch_assoc()['course_name'] : 'Unknown';
        $htmlContent .= "<td>" . $courseName . "</td>";

        $htmlContent .= "<td>" . $row['year_level'] . "</td>";

        // Fetch section name
        $sectionQuery = "SELECT section_name FROM tblsection WHERE section_id = " . $row['section_id'];
        $sectionResult = $conn->query($sectionQuery);
        $sectionName = ($sectionResult && $sectionResult->num_rows > 0) ? $sectionResult->fetch_assoc()['section_name'] : 'Unknown';
        $htmlContent .= "<td>" . $sectionName . "</td>";

        // Fetch professor name
        $professorQuery = "SELECT last_name, first_name FROM tblprofessors WHERE id = " . $row['professor_id'];
        $professorResult = $conn->query($professorQuery);

        // Handle empty result more gracefully
        $professorData = ($professorResult && $professorResult->num_rows > 0) ? $professorResult->fetch_assoc() : null;
        $professorName = ($professorData) ? $professorData['last_name'] . ', ' . $professorData['first_name'] : 'Unknown';
        $htmlContent .= "<td>" . $professorName . "</td>";

        // Fetch day name from tbldays table
        $day = $row['day_name'];
        $htmlContent .= "<td>" . $day . "</td>";

        // Format time to standard (12-hour) format
        $formattedTimeStart = date("h:i A", strtotime($row['time']));
        $htmlContent .= "<td>" . $formattedTimeStart . "</td>";

        // Display the "End Time" and "Class Type" columns
        $htmlContent .= "<td>" . date("h:i A", strtotime($row['time_end'])) . "</td>";
        $htmlContent .= "<td>" . $row['subject_code'] . "</td>";

        $htmlContent .= "<td>" . $row['subject_name'] . "</td>";
        $htmlContent .= "<td>" . $row['class_type'] . "</td>";  // Updated column name

        // Generate the QR code based on subject-related information, day, time, and section
        $qrCodeData = "Subject Code: {$row['subject_code']}, Subject Name: {$row['subject_name']}, Professor: {$professorName}, Time: {$formattedTimeStart}, Day: {$day}, Section: {$sectionName}, Year Level: {$row['year_level']}";

        $updateQuery = "UPDATE tblclass SET qr_code = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);

        // Output the QR code directly to the database
        ob_start();
        QRcode::png($qrCodeData, null, QR_ECLEVEL_L, 4, 0);
        $qrCodeImage = ob_get_clean();

        $stmt->bind_param("si", $qrCodeImage, $row['id']);
        $stmt->execute();

        // Display the QR code image without the "Scan QR Code" text
        $htmlContent .= "<td><img src='data:image/png;base64," . base64_encode($qrCodeImage) . "' alt='QR Code' style='width: 100px; height: 100px;'></td>";

        // Link to view_students.php with the class ID as a parameter
        $htmlContent .= "<td><a href='view_student.php?class_id={$row['id']}' class='btn btn-info text-white text-decoration-none'>View Records</a></td>";
        
        // Download link for the QR code
        $htmlContent .= "<td><a href='download_qr.php?class_id={$row['id']}' download class='btn btn-success text-white text-decoration-none'>Download</a></td>";

        $htmlContent .= "</tr>";
    }
    $htmlContent .= "</table>";
} else {
    $htmlContent .= "No class records found.";
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DCS | View Subject Attendance</title>
    <link rel="shortcut icon" href="assets/img/dcslogo.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/dashboardstyle.css">
</head>

<body>

    <div class="main-wrapper">

    <?php include 'inc/facultyheader-sidebar.php';?>
    
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">View Subject Attendance</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">View Attendance</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
    <main>
        <div class="qrtable-container">
            <?php echo $htmlContent; ?>
        </div>
    </main>
</section>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="../assets/plugins/apexchart/chart-data.js"></script>
    <script src="../assets/js/dashboardscript.js"></script>
</body>
</html>