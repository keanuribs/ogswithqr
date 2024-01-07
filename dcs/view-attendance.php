<?php
$currentPage = basename($_SERVER['PHP_SELF']);


session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

include 'config.php'; // Include your database connection
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


include 'phpqrcode/qrlib.php'; // Include the QR Code library

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
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>DCS | View Attendance</title>

    <!-- Font Awesome icons for additional styling and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- Favicon for the website tab -->
    <link rel="icon" href="image/dcss.png" type="image"/>

    <!-- Bootstrap CSS for styling and layout components -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>

    <!-- Custom styles for the post dashboard -->
    <link rel="stylesheet" href="css/postdashboard.css"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    <!-- DataTables CSS for enhanced HTML tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>

    <!-- DataTables Responsive extension CSS for responsive tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css"/>

    <!-- JavaScript module for application logic -->
    <script src="js/course.js" type="module"></script>
</head>
<body>
<?php include 'inc/sidebar.php';?>

<section class="content">
    <?php include 'inc/navbar.php';?>
    <main>
        <div class="head-title">
            <div class="left">
                <h1>View Attendance</h1>
                <ul class="breadcrumb">
                </ul>
            </div>
        </div>
        <div class="qrtable-container">
            <?php echo $htmlContent; ?>
        </div>
    </main>
</section>
</body>
</html>