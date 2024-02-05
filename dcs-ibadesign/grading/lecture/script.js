var examApp = {
    showSelectedSession: function () {
        var sessionDropdown = document.getElementById("sessionType");
        var selectedSession = sessionDropdown.options[sessionDropdown.selectedIndex].text;

        var lectureForm = document.getElementById("lectureForm");
        var labForm = document.getElementById("labForm");

        if (selectedSession === "Lecture") {
            lectureForm.style.display = "block";
            labForm.style.display = "none";
        } else if (selectedSession === "Lab") {
            lectureForm.style.display = "none";
            labForm.style.display = "block";
        }
    },

    showSelectedExam: function (type) {
        var examDropdown;
        var selectedExam;
        var selectedExamElement;

        if (type === "lecture") {
            examDropdown = document.getElementById("examType");
            selectedExamElement = document.getElementById("selectedExam");
        } else if (type === "lab") {
            examDropdown = document.getElementById("examTypeLab");
            selectedExamElement = document.getElementById("selectedExamLab");
        }

        selectedExam = examDropdown.options[examDropdown.selectedIndex].text;
        selectedExamElement.innerHTML = "You selected: " + selectedExam;

        // Update options for the third dropdown based on the selected exam
        examApp.updateThirdDropdownOptions(type, selectedExam);
    },

    updateThirdDropdownOptions: function (type, selectedExam) {
        var examComponentDropdown;

        if (type === "lecture") {
            examComponentDropdown = document.getElementById("examComponent");
        } else if (type === "lab") {
            examComponentDropdown = document.getElementById("examComponentLab");
        }

        var midtermOptions = ["attendance", "classParticipation", "quiz", "portfolio", "midtermExam"];
        var finalsOptions = ["classParticipationFinals", "quizFinals", "portfolioFinals", "finalsExam"];
      var optionsToDisplay = (selectedExam === "Midterm") ? midtermOptions : finalsOptions;

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
        examApp.showForm(type);
    },

    showSelectedExam: function (type) {
        var examDropdown;
        var selectedExam;
        var selectedExamElement;
    
        if (type === "lecture") {
          examDropdown = document.getElementById("examType");
          selectedExamElement = document.getElementById("selectedExam");
        } else if (type === "lab") {
          examDropdown = document.getElementById("examTypeLab");
          selectedExamElement = document.getElementById("selectedExamLab");
        }
    
        selectedExam = examDropdown.options[examDropdown.selectedIndex].text;
        selectedExamElement.innerHTML = "You selected: " + selectedExam;
    
        // Update options for the third dropdown based on the selected exam
        examApp.updateThirdDropdownOptions(type, selectedExam);
      },
    
      showForm: function (type) {
          var examComponentDropdown;
          var attendanceForm;
          var classParticipationForm;
          var classParticipationFormFinals;
          var quizForm;
          var finalQuizForm; // Adjusted this line
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
              finalQuizForm = document.getElementById("finalQuizForm"); // Adjusted this line
              portfolioForm = document.getElementById("portfolioForm");
              finalPortfolioForm = document.getElementById("finalPortfolioForm");
              midtermForm = document.getElementById("midtermForm");
              finalExamForm = document.getElementById("finalExamForm");
          } else if (type === "lab") {
              examComponentDropdown = document.getElementById("examComponentLab");
              // ... (other form assignments for lab)
          }
      
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
              finalQuizForm.style.display = "none"; // Adjusted this line
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
          if (type === "lecture") {
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
              } else if (selectedComponent === "quizFinals") { // Adjusted to match the value in the HTML
                  if (finalQuizForm) {
                      finalQuizForm.style.display = "block"; // Adjusted this line
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
          } else if (type === "lab") {
              // ... (other form display for lab)
          }
      },
      //Lecture Midterm Attendance
      handleAttendanceInput: function () {
        var attendanceScoreInput = document.getElementById("attendanceScore");
        var attendanceTotalInput = document.getElementById("attendanceTotal");
        var attendanceWeightedInput = document.getElementById("attendanceWeighted");
    
        attendanceScoreInput.addEventListener("input", function () {
          var attendanceScore = parseFloat(attendanceScoreInput.value);
          var attendanceTotal = parseFloat(attendanceTotalInput.value);
    
          if (!isNaN(attendanceScore) && !isNaN(attendanceTotal)) {
            var weightedPercentage = (attendanceScore / attendanceTotal) * 10;
            attendanceWeightedInput.value = weightedPercentage.toFixed(2);
          } else {
            attendanceWeightedInput.value = "";
          }
        });
    
        attendanceTotalInput.addEventListener("input", function () {
          var attendanceScore = parseFloat(attendanceScoreInput.value);
          var attendanceTotal = parseFloat(attendanceTotalInput.value);
    
          if (!isNaN(attendanceScore) && !isNaN(attendanceTotal)) {
            var weightedPercentage = (attendanceScore / attendanceTotal) * 10;
            attendanceWeightedInput.value = weightedPercentage.toFixed(2);
          } else {
            attendanceWeightedInput.value = "";
          }
        });
      },
      //Lecture Midterm Class Participation
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
    //Lecture Finals Class Participation
    handleClassParticipationInputFinals: function () {
      var classParticipationScoreInput = document.getElementById("classParticipationScoreFinals");
      var classParticipationTotalInput = document.getElementById("classParticipationTotalFinals");
      var classParticipationWeightedInput = document.getElementById("classParticipationWeightedFinals");
    
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
    //Lecture Midterm Quiz
    handleQuizLengthInput: function () {
      var quizLengthInput = document.getElementById("quizLength");
      var quizScoreTotalContainer = document.getElementById("quizScoreTotalContainer");
      var quizoverallScoreInput = document.getElementById("quizOverallScore");
      var quizoverallTotalInput = document.getElementById("quizOverallTotal");
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
    
            var scoreInput = document.createElement("input");
            scoreInput.setAttribute("type", "number");
            scoreInput.setAttribute("id", quizScoreId);
            scoreInput.setAttribute("name", quizScoreId);
            scoreInput.setAttribute("inputmode", "numeric");
    
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
    
            quizoverallScoreInput.value = !isNaN(overallScore) ? overallScore : 0;
            quizoverallTotalInput.value = !isNaN(overallTotal) ? overallTotal : 0;
    
            var weightedPercentage = (overallScore / overallTotal) * 15;
            quizWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
          }
        } else {
          quizScoreTotalContainer.style.display = "none";
          quizoverallScoreInput.value = 0;
          quizoverallTotalInput.value = 0;
          quizWeightedInput.value = 0;
        }
      });
    },
    //Lab Finals Quiz
    handleFinalQuizInput: function () {
      var finalQuizLengthInput = document.getElementById("finalQuizLength");
      var finalQuizScoreTotalContainer = document.getElementById("finalQuizScoreTotalContainer");
      var finalQuizOverallScoreInput = document.getElementById("finalQuizOverallScore");
      var finalQuizOverallTotalInput = document.getElementById("finalQuizOverallTotal");
      var finalQuizWeightedInput = document.getElementById("finalQuizWeighted");
    
      finalQuizLengthInput.addEventListener("input", function () {
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
    
            finalQuizOverallScoreInput.value = !isNaN(overallScore) ? overallScore : 0;
            finalQuizOverallTotalInput.value = !isNaN(overallTotal) ? overallTotal : 0;
    
            var weightedPercentage = (overallScore / overallTotal) * 15;
            finalQuizWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
          }
        } else {
          finalQuizScoreTotalContainer.style.display = "none";
          finalQuizOverallScoreInput.value = 0;
          finalQuizOverallTotalInput.value = 0;
          finalQuizWeightedInput.value = 0;
        }
      });
    },
      //Lab Midterm Portfolio
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

        //Lab finals portfolio
        handleFinalPortfolioInput: function () {
          var finalPortfolioLengthInput = document.getElementById("finalPortfolioLength");
          var finalPortfolioScoreTotalContainer = document.getElementById("finalPortfolioScoreTotalContainer");
          var finalPortfolioOverallScoreInput = document.getElementById("finalPortfolioOverallScore");
          var finalPortfolioOverallTotalInput = document.getElementById("finalPortfolioOverallTotal");
          var finalPortfolioWeightedInput = document.getElementById("finalPortfolioWeighted");
        
          finalPortfolioLengthInput.addEventListener("input", function () {
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
        
                finalPortfolioOverallScoreInput.value = !isNaN(overallScore) ? overallScore : 0;
                finalPortfolioOverallTotalInput.value = !isNaN(overallTotal) ? overallTotal : 0;
        
                var weightedPercentage = (overallScore / overallTotal) * 25;
                finalPortfolioWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
              }
            } else {
              finalPortfolioScoreTotalContainer.style.display = "none";
              finalPortfolioOverallScoreInput.value = 0;
              finalPortfolioOverallTotalInput.value = 0;
              finalPortfolioWeightedInput.value = 0;
            }
          });
        },
      //Lecture midterm Exam
        handleMidtermInput: function () {
          var midtermScoreInput = document.getElementById("midtermScore");
          var midtermItemsInput = document.getElementById("midtermItems");
          var midtermWeightedInput = document.getElementById("midtermWeighted");
        
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
        
              function updateWeightedPercentage() {
                var midtermScore = parseInt(midtermScoreInput.value);
                var midtermItems = parseInt(midtermItemsInput.value);
        
                if (!isNaN(midtermScore) && midtermScore >= 0 && !isNaN(midtermItems) && midtermItems > 0) {
                  var weightedPercentage = (midtermScore / midtermItems) * 20;
                  midtermWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
                } else {
                  midtermWeightedInput.value = "";
                }
              }
            } else {
              midtermForm.style.display = "none";
            }
          });
        },
    //lecture finals Exam
        handleFinalExamInput: function () {
          var finalExamScoreInput = document.getElementById("finalExamScore");
          var finalExamQuestionsInput = document.getElementById("finalExamQuestions");
          var finalExamWeightedInput = document.getElementById("finalExamWeighted");
          var finalExamForm = document.getElementById("finalExamForm");
          
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
          
              function updateWeightedPercentage() {
                var finalExamScore = parseInt(finalExamScoreInput.value);
                var finalExamQuestions = parseInt(finalExamQuestionsInput.value);
          
                if (!isNaN(finalExamScore) && finalExamScore >= 0 && !isNaN(finalExamQuestions) && finalExamQuestions > 0) {
                  var weightedPercentage = (finalExamScore / finalExamQuestions) * 20;
                  finalExamWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
                } else {
                  finalExamWeightedInput.value = "";
                }
              }
            } else {
              finalExamForm.style.display = "none";
            }
          });
        },
      
    };
    
  // Initial call to hide/show forms based on the default selection
  document.getElementById("sessionType").addEventListener("change", examApp.showSelectedSession);
  document.getElementById("examType").addEventListener("change", function () { examApp.showSelectedExam("lecture"); });
  document.getElementById("examTypeLab").addEventListener("change", function () { examApp.showSelectedExam("lab"); });
  document.getElementById("examComponent").addEventListener("change", function () { examApp.showForm("lecture"); });
  document.getElementById("examComponentLab").addEventListener("change", function () { examApp.showForm("lab"); });
  
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
  examApp.showSelectedSession();