//all of grades to be computed in Consolidation
var grades = {
  Attendance: 0,
  ClassParticipation: 0,
  Quiz: 0,
  Portfolio: 0,
  Midterm: 0,
  FinalExam: 0,
}


var examApp = {
    //(returning value)this one handle the user input of lecture midterm attendance form and compute it based on the user input of score and total
    handleAttendanceInput: function () {
      var attendanceScoreInput = document.getElementById("attendanceScore");
      var attendanceTotalInput = document.getElementById("attendanceTotal");
      var attendanceWeightedInput = document.getElementById("attendanceWeighted");
      var weightedPercentage=0;
  
      attendanceScoreInput.addEventListener("input", function () {
        calculateAttendance();
      });
  
      //this one handle the user input of every forms and compute it based on the user input of score and total
      attendanceTotalInput.addEventListener("input", function () {
        calculateAttendance();
      });
      function calculateAttendance(){
        var attendanceScore = parseFloat(attendanceScoreInput.value);
        var attendanceTotal = parseFloat(attendanceTotalInput.value);
  
        if (!isNaN(attendanceScore) && !isNaN(attendanceTotal)) {
          weightedPercentage = (attendanceScore / attendanceTotal) * 10;
          attendanceWeightedInput.value = weightedPercentage.toFixed(2);
        } else {
          attendanceWeightedInput.value = "";
        }
  
        //Transfers the weighted grade to grades object
        grades.Attendance=weightedPercentage;
        return weightedPercentage;
      }
      return calculateAttendance();
    },
    //this one handle the user input of lecture midterm class participation forms and compute it based on the user input of score and total
  handleClassParticipationInput: function () {
    var classParticipationScoreInput = document.getElementById("classParticipationScore");
    var classParticipationTotalInput = document.getElementById("classParticipationTotal");
    var classParticipationWeightedInput = document.getElementById("classParticipationWeighted");

    classParticipationScoreInput.addEventListener("input", function () {
        calculateClassParticipationWeighted();
    });

    classParticipationTotalInput.addEventListener("input", function () {
        calculateClassParticipationWeighted();
    });

    function calculateClassParticipationWeighted() {
        var classParticipationScore = parseFloat(classParticipationScoreInput.value);
        var classParticipationTotal = parseFloat(classParticipationTotalInput.value);

        if (!isNaN(classParticipationScore) && !isNaN(classParticipationTotal)) {
            var weightedPercentage = (classParticipationScore / classParticipationTotal) * 10;
            classParticipationWeightedInput.value = weightedPercentage.toFixed(2);
        } else {
            classParticipationWeightedInput.value = "";
        }
    }
  },
  //(returning value)this one handle the user input of every forms and compute it based on the user input of score and total
  handleClassParticipationInputFinals: function () {
    var classParticipationScoreInputM = document.getElementById("classParticipationScore");
    var classParticipationTotalInputM = document.getElementById("classParticipationTotal");
    var classParticipationScoreInputF = document.getElementById("classParticipationScoreFinals");
    var classParticipationTotalInputF = document.getElementById("classParticipationTotalFinals");
    var classParticipationWeightedInput = document.getElementById("classParticipationWeightedFinals");
    var weightedPercentage = 0;

    classParticipationScoreInputF.addEventListener("input", function () {
      calculateClassParticipationWeighted();
    });

    classParticipationTotalInputF.addEventListener("input", function () {
      calculateClassParticipationWeighted();
    });

    function calculateClassParticipationWeighted() {
      //add the midterm score and total and finals score and total
      var classParticipationScore = parseFloat(classParticipationScoreInputF.value)+parseFloat(classParticipationScoreInputM.value);
      var classParticipationTotal = parseFloat(classParticipationTotalInputF.value)+parseFloat(classParticipationTotalInputM.value);
      
      if (!isNaN(classParticipationScore) && !isNaN(classParticipationTotal)) {
        weightedPercentage = (classParticipationScore / classParticipationTotal) * 10;
        classParticipationWeightedInput.value = weightedPercentage.toFixed(2);
      } else {
        classParticipationWeightedInput.value = "";
      }

      //Transfers the weighted grade to grades object
      grades.ClassParticipation=weightedPercentage;
      return weightedPercentage;
    }
    return calculateClassParticipationWeighted();
  },

  //this one handle the user input of lecture midterm quiz forms and compute it based on the user input of score and total
  handleQuizLengthInput: function () {
    var quizLengthInput = document.getElementById("quizLength");
    var quizScoreTotalContainer = document.getElementById("quizScoreTotalContainer");
    var overallScoreInput = document.getElementById("quizOverallScore");
    var overallTotalInput = document.getElementById("quizOverallTotal");
    var quizWeightedInput = document.getElementById("quizWeighted");
    var examDropdown = document.getElementById("examType");

    quizLengthInput.addEventListener("input", function () {
      var quizLength = parseInt(quizLengthInput.value);

      var selectedExam = examDropdown.options[examDropdown.selectedIndex].text;

      if (selectedExam === "Midterm" && !isNaN(quizLength) && quizLength > 0) {
        quizScoreTotalContainer.innerHTML = ""; // Clear previous fields

        var overallScore = 0;
        var overallTotal = 0;

        for (var i = 1; i <= quizLength; i++) {
          var quizScoreId = "quizScore" + i;
          var quizTotalId = "quizTotal" + i;

          var scoreLabel = document.createElement("label");
          scoreLabel.setAttribute("for", quizScoreId);
          scoreLabel.textContent = "Quiz " + i + " Score:";

          var scoreInput = document.createElement("input" );
          scoreInput.setAttribute("type", "number");
          scoreInput.setAttribute("id", quizScoreId);
          scoreInput.setAttribute("name", quizScoreId);
          scoreInput.setAttribute("inputmode", "numeric");
          scoreInput.setAttribute("oninput", "consolidation()"); 

          var totalLabel = document.createElement("label");
          totalLabel.setAttribute("for", quizTotalId);
          totalLabel.textContent = "Total " + i + ":";

          var totalInput = document.createElement("input");
          totalInput.setAttribute("type", "number");
          totalInput.setAttribute("id", quizTotalId);
          totalInput.setAttribute("name", quizTotalId);
          totalInput.setAttribute("inputmode", "numeric");

          // Add an event listener for each input field
          scoreInput.addEventListener("input", updateOverall);
          totalInput.addEventListener("input", updateOverall);

          quizScoreTotalContainer.appendChild(scoreLabel);
          quizScoreTotalContainer.appendChild(scoreInput);
          quizScoreTotalContainer.appendChild(totalLabel);
          quizScoreTotalContainer.appendChild(totalInput);
        }

        quizScoreTotalContainer.style.display = "flex";

        function updateOverall() {
          overallScore = 0;
          overallTotal = 0;

          for (var j = 1; j <= quizLength; j++) {
            var scoreInputId = "quizScore" + j;
            var totalInputId = "quizTotal" + j;

            var scoreInput = document.getElementById(scoreInputId);
            var totalInput = document.getElementById(totalInputId);

            var scoreInputValue = parseFloat(scoreInput.value) || 0;
            var totalInputValue = parseFloat(totalInput.value) || 0;

            overallScore += scoreInputValue;
            overallTotal += totalInputValue;
          }

          overallScoreInput.value = !isNaN(overallScore) ? overallScore : 0;
          overallTotalInput.value = !isNaN(overallTotal) ? overallTotal : 0;

          var weightedPercentage = (overallScore / overallTotal) * 15;
          quizWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
        }
      } else {
        quizScoreTotalContainer.style.display = "none";
        overallScoreInput.value = 0;
        overallTotalInput.value = 0;
        quizWeightedInput.value = 0;
      }
    });
  },

  //(returning value)this one handle the user input of lecture finals quiz forms and compute it based on the user input of score and total
  handleFinalQuizInput: function () {
    var finalQuizLengthInput = document.getElementById("finalQuizLength");
    var finalQuizScoreTotalContainer = document.getElementById("finalQuizScoreTotalContainer");
    var midtermoverallScoreInput = document.getElementById("quizOverallScore");
    var midetermoverallTotalInput = document.getElementById("quizOverallTotal");
    var finalQuizOverallScoreInput = document.getElementById("finalQuizOverallScore");
    var finalQuizOverallTotalInput = document.getElementById("finalQuizOverallTotal");
    var finalQuizWeightedInput = document.getElementById("finalQuizWeighted");
    var weightedPercentage = 0;

    finalQuizLengthInput.addEventListener("input", function () {
      calculateFinalQuiz();
    });
    function calculateFinalQuiz(){
      var finalQuizLength = parseInt(finalQuizLengthInput.value);

      if (!isNaN(finalQuizLength) && finalQuizLength > 0) {
        finalQuizScoreTotalContainer.innerHTML = ""; // Clear previous fields

        var overallScore = 0;
        var overallTotal = 0;

        for (var i = 1; i <= finalQuizLength; i++) {
          var finalQuizScoreId = "finalQuizScore" + i;
          var finalQuizTotalId = "finalQuizTotal" + i;

          var scoreLabel = document.createElement("label");
          scoreLabel.setAttribute("for", finalQuizScoreId);
          scoreLabel.textContent = "Final Quiz " + i + " Score:";

          var scoreInput = document.createElement("input");
          scoreInput.setAttribute("type", "number");
          scoreInput.setAttribute("id", finalQuizScoreId);
          scoreInput.setAttribute("name", finalQuizScoreId);
          scoreInput.setAttribute("inputmode", "numeric");
          scoreInput.setAttribute("oninput", "consolidation()"); 

          var totalLabel = document.createElement("label");
          totalLabel.setAttribute("for", finalQuizTotalId);
          totalLabel.textContent = "Total " + i + ":";

          var totalInput = document.createElement("input");
          totalInput.setAttribute("type", "number");
          totalInput.setAttribute("id", finalQuizTotalId);
          totalInput.setAttribute("name", finalQuizTotalId);
          totalInput.setAttribute("inputmode", "numeric");

          // Add an event listener for each input field
          scoreInput.addEventListener("input", updateOverall);
          totalInput.addEventListener("input", updateOverall);

          finalQuizScoreTotalContainer.appendChild(scoreLabel);
          finalQuizScoreTotalContainer.appendChild(scoreInput);
          finalQuizScoreTotalContainer.appendChild(totalLabel);
          finalQuizScoreTotalContainer.appendChild(totalInput);
        }

        finalQuizScoreTotalContainer.style.display = "flex";

        updateOverall();
        
      } else {
        finalQuizScoreTotalContainer.style.display = "none";
        finalQuizOverallScoreInput.value = 0;
        finalQuizOverallTotalInput.value = 0;
        finalQuizWeightedInput.value = 0;
      }

      function updateOverall() {
        overallScore = 0;
        overallTotal = 0;

        for (var j = 1; j <= finalQuizLength; j++) {
          var scoreInputId = "finalQuizScore" + j;
          var totalInputId = "finalQuizTotal" + j;

          var scoreInput = document.getElementById(scoreInputId);
          var totalInput = document.getElementById(totalInputId);

          var scoreInputValue = parseFloat(scoreInput.value) || 0;
          var totalInputValue = parseFloat(totalInput.value) || 0;

          overallScore += scoreInputValue;
          overallTotal += totalInputValue;
        }

        //add midterm score and total and finals score and total
        var finaloverallScore=overallScore+parseFloat(midtermoverallScoreInput.value);
        var finaloverallTotal=overallTotal+parseFloat(midetermoverallTotalInput.value);

        finalQuizOverallScoreInput.value = !isNaN(finaloverallScore) ? finaloverallScore : 0;
        finalQuizOverallTotalInput.value = !isNaN(finaloverallTotal) ? finaloverallTotal : 0;

        
        weightedPercentage = (finaloverallScore / finaloverallTotal) * 15;
        finalQuizWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
        
        //Transfers the weighted grade to grades object
        grades.Quiz=weightedPercentage;
        return weightedPercentage;
      }
      return updateOverall();
    }
    return calculateFinalQuiz();
  },

  //this one handle the user input of lecture midterm portfolio forms and compute it based on the user input of score and total
  handlePortfolioLengthInput: function () {
      var portfolioLengthInput = document.getElementById("portfolioLength");
      var portfolioScoreTotalContainer = document.getElementById("portfolioScoreTotalContainer");
      var overallScoreInput = document.getElementById("overallPortfolioScore");
      var overallTotalInput = document.getElementById("overallPortfolioTotal");
      var portfolioWeightedInput = document.getElementById("portfolioWeighted");
      var examDropdown = document.getElementById("examType");
    
      portfolioLengthInput.addEventListener("input", function () {
        var portfolioLength = parseInt(portfolioLengthInput.value);
    
        var selectedExam = examDropdown.options[examDropdown.selectedIndex].text;
    
        if (selectedExam === "Midterm" && !isNaN(portfolioLength) && portfolioLength > 0) {
          portfolioScoreTotalContainer.innerHTML = ""; // Clear previous fields
    
          var overallScore = 0;
          var overallTotal = 0;
    
          for (var i = 1; i <= portfolioLength; i++) {
            var portfolioScoreId = "portfolioScore" + i;
            var portfolioTotalId = "portfolioTotal" + i;
    
            var scoreLabel = document.createElement("label");
            scoreLabel.setAttribute("for", portfolioScoreId);
            scoreLabel.textContent = "Portfolio " + i + " Score:";
    
            var scoreInput = document.createElement("input");
            scoreInput.setAttribute("type", "number");
            scoreInput.setAttribute("id", portfolioScoreId);
            scoreInput.setAttribute("name", portfolioScoreId);
            scoreInput.setAttribute("inputmode", "numeric");
            scoreInput.setAttribute("oninput", "consolidation()"); 
    
            var totalLabel = document.createElement("label");
            totalLabel.setAttribute("for", portfolioTotalId);
            totalLabel.textContent = "Total " + i + ":";
    
            var totalInput = document.createElement("input");
            totalInput.setAttribute("type", "number");
            totalInput.setAttribute("id", portfolioTotalId);
            totalInput.setAttribute("name", portfolioTotalId);
            totalInput.setAttribute("inputmode", "numeric");
    
            // Add an event listener for each input field
            scoreInput.addEventListener("input", updateOverall);
            totalInput.addEventListener("input", updateOverall);
    
            portfolioScoreTotalContainer.appendChild(scoreLabel);
            portfolioScoreTotalContainer.appendChild(scoreInput);
            portfolioScoreTotalContainer.appendChild(totalLabel);
            portfolioScoreTotalContainer.appendChild(totalInput);
          }
    
          portfolioScoreTotalContainer.style.display = "flex";
    
          function updateOverall() {
            overallScore = 0;
            overallTotal = 0;
    
            for (var j = 1; j <= portfolioLength; j++) {
              var scoreInputId = "portfolioScore" + j;
              var totalInputId = "portfolioTotal" + j;
    
              var scoreInput = document.getElementById(scoreInputId);
              var totalInput = document.getElementById(totalInputId);
    
              var scoreInputValue = parseFloat(scoreInput.value) || 0;
              var totalInputValue = parseFloat(totalInput.value) || 0;
    
              overallScore += scoreInputValue;
              overallTotal += totalInputValue;
            }
    
            overallScoreInput.value = !isNaN(overallScore) ? overallScore : 0;
            overallTotalInput.value = !isNaN(overallTotal) ? overallTotal : 0;
    
            var weightedPercentage = (overallScore / overallTotal) * 25;
            portfolioWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
          }
        } else {
          portfolioScoreTotalContainer.style.display = "none";
          overallScoreInput.value = 0;
          overallTotalInput.value = 0;
          portfolioWeightedInput.value = 0;
        }
      });
  },
   
  //(returning value)this one handle the user input of finals lecture portfolio forms and compute it based on the user input of score and total
  handleFinalPortfolioInput: function () {
      var finalPortfolioLengthInput = document.getElementById("finalPortfolioLength");
      var finalPortfolioScoreTotalContainer = document.getElementById("finalPortfolioScoreTotalContainer");
      var overallScoreInput = document.getElementById("overallPortfolioScore");
      var overallTotalInput = document.getElementById("overallPortfolioTotal");
      var finalPortfolioOverallScoreInput = document.getElementById("finalPortfolioOverallScore");
      var finalPortfolioOverallTotalInput = document.getElementById("finalPortfolioOverallTotal");
      var finalPortfolioWeightedInput = document.getElementById("finalPortfolioWeighted");
      var weightedPercentage = 0;

      finalPortfolioLengthInput.addEventListener("input", function () {
        calculateFinalPortfolio();
      });
      function calculateFinalPortfolio(){
        var finalPortfolioLength = parseInt(finalPortfolioLengthInput.value);
    
        if (!isNaN(finalPortfolioLength) && finalPortfolioLength > 0) {
          finalPortfolioScoreTotalContainer.innerHTML = ""; // Clear previous fields
    
          var overallScore = 0;
          var overallTotal = 0;
    
          for (var i = 1; i <= finalPortfolioLength; i++) {
            var finalPortfolioScoreId = "finalPortfolioScore" + i;
            var finalPortfolioTotalId = "finalPortfolioTotal" + i;
    
            var scoreLabel = document.createElement("label");
            scoreLabel.setAttribute("for", finalPortfolioScoreId);
            scoreLabel.textContent = "Final Portfolio " + i + " Score:";
    
            var scoreInput = document.createElement("input");
            scoreInput.setAttribute("type", "number");
            scoreInput.setAttribute("id", finalPortfolioScoreId);
            scoreInput.setAttribute("name", finalPortfolioScoreId);
            scoreInput.setAttribute("inputmode", "numeric");
            scoreInput.setAttribute("oninput", "consolidation()"); 
    
            var totalLabel = document.createElement("label");
            totalLabel.setAttribute("for", finalPortfolioTotalId);
            totalLabel.textContent = "Total " + i + ":";
    
            var totalInput = document.createElement("input");
            totalInput.setAttribute("type", "number");
            totalInput.setAttribute("id", finalPortfolioTotalId);
            totalInput.setAttribute("name", finalPortfolioTotalId);
            totalInput.setAttribute("inputmode", "numeric");
    
            // Add an event listener for each input field
            scoreInput.addEventListener("input", updateOverall);
            totalInput.addEventListener("input", updateOverall);
    
            finalPortfolioScoreTotalContainer.appendChild(scoreLabel);
            finalPortfolioScoreTotalContainer.appendChild(scoreInput);
            finalPortfolioScoreTotalContainer.appendChild(totalLabel);
            finalPortfolioScoreTotalContainer.appendChild(totalInput);
          }
    
          finalPortfolioScoreTotalContainer.style.display = "flex";
          
          updateOverall();

        } else {
          finalPortfolioScoreTotalContainer.style.display = "none";
          finalPortfolioOverallScoreInput.value = 0;
          finalPortfolioOverallTotalInput.value = 0;
          finalPortfolioWeightedInput.value = 0;
        }

        function updateOverall() {
          overallScore = 0;
          overallTotal = 0;
  
          for (var j = 1; j <= finalPortfolioLength; j++) {
            var scoreInputId = "finalPortfolioScore" + j;
            var totalInputId = "finalPortfolioTotal" + j;
  
            var scoreInput = document.getElementById(scoreInputId);
            var totalInput = document.getElementById(totalInputId);
  
            var scoreInputValue = parseFloat(scoreInput.value) || 0;
            var totalInputValue = parseFloat(totalInput.value) || 0;
  
            overallScore += scoreInputValue;
            overallTotal += totalInputValue;
          }
          
          //add midterm score and total and final score and total
          var finaloverallScore = overallScore + parseFloat(overallScoreInput.value);
          var finaloverallTotal = overallTotal + parseFloat(overallTotalInput.value);
          weightedPercentage = (finaloverallScore / finaloverallTotal) * 25;
          
          finalPortfolioOverallScoreInput.value = !isNaN(finaloverallScore) ? finaloverallScore : 0;
          finalPortfolioOverallTotalInput.value = !isNaN(finaloverallTotal) ? finaloverallTotal : 0;
          finalPortfolioWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
          
          //Transfers the weighted grade to grades object
          grades.Portfolio=weightedPercentage;
          return weightedPercentage;
        }
        
        return updateOverall();
      }
      return calculateFinalPortfolio();
  },

  //(returning value)this one handle the user input of lecture midterm midterm exam forms and compute it based on the user input of score and total    
  handleMidtermInput: function () {
      var midtermScoreInput = document.getElementById("midtermScore");
      var midtermItemsInput = document.getElementById("midtermItems");
      var midtermWeightedInput = document.getElementById("midtermWeighted");
      var weightedPercentage = 0;    
      
      var midtermForm = document.getElementById("midtermForm");
    
      document.getElementById("examComponent").addEventListener("change", function () {
        var selectedComponent = this.value;
    
        if (selectedComponent === "midtermExam") {
          midtermForm.style.display = "block";
    
          midtermScoreInput.addEventListener("input", function () {
            updateWeightedPercentage();
          });
    
          midtermItemsInput.addEventListener("input", function () {
            updateWeightedPercentage();
          });
        } else {
          midtermForm.style.display = "none";
        }
      });
      function updateWeightedPercentage() {
        var midtermScore = parseInt(midtermScoreInput.value);
        var midtermItems = parseInt(midtermItemsInput.value);

        if (!isNaN(midtermScore) && midtermScore >= 0 && !isNaN(midtermItems) && midtermItems > 0) {
          weightedPercentage = (midtermScore / midtermItems) * 20;
          midtermWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
        } else {
          midtermWeightedInput.value = "";
        }

        //Transfers the weighted grade to grades object
        grades.Midterm=weightedPercentage;
        return weightedPercentage;
      }
      return updateWeightedPercentage();
  },

  //(returning value)this one handle the user input of lecture finals finalexam forms and compute it based on the user input of score and total
  handleFinalExamInput: function () {
      var finalExamScoreInput = document.getElementById("finalExamScore");
      var finalExamQuestionsInput = document.getElementById("finalExamQuestions");
      var finalExamWeightedInput = document.getElementById("finalExamWeighted");
      var finalExamForm = document.getElementById("finalExamForm");
      var weightedPercentage = 0;
      
      document.getElementById("examComponent").addEventListener("change", function () {
        var selectedComponent = this.value;
      
        if (selectedComponent === "finalsExam") {
          finalExamForm.style.display = "block";
      
          finalExamScoreInput.addEventListener("input", function () {
            updateWeightedPercentage();
          });
      
          finalExamQuestionsInput.addEventListener("input", function () {
            updateWeightedPercentage();
          });
        } else {
          finalExamForm.style.display = "none";
        }
      });

      function updateWeightedPercentage() {
        var finalExamScore = parseInt(finalExamScoreInput.value);
        var finalExamQuestions = parseInt(finalExamQuestionsInput.value);
  
        if (!isNaN(finalExamScore) && finalExamScore >= 0 && !isNaN(finalExamQuestions) && finalExamQuestions > 0) {
          weightedPercentage = (finalExamScore / finalExamQuestions) * 20;
          finalExamWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
        } else {
          finalExamWeightedInput.value = "";
        }

        //Transfers the weighted grade to grades object
        grades.FinalExam=weightedPercentage;
        return weightedPercentage;
      }

      return updateWeightedPercentage();
  },
};


