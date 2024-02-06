<?php
// Include the database configuration
include __DIR__ . '/../../db/config.php';

// Fetch existing students for dropdown
$studentsQuery = "SELECT id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name, student_number FROM tblstudents";
$studentsResult = $conn->query($studentsQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $student_name = $conn->real_escape_string($_POST["student_name"]);
  $student_number = intval($_POST["student_number"]);

  // Retrieve total attendance status for the selected student
  $attendanceQuery = "SELECT COUNT(attendance_status) AS total_attendance FROM tblattendance WHERE student_id = (SELECT id FROM tblstudents WHERE student_number = $student_number)";
  $attendanceResult = $conn->query($attendanceQuery);

  if ($attendanceResult) {
      $attendanceRow = $attendanceResult->fetch_assoc();
      $totalAttendance = $attendanceRow['total_attendance'];
  } else {
      $totalAttendance = 0; // Default value if there's an error
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="script.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <title>Midterm and Finals Dropdown</title>
  <style>
    /* Added some basic styling for better presentation */
    label, input {
      margin-bottom: 8px;
    }

    .form-group {
      display: flex;
      align-items: center;
    }

    .form-group label {
      margin-right: 10px;
    }

    .hidden {
      display: none;
    }

    .score-total-container {
    display: flex;
    gap: 10px; /* Adjust the gap as needed */
}
  </style>
</head>
<body>
  
<div id="alertContainer" style="position: fixed; top: 0; width: 100%; background-color: #96fa82; text-align: center; padding: 10px; display: none;"></div>

<form>
  <label for="sessionType">Select Session Type:</label>
  <select id="sessionType">
    <option value="" disabled selected>Select your option</option>
    <option value="lecture">Lecture</option>
    <option value="lab">Lab</option>
  </select>

  <br>

  <div id="lectureForm" class="hidden">
    <label for="examType">Select Exam Type:</label>
    <select id="examType">
      <option value="" disabled selected>Select your option</option>
      <option value="midterm">Midterm</option>
      <option value="finals">Finals</option>
    </select>

    <p id="selectedExam"></p>

    <br>

    <label for="examComponent">Select Exam Component:</label>
    <select id="examComponent">
      <!-- Options for Midterm -->
      <optgroup id="midtermOptions" label="Midterm">
        <option value="" disabled selected>Select your option</option>
        <option value="attendance">Attendance</option>
        <option value="classParticipation">Class Participation</option>
        <option value="quiz">Quiz</option>
        <option value="portfolio">Portfolio</option>
        <option value="midtermExam">Midterm Exam</option>
      </optgroup>

      <!-- Options for Finals -->
      <optgroup id="finalsOptions" label="Finals">
        <option value="" disabled selected>Select your option</option>
        <option value="classParticipationFinals">Class Participation</option>
        <option value="quizFinals">Quiz</option>
        <option value="portfolioFinals">Portfolio</option>
        <option value="finalsExam">Finals Exam</option>
      </optgroup>
    </select>

    <div id="attendanceForm" class="hidden">
        <h2>Attendance Form</h2>

        <div class="form-group">
          <label for="studentDropdown">Select Student:</label>
          <select id="studentDropdown" name="selectedStudentId">
            <?php
              // Loop through the fetched students and populate the dropdown
             while ($row = $studentsResult->fetch_assoc()) {
              echo "<option value='{$row['id']}' data-student-number='{$row['student_number']}'>{$row['full_name']}</option>";
            }
        
           // Close the database connection
           $conn->close();
           ?>
           </select>
          <label for="studentNumber">Student Number:</label>
          <input type="number" id="studentNumber" name="studentNumber" inputmode="numeric">
        </div>

        <div class="form-group">
          <label for="attendanceScore">Score:</label>
          <input type="number" id="attendanceScore" name="attendanceScore" inputmode="numeric"readonly oninput="consolidation()">

          <label for="attendanceTotal">Total:</label>
          <input type="number" id="attendanceTotal" name="attendanceTotal" inputmode="numeric" required>
        </div>

        <div class="form-group">
         <label for="attendanceWeighted">Weighted 10%:</label>
         <input type="number" id="attendanceWeighted" name="attendanceWeighted" inputmode="numeric" readonly>

          <label for="finalgrade">Final Grade</label>
          <input type="number" id="finalgrade" name="finalgrade" inputmode="numeric" readonly>

          <label for="consolidated">Consolidated</label>
          <input type="number" id="consolidated" name="consolidated" inputmode="numeric" readonly>
        </div>
        <button type="button" id="submitButton" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Submit</button>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    var studentDropdown = document.getElementById('studentDropdown');
    var studentNumberInput = document.getElementById('studentNumber');
    var attendanceScoreInput = document.getElementById('attendanceScore');

    studentDropdown.addEventListener('change', function () {
        var selectedOption = studentDropdown.options[studentDropdown.selectedIndex];
        var selectedStudentId = selectedOption.value;
        var studentNumber = selectedOption.getAttribute('data-student-number');

        studentNumberInput.value = studentNumber;

        // Add the AJAX call to fetch attendance data
        $.ajax({
            type: 'POST',
            url: 'fetch-attendance.php',
            data: { selectedStudentId: selectedStudentId },
            success: function (response) {
                var count = parseInt(response);
                console.log("Count: " + count);
                attendanceScoreInput.value = count;
            },
            error: function (error) {
                console.error("Error fetching data: " + error);
            }
        });
      });
    });
    document.getElementById('submitButton').addEventListener('click', function () {
    // Collect form data manually
    const selectedStudentId = document.getElementById('studentDropdown').value;
    const studentNumber = document.getElementById('studentNumber').value;
    const finalGrade = document.getElementById('finalgrade').value;
    const consolidated = document.getElementById('consolidated').value;

    // Debugging: Log the finalGrade value
    console.log('Final Grade:', finalGrade);

    // Create FormData manually
    const formData = new FormData();
    formData.append('submitAttendance', 'true'); // Add this line
    formData.append('selectedStudentId', selectedStudentId);
    formData.append('studentNumber', studentNumber);
    formData.append('finalGrade', finalGrade);
    formData.append('consolidated', consolidated);

    // Fetch request
    fetch('insert_data.php', {
    method: 'POST',
    body: formData,
})
.then(response => response.text())
.then(data => {
    console.log(data); // Output the response from the server
    
    if (data.includes('finish')) {
        // Display a warning SweetAlert
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: data,
        });
    } else if (data.includes('successfully')) {
        // Display a success SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: data,
        });
    } else {
        // Display an error SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An error occurred: ' + data,
        });
    }
})
.catch(error => {
    console.error('Error:', error);

    // Display an error SweetAlert
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'Failed to submit data. Please try again.',
    });
});

});
    </script>

    <div id="classParticipationForm" class="hidden">
      <h2>Class Participation Form</h2>

      <div class="form-group">
        <label for="classParticipationScore">Score:</label>
        <input type="number" id="classParticipationScore" name="classParticipationScore" inputmode="numeric" oninput="consolidation()">

        <label for="classParticipationTotal">Number of Total:</label>
        <input type="number" id="classParticipationTotal" name="classParticipationTotal" inputmode="numeric">
      </div>

      <div class="form-group">
        <label for="classParticipationWeighted">Weighted 10%:</label>
        <input type="number" id="classParticipationWeighted" name="classParticipationWeighted" inputmode="numeric" readonly>
      </div>
    </div>

    <div id="quizForm" class="hidden">
        <h2>Quiz Form</h2>
      
        <div class="form-group">
          <label for="quizLength">Number of Quizzes:</label>
          <input type="number" id="quizLength" name="quizLength" inputmode="numeric">
        </div>
      
        <div id="quizScoreTotalContainer" class="hidden">
          <!-- Quiz score and total fields will be dynamically added here -->
        </div>

        <div class="form-group">
            <label for="quizOverallScore">Overall Score:</label>
            <input type="number" id="quizOverallScore" name="quizOverallScore" inputmode="numeric" readonly oninput="consolidation()">

    
            <label for="quizOverallTotal">Overall Total:</label>
            <input type="number" id="quizOverallTotal" name="cquizOverallTotal" inputmode="numeric" readonly>
          </div>
      
        <div class="form-group">
          <label for="quizWeighted">Weighted 15%:</label>
          <input type="number" id="quizWeighted" name="quizWeighted" inputmode="numeric" readonly>
        </div>
      </div>
      
      <div id="portfolioForm" class="hidden">
        <h2>Portfolio Form</h2>
        <div class="form-group">
            <label for="portfolioLength">Number of Portfolios:</label>
            <input type="number" id="portfolioLength" name="portfolioLength" inputmode="numeric">
        </div>

        <div id="portfolioScoreTotalContainer" class="hidden portfolio-score-total-container">
            <!-- Portfolio score and total fields will be dynamically added here -->
        </div>

        <div class="form-group">
            <label for="overallPortfolioScore">Overall Score:</label>
            <input type="number" id="overallPortfolioScore" name="overallPortfolioScore" inputmode="numeric" readonly oninput="consolidation()">

            <label for="overallPortfolioTotal">Overall Total:</label>
            <input type="number" id="overallPortfolioTotal" name="overallPortfolioTotal" inputmode="numeric" readonly>
        </div>

        <div class="form-group">
            <label for="portfolioWeighted">Weighted 25%:</label>
            <input type="number" id="portfolioWeighted" name="portfolioWeighted" inputmode="numeric" readonly>
        </div>
    </div>
    
    <div id="classParticipationFormFinals" class="hidden">
      <h2>Class Participation Form - Finals</h2>
      <div class="form-group">
        <label for="classParticipationScoreFinals">Score:</label>
        <input type="number" id="classParticipationScoreFinals" name="classParticipationScoreFinals" inputmode="numeric" oninput="consolidation()">

        <label for="classParticipationTotalFinals">Number of Total:</label>
        <input type="number" id="classParticipationTotalFinals" name="classParticipationTotalFinals" inputmode="numeric">
      </div>

      <div class="form-group">
        <label for="classParticipationWeightedFinals">Weighted 10%:</label>
        <input type="number" id="classParticipationWeightedFinals" name="classParticipationWeightedFinals" inputmode="numeric" readonly>
      </div>
    </div>

    <div id="finalQuizForm" class="hidden">
      <h2>Final Quiz Form</h2>
    
      <div class="form-group">
        <label for="finalQuizLength">Number of Quizzes:</label>
        <input type="number" id="finalQuizLength" name="finalQuizLength" inputmode="numeric">
      </div>
    
      <div id="finalQuizScoreTotalContainer" class="hidden">
        <!-- Final Quiz score and total fields will be dynamically added here -->
    </div>
      
      <div class="form-group">
        <label for="finalQuizOverallScore">Overall Score:</label>
        <input type="number" id="finalQuizOverallScore" name="finalQuizOverallScore" inputmode="numeric"oninput="consolidation()">
    
        <label for="finalQuizOverallTotal">Overall Total:</label>
        <input type="number" id="finalQuizOverallTotal" name="finalQuizOverallTotal" inputmode="numeric">
      </div>
    
      <div class="form-group">
        <label for="finalQuizWeighted">Weighted 15%:</label>
        <input type="number" id="finalQuizWeighted" name="finalQuizWeighted" inputmode="numeric" readonly>
      </div>
    </div>
    
    <div id="finalPortfolioForm" class="hidden">
      <h2>Final Portfolio Form</h2>
      
      <div class="form-group">
        <label for="finalPortfolioLength">Number of Portfolios:</label>
        <input type="number" id="finalPortfolioLength" name="finalPortfolioLength" inputmode="numeric">
      </div>
      
      <div id="finalPortfolioScoreTotalContainer" class="hidden">
        <!-- Final Portfolio score and total fields will be dynamically added here -->
      </div>
    
      <div class="form-group">
        <label for="finalPortfolioOverallScore">Overall Score:</label>
        <input type="number" id="finalPortfolioOverallScore" name="finalPortfolioOverallScore" inputmode="numeric"oninput="consolidation()">
        
        <label for="finalPortfolioOverallTotal">Overall Total:</label>
        <input type="number" id="finalPortfolioOverallTotal" name="finalPortfolioOverallTotal" inputmode="numeric">
      </div>
      
      <div class="form-group">
        <label for="finalPortfolioWeighted">Weighted 25%:</label>
        <input type="number" id="finalPortfolioWeighted" name="finalPortfolioWeighted" inputmode="numeric" readonly>
      </div>
    </div>

    <div id="finalExamForm" class="hidden">
      <h2>Final Exam Form</h2>
  
          <label for="finalExamScore">Score:</label>
          <input type="number" id="finalExamScore" name="finalExamScore" inputmode="numeric" oninput="consolidation()">
          <label for="finalExamQuestions">Number of Questions:</label>
          <input type="number" id="finalExamQuestions" name="finalExamQuestions" inputmode="numeric">
          <label for="finalExamWeighted">Weighted 20%:</label>
          <input type="number" id="finalExamWeighted" name="finalExamWeighted" inputmode="numeric" readonly>

    </div>


    <div id="midtermForm" class="hidden">
      <h2>Midterm Form</h2>
        <!-- Midterm form content -->
        <label for="midtermScore">Enter Midterm Score:</label>
        <input type="number" id="midtermScore" name="midtermScore" inputmode="numeric" oninput="consolidation()">
        <label for="midtermItems">Enter Number of Items:</label>
        <input type="number" id="midtermItems" name="midtermItems" inputmode="numeric">
        <label for="midtermWeighted">Weighted Percentage:</label>
        <input type="number" id="midtermWeighted" name="midtermWeighted" readonly>
        <!-- ... (other midterm form elements) -->
    </div>
  </div>


  <div id="labForm" class="hidden">
    <label for="examTypeLab">Select Exam Type:</label>
    <select id="examTypeLab">
      <option value="" disabled selected>Select your option</option>
      <option value="midterm">Midterm</option>
      <option value="finals">Finals</option>
    </select>

    <p id="selectedExamLab"></p>

    <br>

    <label for="examComponentLab">Select Exam Component:</label>
    <select id="examComponentLab">
      <!-- Options for Midterm -->
      <optgroup id="midtermOptionsLab" label="Midterm">
        <option value="" disabled selected>Select your option</option>
        <option value="labAttendance/labClassparticipation">Laboratory Attendance / ClassParticipation</option>
        <option value="labReports">Laboratory Reports</option>
        <option value="labPracticalExam">Practical Exam</option>
      </optgroup>

      <!-- Options for Finals -->
      <optgroup id="finalsOptionsLab" label="Finals">
        <option value="" disabled selected>Select your option</option>
        <option value="labFinalsReports">Laboratory Reports</option>
        <option value="labFinalsPracticalExam">Practical Exam</option>
      </optgroup>
    </select>

    <div id="labAttendanceForm" class="hidden">
      <h2>Lab Attendance Form</h2>
      <div class="form-group">
        <label for="user1Score">Score:</label>
        <input type="number" id="user1Score" name="user1Score" placeholder="Score" oninput="consolidation()">
    
        <label for="user1Total">Total:</label>
        <input type="number" id="user1Total" name="user1Total" placeholder="Total">
      </div>
    
      <div class="form-group">
        <label for="user1Weighted">Weighted 20%:</label>
        <input type="number" id="user1Weighted" name="user1Weighted" inputmode="numeric" readonly>
      </div>
    </div>

    <div id="labReportForm" class="hidden">
      <h2>Lab Reports Form</h2>
      <div class="form-group">
        <label for="labReportsLength">Number of Lab Reports:</label>
        <input type="number" id="labReportsLength" name="labReportsLength" inputmode="numeric">
      </div>

      <div id="labReportsScoreTotalContainer"></div>
    
      <div class="form-group">
        <label for="labReportsOverallScore">Overall Score:</label>
        <input type="number" id="labReportsOverallScore" name="labReportsOverallScore" inputmode="numeric" oninput="consolidation()">
    
        <label for="labReportsOverallTotal">Overall Total:</label>
        <input type="number" id="labReportsOverallTotal" name="labReportsOverallTotal" inputmode="numeric">
      </div>
    
      <div class="form-group">
        <label for="labReportsWeighted">Weighted 50%:</label>
        <input type="number" id="labReportsWeighted" name="labReportsWeighted" inputmode="numeric" readonly>
      </div>
    </div>

    <div id="labPracticalExamForm" class="hidden">
      <h2>Practical Exam Form</h2>
      
      <div class="form-group">
        <label for="labPracticalExamLength">Number of Practical Exams:</label>
        <input type="text" id="labPracticalExamLength" name="labPracticalExamLength" inputmode="numeric">
      </div>
      
      <div id="labPracticalExamScoreTotalContainer"></div>
    
      <div class="form-group">
        <label for="labPracticalExamOverallScore">Overall Score:</label>
        <input type="number" id="labPracticalExamOverallScore" name="labPracticalExamOverallScore" inputmode="numeric" oninput="consolidation()">
    
        <label for="labpracticalExamOverallTotal">Overall Total:</label>
        <input type="number" id="labPracticalExamOverallTotal" name="labPracticalExamOverallTotal" inputmode="numeric">
      </div>
    
      <div class="form-group">
        <label for="labPracticalExamWeighted">Weighted 30%:</label>
        <input type="number" id="labPracticalExamWeighted" name="labPracticalExamWeighted" inputmode="numeric" readonly>
      </div>
    </div>

    <div id="labFinalsReportsForm" class="hidden">
      <h2>Lab Finals Reports Form</h2>
  
      <div class="form-group">
          <label for="labFinalsReportsLength">Number of Lab Finals Reports:</label>
          <input type="number" id="labFinalsReportsLength" name="labFinalsReportsLength" inputmode="numeric">
      </div>
  
      <div id="labFinalsReportsScoreTotalContainer"></div>
  
      <div class="form-group">
          <label for="labFinalsReportsOverallScore">Overall Score:</label>
          <input type="number" id="labFinalsReportsOverallScore" name="labFinalsReportsOverallScore" inputmode="numeric" oninput="consolidation()">
  
          <label for="labFinalsReportsOverallTotal">Overall Total:</label>
          <input type="number" id="labFinalsReportsOverallTotal" name="labFinalsReportsOverallTotal" inputmode="numeric">
      </div>
  
      <div class="form-group">
          <label for="labFinalsReportsWeighted">Weighted 50%:</label>
          <input type="number" id="labFinalsReportsWeighted" name="labFinalsReportsWeighted" inputmode="numeric" readonly>
      </div>
    </div>

  <div id="labFinalsPracticalExamForm" class="hidden">
    <h2>Lab Finals Practical Exam Form</h2>

    <div class="form-group">
        <label for="labFinalsPracticalExamLength">Number of Lab Finals Practical Exams:</label>
        <input type="number" id="labFinalsPracticalExamLength" name="labFinalsPracticalExamLength" inputmode="numeric">
    </div>

    <div id="labFinalsPracticalExamScoreTotalContainer"></div>

    <div class="form-group">
        <label for="labFinalsPracticalExamOverallScore">Overall Score:</label>
        <input type="number" id="labFinalsPracticalExamOverallScore" name="labFinalsPracticalExamOverallScore" inputmode="numeric"oninput="consolidation()">

        <label for="labFinalsPracticalExamOverallTotal">Overall Total:</label>
        <input type="number" id="labFinalsPracticalExamOverallTotal" name="labFinalsPracticalExamOverallTotal" inputmode="numeric">
    </div>

    <div class="form-group">
        <label for="labFinalsPracticalExamWeighted">Weighted 30%:</label>
        <input type="number" id="labFinalsPracticalExamWeighted" name="labFinalsPracticalExamWeighted" inputmode="numeric" readonly>
    </div>
  </div>
  
</div>
<br>

</form>

</body>
</html>