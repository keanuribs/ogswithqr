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
        var finalsOptions = ["finalsExam"];
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

    showForm: function (type) {
        var examComponentDropdown;
        var attendanceForm;
        var classParticipationForm;
        var labAttendanceForm;
        var quizForm;
        var portfolioForm;
        var midtermForm;

        if (type === "lecture") {
            examComponentDropdown = document.getElementById("examComponent");
            attendanceForm = document.getElementById("attendanceForm");
            classParticipationForm = document.getElementById("classParticipationForm");
            quizForm = document.getElementById("quizForm");
            portfolioForm = document.getElementById("portfolioForm");
            midtermForm = document.getElementById("midtermForm");
        } else if (type === "lab") {
            examComponentDropdown = document.getElementById("examComponentLab");
            labAttendanceForm = document.getElementById("labAttendanceForm");
        }

        var selectedComponent = examComponentDropdown.options[examComponentDropdown.selectedIndex].value;

        // Hide all forms initially
        if (attendanceForm) {
            attendanceForm.style.display = "none";
        }
        if (classParticipationForm) {
            classParticipationForm.style.display = "none";
        }
        if (labAttendanceForm) {
            labAttendanceForm.style.display = "none";
        }
        if (quizForm) {
            quizForm.style.display = "none";
        }
        if (portfolioForm) {
            portfolioForm.style.display = "none";
        }
        if (midtermForm) {
            midtermForm.style.display = "none";
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
            } else if (selectedComponent === "quiz") {
                if (quizForm) {
                    quizForm.style.display = "block";
                }
            } else if (selectedComponent === "portfolio") {
                if (portfolioForm) {
                    portfolioForm.style.display = "block";
                }
            } else if (selectedComponent === "midtermExam") {
                if (midtermForm) {
                    midtermForm.style.display = "block";
                }
            }
        } else if (type === "lab") {
            if (selectedComponent === "labAttendance") {
                if (labAttendanceForm) {
                    labAttendanceForm.style.display = "block";
                }
            }
        }
    },

    handleQuizLengthInput: function () {
        var quizLengthInput = document.getElementById("quizLength");
        var quizScoreTotalContainer = document.getElementById("quizScoreTotalContainer");
        var quizWeightedInput = document.getElementById("quizWeighted");
        var overallScoreInput = document.getElementById("overallScore");
        var overallTotalInput = document.getElementById("overallTotal");

        quizLengthInput.addEventListener("input", function () {
            var quizLength = parseInt(quizLengthInput.value);

            if (!isNaN(quizLength) && quizLength > 0) {
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

                // Calculate and display overall score and total
                overallScoreInput.value = "Overall Score:";
                overallTotalInput.value = "Overall Total:";

                // Calculate and display weighted percentage
                var weightedPercentage = (quizLength * 15) / 100;
                quizWeightedInput.value = weightedPercentage;
            } else {
                // Hide quiz score and total container if invalid quiz length
                quizScoreTotalContainer.style.display = "none";
                overallScoreInput.value = "";
                overallTotalInput.value = "";
            }
        });
    },

    handlePortfolioLengthInput: function () {
        var portfolioLengthInput = document.getElementById("portfolioLength");
        var portfolioScoreTotalContainer = document.getElementById("portfolioScoreTotalContainer");
        var portfolioWeightedInput = document.getElementById("portfolioWeighted");
        var overallScoreInput = document.getElementById("overallScore");
        var overallTotalInput = document.getElementById("overallTotal");

        portfolioLengthInput.addEventListener("input", function () {
            var portfolioLength = parseInt(portfolioLengthInput.value);

            if (!isNaN(portfolioLength) && portfolioLength > 0) {
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

                // Calculate and display overall score and total
                overallScoreInput.value = "Overall Score:";
                overallTotalInput.value = "Overall Total:";

                // Calculate and display weighted percentage
                var weightedPercentage = (portfolioLength * 25) / 100;
                portfolioWeightedInput.value = weightedPercentage;
            } else {
                // Hide portfolio score and total container if invalid portfolio length
                portfolioScoreTotalContainer.style.display = "none";
                overallScoreInput.value = "";
                overallTotalInput.value = "";
            }
        });
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
    }
};

// Initial call to hide/show forms based on the default selection
document.getElementById("sessionType").addEventListener("change", examApp.showSelectedSession);
document.getElementById("examType").addEventListener("change", function () { examApp.showSelectedExam("lecture"); });
document.getElementById("examTypeLab").addEventListener("change", function () { examApp.showSelectedExam("lab"); });
document.getElementById("examComponent").addEventListener("change", function () { examApp.showForm("lecture"); });
document.getElementById("examComponentLab").addEventListener("change", function () { examApp.showForm("lab"); });

// Additional calls to handle quiz, portfolio, and midterm input dynamically
examApp.handleQuizLengthInput();
examApp.handlePortfolioLengthInput();
examApp.handleMidtermInput();

// Initial call to hide/show forms based on the default selection
examApp.showSelectedSession();