function consolidation() {
  // Check if the selected exam type is midterm and the grade component is attendance
  var examType = document.getElementById('examType').value;
  var examComponent = document.getElementById('examComponent').value;

// Display the alert at the top of the form
displayAlert('The final Grade and Consolidation is successfully computed and outputed. Please go back to the exam type: midterm, Grade Component: Attendance to view the final grade and Consolidated');

  // Total and Weighted Lecture
  var finalgrade =
    parseFloat(grades.Attendance) +
    parseFloat(grades.ClassParticipation) +
    parseFloat(grades.Quiz) +
    parseFloat(grades.Portfolio) +
    parseFloat(grades.Midterm) +
    parseFloat(grades.FinalExam);

  // Final Grade and consolidated
  var consolidated = 0;

  // Computing for consolidated
  if (finalgrade <= 49.99) {
    consolidated = 5.0;
  } else if (finalgrade >= 50.0 && finalgrade <= 69.9) {
    consolidated = 4.0;
  } else if (finalgrade >= 70.0 && finalgrade <= 73.3) {
    consolidated = 3.0;
  } else if (finalgrade >= 73.4 && finalgrade <= 76.6) {
    consolidated = 2.75;
  } else if (finalgrade >= 76.7 && finalgrade <= 80.0) {
    consolidated = 2.50;
  } else if (finalgrade >= 80.1 && finalgrade <= 83.3) {
    consolidated = 2.25;
  } else if (finalgrade >= 83.4 && finalgrade <= 86.6) {
    consolidated = 2.0;
  } else if (finalgrade >= 86.7 && finalgrade <= 90.0) {
    consolidated = 1.75;
  } else if (finalgrade >= 90.1 && finalgrade <= 93.3) {
    consolidated = 1.5;
  } else if (finalgrade >= 93.4 && finalgrade <= 96.6) {
    consolidated = 1.25;
  } else if (finalgrade >= 96.7 && finalgrade <= 100) {
    consolidated = 1.0;
  }

  // Set the values in the respective input fields
  document.getElementById('finalgrade').value = finalgrade.toFixed(2);
  document.getElementById('consolidated').value = consolidated.toFixed(2);
}
function displayAlert(message) {
  var alertContainer = document.getElementById('alertContainer');
  alertContainer.innerHTML = '<strong>' + message + '</strong>';
  alertContainer.style.display = 'block';

  // Hide the alert after a few seconds (adjust the timeout as needed)
  setTimeout(function () {
    alertContainer.style.display = 'none';
  }, 3000); // 3000 milliseconds (3 seconds)
}

