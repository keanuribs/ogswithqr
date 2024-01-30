<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="script.js" defer></script>
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

<form>
  <label for="sessionType">Select Session Type:</label>
  <select id="sessionType">
    <option value="lecture">Lecture</option>
    <option value="lab">Lab</option>
  </select>

  <br>

  <div id="lectureForm" class="hidden">
    <label for="examType">Select Exam Type:</label>
    <select id="examType">
      <option value="midterm">Midterm</option>
      <option value="finals">Finals</option>
    </select>

    <p id="selectedExam"></p>

    <br>

    <label for="examComponent">Select Exam Component:</label>
    <select id="examComponent">
      <!-- Options for Midterm -->
      <optgroup id="midtermOptions" label="Midterm">
        <option value="attendance">Attendance</option>
        <option value="classParticipation">Class Participation</option>
        <option value="quiz">Quiz</option>
        <option value="portfolio">Portfolio</option>
        <option value="midtermExam">Midterm Exam</option>
      </optgroup>

      <!-- Options for Finals -->
      <optgroup id="finalsOptions" label="Finals">
        <option value="classParticipationFinals">Class Participation</option>
        <option value="quizFinals">Quiz</option>
        <option value="portfolioFinals">Portfolio</option>
        <option value="finalsExam">Finals Exam</option>
      </optgroup>
    </select>

    <div id="attendanceForm" class="hidden">
      <h2>Attendance Form</h2>

      <div class="form-group">
        <label for="studentName">Student Name:</label>
        <input type="text" id="studentName" name="studentName">

        <label for="studentNumber">Student Number:</label>
        <input type="text" id="studentNumber" name="studentNumber">
      </div>

      <div class="form-group">
        <label for="attendanceScore">Score:</label>
        <input type="number" id="attendanceScore" name="attendanceScore" inputmode="numeric">

        <label for="attendanceTotal">Total:</label>
        <input type="number" id="attendanceTotal" name="attendanceTotal" inputmode="numeric">
      </div>

      <div class="form-group">
        <label for="attendanceWeighted">Weighted 10%:</label>
        <input type="number" id="attendanceWeighted" name="attendanceWeighted" inputmode="numeric" readonly>
      </div>
    </div>

    <div id="classParticipationForm" class="hidden">
      <h2>Class Participation Form</h2>

      <div class="form-group">
        <label for="classParticipationScore">Score:</label>
        <input type="number" id="classParticipationScore" name="classParticipationScore" inputmode="numeric">

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
            <input type="number" id="quizOverallScore" name="quizOverallScore" inputmode="numeric" readonly>

    
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
            <input type="number" id="overallPortfolioScore" name="overallPortfolioScore" inputmode="numeric" readonly>

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
        <input type="number" id="classParticipationScoreFinals" name="classParticipationScoreFinals" inputmode="numeric">

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
        <input type="number" id="finalQuizOverallScore" name="finalQuizOverallScore" inputmode="numeric">
    
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
        <input type="number" id="finalPortfolioOverallScore" name="finalPortfolioOverallScore" inputmode="numeric">
        
        <label for="finalPortfolioOverallTotal">Overall Total:</label>
        <input type="number" id="finalPortfolioOverallTotal" name="finalPortfolioOverallTotal" inputmode="numeric">
      </div>
      
      <div class="form-group">
        <label for="finalPortfolioWeighted">Weighted 25%:</label>
        <input type="number" id="finalPortfolioWeighted" name="finalPortfolioWeighted" inputmode="numeric" readonly>
      </div>
    </div>

    <div id="finalExamForm" class="hidden">
      <h2>Last Part of the Lecture Final Exam Form</h2>
  
          <label for="finalExamScore">Score:</label>
          <input type="number" id="finalExamScore" name="finalExamScore" inputmode="numeric">
          <label for="finalExamQuestions">Number of Questions:</label>
          <input type="number" id="finalExamQuestions" name="finalExamQuestions" inputmode="numeric">
          <label for="finalExamWeighted">Weighted 20%:</label>
          <input type="number" id="finalExamWeighted" name="finalExamWeighted" inputmode="numeric" readonly>

    </div>


    <div id="midtermForm" class="hidden">
      <h2>Midterm Form</h2>
        <!-- Midterm form content -->
        <label for="midtermScore">Enter Midterm Score:</label>
        <input type="number" id="midtermScore" name="midtermScore" inputmode="numeric">
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
      <option value="midterm">Midterm</option>
      <option value="finals">Finals</option>
    </select>

    <p id="selectedExamLab"></p>

    <br>

    <label for="examComponentLab">Select Exam Component:</label>
    <select id="examComponentLab">
      <!-- Options for Midterm -->
      <optgroup id="midtermOptionsLab" label="Midterm">
        <option value="labAttendance/labClassparticipation">Laboratory Attendance / ClassParticipation</option>
        <option value="labReports">Laboratory Reports</option>
        <option value="labPracticalExam">Practical Exam</option>
      </optgroup>

      <!-- Options for Finals -->
      <optgroup id="finalsOptionsLab" label="Finals">
        <option value="labFinalsReports">Laboratory Reports</option>
        <option value="labFinalsPracticalExam">Practical Exam</option>
      </optgroup>
    </select>

    <div id="labAttendanceForm" class="hidden">
      <h2>Lab Attendance Form</h2>
      <div class="form-group">
        <label for="user1Name">Name:</label>
        <input type="text" id="user1Name" name="user1Name" placeholder="User 1 Name">
    
        <label for="user1StudentNumber">Student Number:</label>
        <input type="text" id="user1StudentNumber" name="user1StudentNumber" placeholder="User 1 Student Number">
      </div>
    
      <div class="form-group">
        <label for="user1Score">Score:</label>
        <input type="number" id="user1Score" name="user1Score" placeholder="Score">
    
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
        <input type="number" id="labReportsOverallScore" name="labReportsOverallScore" inputmode="numeric">
    
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
        <input type="number" id="labPracticalExamOverallScore" name="labPracticalExamOverallScore" inputmode="numeric">
    
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
          <input type="number" id="labFinalsReportsOverallScore" name="labFinalsReportsOverallScore" inputmode="numeric">
  
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
        <input type="number" id="labFinalsPracticalExamOverallScore" name="labFinalsPracticalExamOverallScore" inputmode="numeric">

        <label for="labFinalsPracticalExamOverallTotal">Overall Total:</label>
        <input type="number" id="labFinalsPracticalExamOverallTotal" name="labFinalsPracticalExamOverallTotal" inputmode="numeric">
    </div>

    <div class="form-group">
        <label for="labFinalsPracticalExamWeighted">Weighted 30%:</label>
        <input type="number" id="labFinalsPracticalExamWeighted" name="labFinalsPracticalExamWeighted" inputmode="numeric" readonly>
    </div>
  </div>
  
</div>

  <div>
    <button type="submit">Submit</button>
  </div>

</form>

</body>
</html>