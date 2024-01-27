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

      // Display the second dropdown for lab exams
      var labExamTypeDropdown = document.getElementById("examTypeLab");
      labExamTypeDropdown.style.display = "block";
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

    var optionsToDisplay;

    if (type === "lecture") {
      optionsToDisplay = (selectedExam === "Midterm") ?
        ["attendance", "classParticipation", "quiz", "portfolio", "midtermExam"] :
        ["classParticipationFinals", "quizFinals", "portfolioFinals", "finalsExam"];
    } else if (type === "lab") {
      optionsToDisplay = (selectedExam === "Midterm") ?
        ["labAttendance/LabClassParticipation", "labReports", "labPracticalExam"] :
        ["labFinalsReports", "labFinalsPracticalExam"];
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
    examApp.showForm(type);
  },

  showForm: function (type) {
    var examComponentDropdown;
    var attendanceForm;
    var classParticipationForm;
    var classParticipationFormFinals;
    var quizForm;
    var finalQuizForm;
    var finalPortfolioForm;
    var portfolioForm;
    var midtermForm;
    var finalExamForm;
    var labAttendanceForm;
    var labReportForm;
    var labFinalsReportsForm;
    var labPracticalExamForm;
    var labFinalsPracticalExamForm;


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
    } else if (type === "lab") {
    examComponentDropdown = document.getElementById("examComponentLab");
    labAttendanceForm = document.getElementById("labAttendanceForm");
    labReportForm = document.getElementById("labReportForm");
    labFinalsReportsForm = document.getElementById("labFinalsReportsForm");
    labPracticalExamForm = document.getElementById("labPracticalExamForm");
    labFinalsPracticalExamForm = document.getElementById("labFinalsPracticalExamForm");

    var selectedComponent = examComponentDropdown.options[examComponentDropdown.selectedIndex].value;
    // Hide all lab forms initially
    if (labAttendanceForm) {
        labAttendanceForm.style.display = "none";
    }
    if (labReportForm) {
        labReportForm.style.display = "none";
    }
    if (labPracticalExamForm) {
        labPracticalExamForm.style.display = "none";
    }
    if (labFinalsReportsForm) {
        labFinalsReportsForm.style.display = "none";
    }
    if (labFinalsPracticalExamForm) {
      labFinalsPracticalExamForm.style.display = "none";
    }

    // Show the selected lab form when dropdown changes
    examComponentDropdown.addEventListener("change", function () {
        var selectedComponentLab = examComponentDropdown.value;

        if (selectedComponentLab === "labAttendance/LabClassParticipation") {
            if (labAttendanceForm) {
                labAttendanceForm.style.display = "block";
            }
            if (labReportForm) {
                labReportForm.style.display = "none";
            }
            if (labPracticalExamForm) {
                labPracticalExamForm.style.display = "none";
            }
            if (labFinalsReportsForm) {
                labFinalsReportsForm.style.display = "none";
            }
            if (labFinalsPracticalExamForm) {
              labFinalsPracticalExamForm.style.display = "none";
            }
        } else if (selectedComponentLab === "labReports") {
            if (labAttendanceForm) {
                labAttendanceForm.style.display = "none";
            }
            if (labReportForm) {
                labReportForm.style.display = "block"; // Show lab report form
            }
            if (labPracticalExamForm) {
                labPracticalExamForm.style.display = "none";
            }
            if (labFinalsReportsForm) {
                labFinalsReportsForm.style.display = "none";
            }
            if (labFinalsPracticalExamForm) {
              labFinalsPracticalExamForm.style.display = "none";
            }
          } else if (selectedComponentLab === "labFinalsReports") {
              if (labAttendanceForm) {
                  labAttendanceForm.style.display = "none";
              }
              if (labReportForm) {
                  labReportForm.style.display = "none";
              }
              if (labPracticalExamForm) {
                  labPracticalExamForm.style.display = "none";
              }
              if (labFinalsReportsForm) {
                  labFinalsReportsForm.style.display = "block"; // Show lab finals reports form
              }
              if (labFinalsPracticalExamForm) {
                labFinalsPracticalExamForm.style.display = "none";
              }
          } else if (selectedComponentLab === "labPracticalExam") {
            if (labAttendanceForm) {
                labAttendanceForm.style.display = "none";
            }
            if (labReportForm) {
                labReportForm.style.display = "none";
            }
            if (labPracticalExamForm) {
                labPracticalExamForm.style.display = "block"; // Show practical Exam form
            }
            if (labFinalsReportsForm) {
                labFinalsReportsForm.style.display = "none";
            }
            if (labFinalsPracticalExamForm) {
              labFinalsPracticalExamForm.style.display = "none";
            }
          } else if (selectedComponentLab === "labFinalsPracticalExam") {
            if (labAttendanceForm) {
                labAttendanceForm.style.display = "none";
            }
            if (labReportForm) {
                labReportForm.style.display = "none";
            }
            if (labPracticalExamForm) {
                labPracticalExamForm.style.display = "block"; // Show practical Exam form
            }
            if (labFinalsReportsForm) {
                labFinalsReportsForm.style.display = "none";
            }
            if (labFinalsPracticalExamForm) {
              labFinalsPracticalExamForm.style.display = "block";
            }
            
        }
        // ... (other form showing logic for lab)
    });
}

  },
  
    handleQuizLengthInput: function () {
      var quizLengthInput = document.getElementById("quizLength");
      var quizScoreTotalContainer = document.getElementById("quizScoreTotalContainer");
      var quizWeightedInput = document.getElementById("quizWeighted");
      var examDropdown = document.getElementById("examType");
  
      quizLengthInput.addEventListener("input", function () {
        var quizLength = parseInt(quizLengthInput.value);
  
        var selectedExam = examDropdown.options[examDropdown.selectedIndex].text;
  
        if (selectedExam === "Midterm" && !isNaN(quizLength) && quizLength > 0) {
          // Display quiz score and total input fields
          quizScoreTotalContainer.innerHTML = ""; // Clear previous fields
  
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
  
            quizScoreTotalContainer.appendChild(scoreLabel);
            quizScoreTotalContainer.appendChild(scoreInput);
            quizScoreTotalContainer.appendChild(totalLabel);
            quizScoreTotalContainer.appendChild(totalInput);
          }
  
          // Display quiz score and total container
          quizScoreTotalContainer.style.display = "flex";
  
          // Calculate and display weighted percentage
          var weightedPercentage = (quizLength * 15) / 100;
          quizWeightedInput.value = weightedPercentage;
        } else {
          // Hide quiz score and total container if invalid quiz length or exam is not "Midterm"
          quizScoreTotalContainer.style.display = "none";
        }
      });
    },

    handleFinalQuizInput: function () {
        var quizLengthInputFinals = document.getElementById("finalQuizLength");
        var quizScoreTotalContainerFinals = document.getElementById("finalQuizScoreTotalContainer");
        var overallScoreInput = document.getElementById("finalQuizOverallScore");
        var overallTotalInput = document.getElementById("finalQuizOverallTotal");
        var quizWeightedInputFinals = document.getElementById("finalQuizWeighted");
        var examDropdown = document.getElementById("examType");
    
        if (quizLengthInputFinals) {
            quizLengthInputFinals.addEventListener("input", function () {
                var quizLength = parseInt(quizLengthInputFinals.value);
    
                var selectedExam = examDropdown.options[examDropdown.selectedIndex].text;
    
                if (selectedExam === "Finals" && !isNaN(quizLength) && quizLength > 0) {
                    quizScoreTotalContainerFinals.innerHTML = "";
    
                    for (var i = 1; i <= quizLength; i++) {
                        var quizScoreId = "finalQuizScore" + i;
                        var quizTotalId = "finalQuizTotal" + i;
    
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
    
                        quizScoreTotalContainerFinals.appendChild(scoreLabel);
                        quizScoreTotalContainerFinals.appendChild(scoreInput);
                        quizScoreTotalContainerFinals.appendChild(totalLabel);
                        quizScoreTotalContainerFinals.appendChild(totalInput);
                    }
    
                    quizScoreTotalContainerFinals.style.display = "flex";
    
                    var overallScore = 0;
                    var overallTotal = 0;
    
                    for (var j = 1; j <= quizLength; j++) {
                        var scoreInputId = "finalQuizScore" + j;
                        var totalInputId = "finalQuizTotal" + j;
    
                        var scoreInput = document.getElementById(scoreInputId);
                        var totalInput = document.getElementById(totalInputId);
    
                        if (!isNaN(scoreInput.value) && !isNaN(totalInput.value)) {
                            overallScore += parseFloat(scoreInput.value);
                            overallTotal += parseFloat(totalInput.value);
                        }
                    }
    
                    overallScoreInput.value = !isNaN(overallScore) ? overallScore : 0;
                    overallTotalInput.value = !isNaN(overallTotal) ? overallTotal : 0;
    
                    var weightedPercentage = (overallScore / overallTotal) * 15;
                    quizWeightedInputFinals.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
                } else {
                    quizScoreTotalContainerFinals.style.display = "none";
                    overallScoreInput.value = 0;
                    overallTotalInput.value = 0;
                    quizWeightedInputFinals.value = 0;
                }
            });
        }
    },
  
    handlePortfolioLengthInput: function () {
      var portfolioLengthInput = document.getElementById("portfolioLength");
      var portfolioScoreTotalContainer = document.getElementById("portfolioScoreTotalContainer");
      var portfolioWeightedInput = document.getElementById("portfolioWeighted");
      var examDropdown = document.getElementById("examType");
  
      portfolioLengthInput.addEventListener("input", function () {
        var portfolioLength = parseInt(portfolioLengthInput.value);
  
        var selectedExam = examDropdown.options[examDropdown.selectedIndex].text;
  
        if (selectedExam === "Midterm" && !isNaN(portfolioLength) && portfolioLength > 0) {
          // Display portfolio score and total input fields
          portfolioScoreTotalContainer.innerHTML = ""; // Clear previous fields
  
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
  
            portfolioScoreTotalContainer.appendChild(scoreLabel);
            portfolioScoreTotalContainer.appendChild(scoreInput);
            portfolioScoreTotalContainer.appendChild(totalLabel);
            portfolioScoreTotalContainer.appendChild(totalInput);
          }
  
          // Display portfolio score and total container
          portfolioScoreTotalContainer.style.display = "flex";
  
          // Calculate and display weighted percentage
          var weightedPercentage = (portfolioLength * 25) / 100;
          portfolioWeightedInput.value = weightedPercentage;
        } else {
          // Hide portfolio score and total container if invalid portfolio length or exam is not "Midterm"
          portfolioScoreTotalContainer.style.display = "none";
        }
      });
    },

    handleFinalPortfolioInput: function () {
        var finalPortfolioLengthInput = document.getElementById("finalPortfolioLength");
        var finalPortfolioScoreTotalContainer = document.getElementById("finalPortfolioScoreTotalContainer");
        var overallScoreInput = document.getElementById("finalPortfolioOverallScore");
        var overallTotalInput = document.getElementById("finalPortfolioOverallTotal");
        var finalPortfolioWeightedInput = document.getElementById("finalPortfolioWeighted");
        var examDropdown = document.getElementById("examType");
    
        if (finalPortfolioLengthInput && finalPortfolioScoreTotalContainer) {
            finalPortfolioLengthInput.addEventListener("input", function () {
                var finalPortfolioLength = parseInt(finalPortfolioLengthInput.value);
                var selectedExam = examDropdown.options[examDropdown.selectedIndex].text;
    
                // Check if the selected exam is "Finals" and the length is valid
                if (selectedExam === "Finals" && !isNaN(finalPortfolioLength) && finalPortfolioLength > 0) {
                    // Clear previous fields
                    finalPortfolioScoreTotalContainer.innerHTML = "";
    
                    for (var i = 1; i <= finalPortfolioLength; i++) {
                        // Create unique IDs for each element
                        var finalPortfolioScoreId = "finalPortfolioScore" + i;
                        var finalPortfolioTotalId = "finalPortfolioTotal" + i;
    
                        // Create a div container for each score and total pair
                        var container = document.createElement("div");
                        container.classList.add("score-total-container");
    
                        // Create and append labels for score and total
                        var scoreLabel = document.createElement("label");
                        scoreLabel.setAttribute("for", finalPortfolioScoreId);
                        scoreLabel.textContent = "Portfolio " + i + " Score:";
    
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
    
                        // Append the elements to the container
                        container.appendChild(scoreLabel);
                        container.appendChild(scoreInput);
                        container.appendChild(totalLabel);
                        container.appendChild(totalInput);
    
                        // Append the container to the finalPortfolioScoreTotalContainer
                        finalPortfolioScoreTotalContainer.appendChild(container);
                    }
    
                    // Display final portfolio score and total container
                    finalPortfolioScoreTotalContainer.style.display = "flex";
    
                    // Calculate and display weighted percentage
                    var weightedPercentage = (finalPortfolioLength * 25) / 100;
                    finalPortfolioWeightedInput.value = weightedPercentage.toFixed(2);
                } else {
                    // Hide final portfolio score and total container if invalid length or exam is not "Finals"
                    finalPortfolioScoreTotalContainer.style.display = "none";
                    overallScoreInput.value = 0;
                    overallTotalInput.value = 0;
                    finalPortfolioWeightedInput.value = 0;
                }
            });
        }
    },
    
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
            var midtermScore = parseInt(midtermScoreInput.value);
  
            if (!isNaN(midtermScore) && midtermScore >= 0) {
              midtermItemsInput.value = "Number of Items: 3"; // You can set the default value as needed
              midtermWeightedInput.value = "Weighted Percentage: 20%"; // You can set the default value as needed
            } else {
              midtermItemsInput.value = "";
              midtermWeightedInput.value = "";
            }
          });
        } else {
          midtermForm.style.display = "none";
        }
      });
    },
    handleLabReportsInput: function () {
      var labReportsLengthInput = document.getElementById("labReportsLength");
      var labReportsScoreTotalContainer = document.getElementById("labReportsScoreTotalContainer");
      var labReportsOverallScoreInput = document.getElementById("labReportsOverallScore");
      var labReportsOverallTotalInput = document.getElementById("labReportsOverallTotal");
      var labReportsWeightedInput = document.getElementById("labReportsWeighted");
    
      if (labReportsLengthInput) {
        labReportsLengthInput.addEventListener("input", function () {
          var labReportsLength = parseInt(labReportsLengthInput.value);
    
          if (!isNaN(labReportsLength) && labReportsLength > 0) {
            // Clear existing content in the container
            labReportsScoreTotalContainer.innerHTML = ""; // This line is causing the error
    
            for (var i = 1; i <= labReportsLength; i++) {
              var labScoreId = "labReportsScore" + i;
              var labTotalId = "labReportsTotal" + i;
    
              var scoreLabel = document.createElement("label");
              scoreLabel.setAttribute("for", labScoreId);
              scoreLabel.textContent = "Lab Report " + i + " Score:";
    
              var scoreInput = document.createElement("input");
              scoreInput.setAttribute("type", "number");
              scoreInput.setAttribute("id", labScoreId);
              scoreInput.setAttribute("name", labScoreId);
              scoreInput.setAttribute("inputmode", "numeric");
    
              var totalLabel = document.createElement("label");
              totalLabel.setAttribute("for", labTotalId);
              totalLabel.textContent = "Total " + i + ":";
    
              var totalInput = document.createElement("input");
              totalInput.setAttribute("type", "number");
              totalInput.setAttribute("id", labTotalId);
              totalInput.setAttribute("name", labTotalId);
              totalInput.setAttribute("inputmode", "numeric");
    
              labReportsScoreTotalContainer.appendChild(scoreLabel);
              labReportsScoreTotalContainer.appendChild(scoreInput);
              labReportsScoreTotalContainer.appendChild(totalLabel);
              labReportsScoreTotalContainer.appendChild(totalInput);
            }
    
            labReportsScoreTotalContainer.style.display = "flex";
    
            var overallScore = 0;
            var overallTotal = 0;
    
            // Loop through created input fields and calculate overall score and total
            for (var j = 1; j <= labReportsLength; j++) {
              var scoreInputId = "labReportsScore" + j;
              var totalInputId = "labReportsTotal" + j;
    
              var scoreInput = document.getElementById(scoreInputId);
              var totalInput = document.getElementById(totalInputId);
    
              if (!isNaN(scoreInput.value) && !isNaN(totalInput.value)) {
                overallScore += parseFloat(scoreInput.value);
                overallTotal += parseFloat(totalInput.value);
              }
            }
    
            labReportsOverallScoreInput.value = !isNaN(overallScore) ? overallScore : 0;
            labReportsOverallTotalInput.value = !isNaN(overallTotal) ? overallTotal : 0;
    
            var weightedPercentage = (overallScore / overallTotal) * 50;
            labReportsWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
          } else {
            labReportsScoreTotalContainer.style.display = "none";
            labReportsOverallScoreInput.value = 0;
            labReportsOverallTotalInput.value = 0;
            labReportsWeightedInput.value = 0;
          }
        });
      }
    },

    handleLabPracticalExamInput: function () {
      var labPracticalExamLengthInput = document.getElementById("labPracticalExamLength");
      var labPracticalExamScoreTotalContainer = document.getElementById("labPracticalExamScoreTotalContainer");
      var labPracticalExamOverallScoreInput = document.getElementById("labPracticalExamOverallScore");
      var labPracticalExamOverallTotalInput = document.getElementById("labPracticalExamOverallTotal");
      var labPracticalExamWeightedInput = document.getElementById("labPracticalExamWeighted");
  
      if (labPracticalExamLengthInput) {
          labPracticalExamLengthInput.addEventListener("input", function () {
              var labPracticalExamLength = parseInt(labPracticalExamLengthInput.value);
  
              if (!isNaN(labPracticalExamLength) && labPracticalExamLength > 0) {
                  // Clear existing content in the container
                  labPracticalExamScoreTotalContainer.innerHTML = "";
  
                  for (var i = 1; i <= labPracticalExamLength; i++) {
                      var practicalExamScoreId = "labPracticalExamScore" + i;
                      var practicalExamTotalId = "labPracticalExamTotal" + i;
  
                      var scoreLabel = document.createElement("label");
                      scoreLabel.setAttribute("for", practicalExamScoreId);
                      scoreLabel.textContent = "Practical Exam " + i + " Score:";
  
                      var scoreInput = document.createElement("input");
                      scoreInput.setAttribute("type", "number");
                      scoreInput.setAttribute("id", practicalExamScoreId);
                      scoreInput.setAttribute("name", practicalExamScoreId);
                      scoreInput.setAttribute("inputmode", "numeric");
  
                      var totalLabel = document.createElement("label");
                      totalLabel.setAttribute("for", practicalExamTotalId);
                      totalLabel.textContent = "Total " + i + ":";
  
                      var totalInput = document.createElement("input");
                      totalInput.setAttribute("type", "number");
                      totalInput.setAttribute("id", practicalExamTotalId);
                      totalInput.setAttribute("name", practicalExamTotalId);
                      totalInput.setAttribute("inputmode", "numeric");
  
                      labPracticalExamScoreTotalContainer.appendChild(scoreLabel);
                      labPracticalExamScoreTotalContainer.appendChild(scoreInput);
                      labPracticalExamScoreTotalContainer.appendChild(totalLabel);
                      labPracticalExamScoreTotalContainer.appendChild(totalInput);
                  }
  
                  labPracticalExamScoreTotalContainer.style.display = "flex";
  
                  var overallScore = 0;
                  var overallTotal = 0;
  
                  // Loop through created input fields and calculate overall score and total
                  for (var j = 1; j <= labPracticalExamLength; j++) {
                      var scoreInputId = "labPracticalExamScore" + j;
                      var totalInputId = "labPracticalExamTotal" + j;
  
                      var scoreInput = document.getElementById(scoreInputId);
                      var totalInput = document.getElementById(totalInputId);
  
                      if (!isNaN(scoreInput.value) && !isNaN(totalInput.value)) {
                          overallScore += parseFloat(scoreInput.value);
                          overallTotal += parseFloat(totalInput.value);
                      }
                  }
  
                  labPracticalExamOverallScoreInput.value = !isNaN(overallScore) ? overallScore : 0;
                  labPracticalExamOverallTotalInput.value = !isNaN(overallTotal) ? overallTotal : 0;
  
                  var weightedPercentage = (overallScore / overallTotal) * 30;
                  labPracticalExamWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
              } else {
                  labPracticalExamScoreTotalContainer.style.display = "none";
                  labPracticalExamOverallScoreInput.value = 0;
                  labPracticalExamOverallTotalInput.value = 0;
                  labPracticalExamWeightedInput.value = 0;
              }
          });
      }
  },
  handleLabFinalsReportsInput: function () {
    var labFinalsReportsLengthInput = document.getElementById("labFinalsReportsLength");
    var labFinalsReportsScoreTotalContainer = document.getElementById("labFinalsReportsScoreTotalContainer");
    var labFinalsReportsOverallScoreInput = document.getElementById("labFinalsReportsOverallScore");
    var labFinalsReportsOverallTotalInput = document.getElementById("labFinalsReportsOverallTotal");
    var labFinalsReportsWeightedInput = document.getElementById("labFinalsReportsWeighted");

    if (labFinalsReportsLengthInput) {
        labFinalsReportsLengthInput.addEventListener("input", function () {
            var labFinalsReportsLength = parseInt(labFinalsReportsLengthInput.value);

            if (!isNaN(labFinalsReportsLength) && labFinalsReportsLength > 0) {
                // Clear existing content in the container
                labFinalsReportsScoreTotalContainer.innerHTML = "";

                for (var i = 1; i <= labFinalsReportsLength; i++) {
                    var finalsReportsScoreId = "labFinalsReportsScore" + i;
                    var finalsReportsTotalId = "labFinalsReportsTotal" + i;

                    var scoreLabel = document.createElement("label");
                    scoreLabel.setAttribute("for", finalsReportsScoreId);
                    scoreLabel.textContent = "Lab Report " + i + " Score:";

                    var scoreInput = document.createElement("input");
                    scoreInput.setAttribute("type", "number");
                    scoreInput.setAttribute("id", finalsReportsScoreId);
                    scoreInput.setAttribute("name", finalsReportsScoreId);
                    scoreInput.setAttribute("inputmode", "numeric");

                    var totalLabel = document.createElement("label");
                    totalLabel.setAttribute("for", finalsReportsTotalId);
                    totalLabel.textContent = "Total " + i + ":";

                    var totalInput = document.createElement("input");
                    totalInput.setAttribute("type", "number");
                    totalInput.setAttribute("id", finalsReportsTotalId);
                    totalInput.setAttribute("name", finalsReportsTotalId);
                    totalInput.setAttribute("inputmode", "numeric");

                    labFinalsReportsScoreTotalContainer.appendChild(scoreLabel);
                    labFinalsReportsScoreTotalContainer.appendChild(scoreInput);
                    labFinalsReportsScoreTotalContainer.appendChild(totalLabel);
                    labFinalsReportsScoreTotalContainer.appendChild(totalInput);
                }

                labFinalsReportsScoreTotalContainer.style.display = "flex";

                var overallScore = 0;
                var overallTotal = 0;

                // Loop through created input fields and calculate overall score and total
                for (var j = 1; j <= labFinalsReportsLength; j++) {
                    var scoreInputId = "labFinalsReportsScore" + j;
                    var totalInputId = "labFinalsReportsTotal" + j;

                    var scoreInput = document.getElementById(scoreInputId);
                    var totalInput = document.getElementById(totalInputId);

                    if (!isNaN(scoreInput.value) && !isNaN(totalInput.value)) {
                        overallScore += parseFloat(scoreInput.value);
                        overallTotal += parseFloat(totalInput.value);
                    }
                }

                labFinalsReportsOverallScoreInput.value = !isNaN(overallScore) ? overallScore : 0;
                labFinalsReportsOverallTotalInput.value = !isNaN(overallTotal) ? overallTotal : 0;

                var weightedPercentage = (overallScore / overallTotal) * 50;
                labFinalsReportsWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
            } else {
                labFinalsReportsScoreTotalContainer.style.display = "none";
                labFinalsReportsOverallScoreInput.value = 0;
                labFinalsReportsOverallTotalInput.value = 0;
                labFinalsReportsWeightedInput.value = 0;
            }
        });
    }
},
handleLabFinalsPracticalExamInput: function () {
  var labFinalsPracticalExamLengthInput = document.getElementById("labFinalsPracticalExamLength");
  var labFinalsPracticalExamScoreTotalContainer = document.getElementById("labFinalsPracticalExamScoreTotalContainer");
  var labFinalsPracticalExamOverallScoreInput = document.getElementById("labFinalsPracticalExamOverallScore");
  var labFinalsPracticalExamOverallTotalInput = document.getElementById("labFinalsPracticalExamOverallTotal");
  var labFinalsPracticalExamWeightedInput = document.getElementById("labFinalsPracticalExamWeighted");

  if (labFinalsPracticalExamLengthInput) {
      labFinalsPracticalExamLengthInput.addEventListener("input", function () {
          var labFinalsPracticalExamLength = parseInt(labFinalsPracticalExamLengthInput.value);

          if (!isNaN(labFinalsPracticalExamLength) && labFinalsPracticalExamLength > 0) {
              // Clear existing content in the container
              labFinalsPracticalExamScoreTotalContainer.innerHTML = "";

              for (var i = 1; i <= labFinalsPracticalExamLength; i++) {
                  var practicalExamScoreId = "labFinalsPracticalExamScore" + i;
                  var practicalExamTotalId = "labFinalsPracticalExamTotal" + i;

                  var scoreLabel = document.createElement("label");
                  scoreLabel.setAttribute("for", practicalExamScoreId);
                  scoreLabel.textContent = "Practical Exam " + i + " Score:";

                  var scoreInput = document.createElement("input");
                  scoreInput.setAttribute("type", "number");
                  scoreInput.setAttribute("id", practicalExamScoreId);
                  scoreInput.setAttribute("name", practicalExamScoreId);
                  scoreInput.setAttribute("inputmode", "numeric");

                  var totalLabel = document.createElement("label");
                  totalLabel.setAttribute("for", practicalExamTotalId);
                  totalLabel.textContent = "Total " + i + ":";

                  var totalInput = document.createElement("input");
                  totalInput.setAttribute("type", "number");
                  totalInput.setAttribute("id", practicalExamTotalId);
                  totalInput.setAttribute("name", practicalExamTotalId);
                  totalInput.setAttribute("inputmode", "numeric");

                  labFinalsPracticalExamScoreTotalContainer.appendChild(scoreLabel);
                  labFinalsPracticalExamScoreTotalContainer.appendChild(scoreInput);
                  labFinalsPracticalExamScoreTotalContainer.appendChild(totalLabel);
                  labFinalsPracticalExamScoreTotalContainer.appendChild(totalInput);
              }

              labFinalsPracticalExamScoreTotalContainer.style.display = "flex";

              var overallScore = 0;
              var overallTotal = 0;

              // Loop through created input fields and calculate overall score and total
              for (var j = 1; j <= labFinalsPracticalExamLength; j++) {
                  var scoreInputId = "labFinalsPracticalExamScore" + j;
                  var totalInputId = "labFinalsPracticalExamTotal" + j;

                  var scoreInput = document.getElementById(scoreInputId);
                  var totalInput = document.getElementById(totalInputId);

                  if (!isNaN(scoreInput.value) && !isNaN(totalInput.value)) {
                      overallScore += parseFloat(scoreInput.value);
                      overallTotal += parseFloat(totalInput.value);
                  }
              }

              labFinalsPracticalExamOverallScoreInput.value = !isNaN(overallScore) ? overallScore : 0;
              labFinalsPracticalExamOverallTotalInput.value = !isNaN(overallTotal) ? overallTotal : 0;

              var weightedPercentage = (overallScore / overallTotal) * 30;
              labFinalsPracticalExamWeightedInput.value = !isNaN(weightedPercentage) ? weightedPercentage.toFixed(2) : 0;
          } else {
              labFinalsPracticalExamScoreTotalContainer.style.display = "none";
              labFinalsPracticalExamOverallScoreInput.value = 0;
              labFinalsPracticalExamOverallTotalInput.value = 0;
              labFinalsPracticalExamWeightedInput.value = 0;
          }
      });
  }
},

  };
  
// Initial call to hide/show forms based on the default selection
document.getElementById("sessionType").addEventListener("change", examApp.showSelectedSession);
document.getElementById("examType").addEventListener("change", function () { examApp.showSelectedExam("lecture"); });
document.getElementById("examTypeLab").addEventListener("change", function () { examApp.showSelectedExam("lab"); });
document.getElementById("examComponent").addEventListener("change", function () { examApp.showForm("lecture"); });
document.getElementById("examComponentLab").addEventListener("change", function () { examApp.showForm("lab"); });

// Additional calls to handle quiz, portfolio, and midterm input dynamically
examApp.handleQuizLengthInput();
examApp.handleFinalQuizInput();
examApp.handlePortfolioLengthInput();
examApp.handleFinalPortfolioInput();
examApp.handleMidtermInput();
examApp.handleLabReportsInput();
examApp.handleLabPracticalExamInput();
examApp.handleLabFinalsReportsInput();
examApp.handleLabFinalsPracticalExamInput();

// Initial call to hide/show forms based on the default selection
examApp.showSelectedSession();