function showSelectedSession () {
  var sessionDropdown = document.getElementById("sessionType");
  var selectedSession = sessionDropdown.options[sessionDropdown.selectedIndex].text;

  var lectureForm = document.getElementById("lectureForm");
  var labForm = document.getElementById("labForm");

  if (selectedSession === "Lecture") {
    lectureForm.style.display = "block";
  } 
  }

//for selected first dropdown lecture or lab
function showSelectedExam (type) {
  var examDropdown;
  var selectedExam;
  var selectedExamElement;

  if (type === "lecture") {
    examDropdown = document.getElementById("examType");
    selectedExamElement = document.getElementById("selectedExam");
  } else if (type === "lab") {
    examDropdown = document.getElementById("examTypeLab");
    selectedExamElement = document.getElementById("selectedExamLab");

    // Display the second dropdown for lab exams
    var labExamTypeDropdown = document.getElementById("examTypeLab");
    labExamTypeDropdown.style.display = "block";
  }

  selectedExam = examDropdown.options[examDropdown.selectedIndex].text;
  selectedExamElement.innerHTML = "You selected: " + selectedExam;

  // Update options for the third dropdown based on the selected exam
  updateThirdDropdownOptions(type, selectedExam);
}

//third dropdown shows the forms after choose the lab or lecture then midterm and finals
function updateThirdDropdownOptions (type, selectedExam) {
  var examComponentDropdown;

  if (type === "lecture") {
    examComponentDropdown = document.getElementById("examComponent");
  } else if (type === "lab") {
    examComponentDropdown = document.getElementById("examComponentLab");
  }

  var optionsToDisplay;

  if (type === "lecture") {
    optionsToDisplay = (selectedExam === "Midterm") ?
      ["attendance", "classParticipation", "quiz", "portfolio", "midtermExam"] :
      ["classParticipationFinals", "quizFinals", "portfolioFinals", "finalsExam"];
  }

  // Clear existing options
  examComponentDropdown.innerHTML = "";

  // Add new options
  for (var i = 0; i < optionsToDisplay.length; i++) {
    var option = document.createElement("option");
    option.value = optionsToDisplay[i];
    option.text = optionsToDisplay[i];
    examComponentDropdown.add(option);
  }

  // Show the first option by default
  examComponentDropdown.selectedIndex = 0;

  // Trigger the onchange event to update the form based on the default selection
  showForm(type);
}

