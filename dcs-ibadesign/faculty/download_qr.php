<?php
include '../db/config.php'; // Include your database connection

if (isset($_GET['class_id'])) {
    $classId = $_GET['class_id'];

    $query = "SELECT qr_code_path, subject_name, course_name, last_name, first_name, year_level, section_name
              FROM tblclass c
              LEFT JOIN tblcourse co ON c.course_id = co.course_id
              LEFT JOIN tblprofessors p ON c.professor_id = p.id
              LEFT JOIN tblsection s ON c.section_id = s.section_id
              WHERE c.id = ?";
              
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $classId);
    $stmt->execute();
    $stmt->bind_result($qrCodePath, $subjectName, $courseName, $professorLastName, $professorFirstName, $yearLevel, $sectionName);

    if ($stmt->fetch()) {
        // Customize the filename based on subject, course, professor, year, and section
        $filename = "QRCode_{$subjectName}_{$courseName}_{$professorLastName}_{$professorFirstName}_Year{$yearLevel}_Section{$sectionName}.png";

        // Send appropriate headers for image download
        header('Content-Type: image/png');
        header('Content-Disposition: inline; filename="' . $filename . '"');  // Change to inline for displaying in the browser

        // Output the QR code directly to the browser
        readfile($qrCodePath);
        exit();
    }
}

// Redirect to the main page if class_id is not provided or the record is not found
header('Location: view-attendance.php');
exit();
?>
