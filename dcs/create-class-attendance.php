<?php
date_default_timezone_set('Asia/Manila');

include 'phpqrcode/qrlib.php';
include 'config.php';

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseId = $_POST['course'] ?? '';
    $yearLevel = $_POST['year_level'] ?? '';
    $sectionId = $_POST['section'] ?? '';
    $professorId = $_POST['professor'] ?? '';
    $dayId = $_POST['day'] ?? '';
    $time = $_POST['time'] ?? '';
    $timeEnd = $_POST['time_end'] ?? '';
    $subjectCode = $_POST['subject_code'] ?? '';
    $subjectName = $_POST['subject_name'] ?? '';
    $classTypeId = $_POST['class_type'] ?? '';

    // Validate day and time
    if (!isValidDay($dayId) || !isValidTimeRange($time, $timeEnd)) {
        echo "Invalid day or time range. Please check your inputs.";
        exit();
    }

    // Fetch additional information for the QR code data
    $courseQuery = "SELECT course_name FROM tblcourse WHERE course_id = ?";
    $stmtCourse = $conn->prepare($courseQuery);
    $stmtCourse->bind_param("i", $courseId);
    $stmtCourse->execute();
    $courseName = $stmtCourse->get_result()->fetch_assoc()['course_name'];

    $sectionQuery = "SELECT section_name FROM tblsection WHERE section_id = ?";
    $stmtSection = $conn->prepare($sectionQuery);
    $stmtSection->bind_param("i", $sectionId);
    $stmtSection->execute();
    $sectionName = $stmtSection->get_result()->fetch_assoc()['section_name'];

    $professorQuery = "SELECT last_name, first_name FROM tblprofessors WHERE id = ?";
    $stmtProfessor = $conn->prepare($professorQuery);
    $stmtProfessor->bind_param("i", $professorId);
    $stmtProfessor->execute();
    $professorData = $stmtProfessor->get_result()->fetch_assoc();
    $professorName = $professorData['last_name'] . ', ' . $professorData['first_name'];

    // Fetch class type name
    $classTypeQuery = "SELECT class_type FROM tblclasstype WHERE id = ?";
    $stmtClassType = $conn->prepare($classTypeQuery);
    $stmtClassType->bind_param("i", $classTypeId);
    $stmtClassType->execute();
    $classType = $stmtClassType->get_result()->fetch_assoc()['class_type'];

    // Convert time to DateTime object
    $startTime = new DateTime($time, new DateTimeZone('Asia/Manila'));
    $endTime = new DateTime($timeEnd, new DateTimeZone('Asia/Manila'));

    // Get the formatted time strings for database storage
    $formattedTimeStart = $startTime->format('H:i:s');
    $formattedTimeEnd = $endTime->format('H:i:s');

    // Insert the class record into the database
    $insertClassQuery = "INSERT INTO tblclass (course_id, year_level, section_id, professor_id, day_id, valid_day, time, time_end, subject_code, subject_name, class_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtClass = $conn->prepare($insertClassQuery);
    $stmtClass->bind_param("iissiisssss", $courseId, $yearLevel, $sectionId, $professorId, $dayId, $dayId, $formattedTimeStart, $formattedTimeEnd, $subjectCode, $subjectName, $classTypeId);
    $resultClass = $stmtClass->execute();

    if ($resultClass) {
        $classId = $stmtClass->insert_id;

        // Generate a unique URL for this class
        $attendanceLink = "http://localhost/php.program/mementomori%20v2.4/dcs/mark_attendance.php?class_id=$classId";


        // Construct the QR code data
        $qrCodeData = "Class: {$courseName} - {$yearLevel} {$sectionName}\n";
        $qrCodeData .= "Subject: {$subjectName} ({$subjectCode})\n";
        $qrCodeData .= "Professor: {$professorName}\n";
        $qrCodeData .= "Time: {$formattedTimeStart} - {$formattedTimeEnd}\n";
        $qrCodeData .= "Class Type: {$classType}\n";
        $qrCodeData .= "Attendance Link: $attendanceLink";

        // Increase the size of the QR code
        $qrCodeFilename = "qrcodes/class_$classId.png";

        // Save the QR code to the file
        QRcode::png($qrCodeData, $qrCodeFilename, QR_ECLEVEL_L, 10, 2);

        // Update the database with the file path
        $updateQuery = "UPDATE tblclass SET qr_code_path = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($updateQuery);
        $stmtUpdate->bind_param("si", $qrCodeFilename, $classId);
        $stmtUpdate->execute();

        // Redirect to success.php with the class_id parameter
        header("Location: success.php?class_id=$classId");
        exit();
    } else {
        echo "Error creating class: " . $conn->error;
    }
}