//displaying and hinding  the functions of dropdown and forms 
function showForm (type) {
  var examComponentDropdown;
  var attendanceForm = document.getElementById('attendanceForm');
  attendanceForm.classList.remove('hidden');
  var classParticipationForm;
  var classParticipationFormFinals;
  var quizForm;
  var finalQuizForm;
  var finalPortfolioForm;
  var portfolioForm;
  var midtermForm;
  var finalExamForm;


  if (type === "lecture") {
    examComponentDropdown = document.getElementById("examComponent");
    attendanceForm = document.getElementById("attendanceForm");
    classParticipationForm = document.getElementById("classParticipationForm");
    classParticipationFormFinals = document.getElementById("classParticipationFormFinals");
    quizForm = document.getElementById("quizForm");
    finalQuizForm = document.getElementById("finalQuizForm");
    portfolioForm = document.getElementById("portfolioForm");
    finalPortfolioForm = document.getElementById("finalPortfolioForm");
    midtermForm = document.getElementById("midtermForm");
    finalExamForm = document.getElementById("finalExamForm");

    var selectedComponent = examComponentDropdown.options[examComponentDropdown.selectedIndex].value;

    // Hide all forms initially
    if (attendanceForm) {
      attendanceForm.style.display = "none";
    }
    if (classParticipationForm) {
      classParticipationForm.style.display = "none";
    }
    if (classParticipationFormFinals) {
      classParticipationFormFinals.style.display = "none";
    }
    if (quizForm) {
      quizForm.style.display = "none";
    }
    if (finalQuizForm) {
      finalQuizForm.style.display = "none";
    }
    if (portfolioForm) {
      portfolioForm.style.display = "none";
    }
    if (finalPortfolioForm) {
      finalPortfolioForm.style.display = "none";
    }
    if (midtermForm) {
      midtermForm.style.display = "none";
    }
    if (finalExamForm) {
      finalExamForm.style.display = "none";
    }

    // Show the selected form
    if (selectedComponent === "attendance") {
      if (attendanceForm) {
        attendanceForm.style.display = "block";
      }
    } else if (selectedComponent === "classParticipation") {
      if (classParticipationForm) {
        classParticipationForm.style.display = "block";
      }
    } else if (selectedComponent === "classParticipationFinals") {
      if (classParticipationFormFinals) {
        classParticipationFormFinals.style.display = "block";
      }
    } else if (selectedComponent === "quiz") {
      if (quizForm) {
        quizForm.style.display = "block";
      }
    } else if (selectedComponent === "quizFinals") {
      if (finalQuizForm) {
        finalQuizForm.style.display = "block";
      }
    } else if (selectedComponent === "portfolio") {
      if (portfolioForm) {
        portfolioForm.style.display = "block";
      }
    } else if (selectedComponent === "portfolioFinals") {
      if (finalPortfolioForm) {
        finalPortfolioForm.style.display = "block";
      }
    } else if (selectedComponent === "midtermExam") {
      if (midtermForm) {
        midtermForm.style.display = "block";
      }
    } else if (selectedComponent === "finalsExam") {
      if (finalExamForm) {
        finalExamForm.style.display = "block";
      }
    }
  }
}
// Initial call to hide/show forms based on the default selection
document.getElementById("sessionType").addEventListener("change", function(){showSelectedSession();});
document.getElementById("examType").addEventListener("change", function(){showSelectedExam("lecture");});
document.getElementById("examComponent").addEventListener("change", function(){showForm("lecture");});

// Additional calls to handle quiz, portfolio, and midterm input dynamically
examApp.handleAttendanceInput();
examApp.handleClassParticipationInput();
examApp.handleClassParticipationInputFinals();
examApp.handleQuizLengthInput();
examApp.handleFinalQuizInput();
examApp.handlePortfolioLengthInput();
examApp.handleFinalPortfolioInput();
examApp.handleMidtermInput();
examApp.handleFinalExamInput();

// Initial call to hide/show forms based on the default selection
showSelectedSession();