// Fetch data for dropdowns
$professors = getProfessors();
$courses = getCourses();
$sections = getSections();
$classTypes = getClassTypes();
$dayMapping = [
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DCS | Create Subject Attendance</title>

  
    <!-- Font Awesome icons for additional styling and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- Favicon for the website tab -->
    <link rel="icon" href="image/dcss.png" type="image"/>

    <!-- Bootstrap CSS for styling and layout components -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>

    <!-- Custom styles for the post dashboard -->
    <link rel="stylesheet" href="css/postdashboard.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    
    <!-- DataTables CSS for enhanced HTML tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>

    <!-- DataTables Responsive extension CSS for responsive tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />

    <!-- JavaScript module for application logic -->
    <script src="js/course.js" type="module"></script>
  </head>
  <body>
  <?php include 'inc/sidebar.php';?>

<section class="content">
<?php include 'inc/navbar.php';?>

<main>
<div class="head-title" >
          <div class="left">
            <h1>Create Subject Attendance</h1>
            <ul class="breadcrumb">
            </ul>
          </div>
        </div>
<div class="form-containter">
<form method="post" action="">
    <label for="course">Course:</label>
    <select name="course" required>
        <?php foreach ($courses as $course): ?>
            <option value="<?php echo $course['course_id']; ?>"><?php echo $course['course_name']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="year_level">Year Level:</label>
    <input type="text" name="year_level" required><br>

    <label for="section">Section:</label>
    <select name="section" required>
        <?php foreach ($sections as $section): ?>
            <option value="<?php echo $section['section_id']; ?>"><?php echo $section['section_name']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="professor">Professor:</label>
    <select name="professor" required>
        <?php foreach ($professors as $professor): ?>
            <option value="<?php echo $professor['id']; ?>"><?php echo $professor['last_name'] . ', ' . $professor['first_name']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="day">Day:</label>
    <select name="day" required>
        <?php foreach ($dayMapping as $dayId => $dayName): ?>
            <option value="<?php echo $dayId; ?>"><?php echo $dayName; ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="time">Time:</label>
    <input type="time" name="time" required><br>

    <label for="time_end">Time End:</label>
    <input type="time" name="time_end" required><br>

    <label for="subject_code">Subject Code:</label>
    <input type="text" name="subject_code" required><br>

    <label for="subject_name">Subject Name:</label>
    <input type="text" name="subject_name" required><br>

    <label for="class_type">Class Type:</label>
    <select name="class_type" required>
        <?php foreach ($classTypes as $classType): ?>
            <option value="<?php echo $classType['id']; ?>"><?php echo $classType['class_type']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Create Attendance">
</form>
</main>
    </section>
</body>
</html>

<?php
$conn->close();

function getProfessors() {
    global $conn;
    $result = $conn->query("SELECT * FROM tblprofessors");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getCourses() {
    global $conn;
    $result = $conn->query("SELECT * FROM tblcourse");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getSections() {
    global $conn;
    $result = $conn->query("SELECT * FROM tblsection");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getClassTypes() {
    global $conn;
    $result = $conn->query("SELECT * FROM tblclasstype");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function isValidDay($dayId) {
    // Add your validation logic here
    // For example, you can check if $dayId is in a valid range (e.g., 1-7 for Monday-Sunday)
    return ($dayId >= 1 && $dayId <= 6);
}

function isValidTimeRange($startTime, $endTime) {
    // Add your validation logic here
    // For example, you can check if $startTime and $endTime are in a valid time range
    return (strtotime($startTime) < strtotime($endTime));
}
?>
