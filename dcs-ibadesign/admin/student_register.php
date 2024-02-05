<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Reg Form</title> 
</head>
<body>
    <div class="container">
        <header> Student Registration</header>

        <form action="#">
        <div class="form first">
                <div class="details personal">
                    <span class="title">Personal Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Student Number</label>
                            <input type="text" placeholder="Enter your student number" required>
                        </div>

                        <div class="input-field">
                            <label>Student Name <span style="font-size: smaller; font-style: italic;" >Format: LN, FN, MN (if any)</span></label>
                            <input type="text" placeholder="Enter name" required>
                        </div>

                        <div class="input-field">
                            <label>Address</label>
                            <input type="text" placeholder="Enter your address" required>
                        </div>

                        <div class="input-field">
                            <label>Course</label>
                            <select id="course" name="course" required>
                              <option disabled selected>Select Course</option>
                              <option value="BSCS">BSCS</option>
                              <option value="BSIT">BSIT</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Year</label>
                            <select id="year" name="year" required>
                              <option disabled selected>Select Year</option>
                              <option value="1st">1st</option>
                              <option value="2nd">2nd</option>
                              <option value="3rd">3rd</option>
                              <option value="4th">4th</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Status</label>
                            <select id="Status" name="Status" required>
                          <option disabled selected>Select Course</option>
                          <option value="Regular">Regular</option>
                          <option value="Irregular">Irregular</option>
                      </select>
                        </div>
                    </div>
                </div>

                <div class="details Course">
                    <span class="title">Course Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Major</label>
                            <input type="text" placeholder="N/A" required readonly>
                        </div>

                        <div class="input-field">
                            <label>Semester</label>
                          <select id="semester" name="semester" required>
                          <option disabled selected>Select Semester</option>
                          <option value="FIRST">First Semester</option>
                          <option value="SECOND">Second Semester</option>
                      </select>
                        </div>

                        <div class="input-field">
                        <label>School Year <span style="font-size: smaller; font-style: italic;" >(e.g. 2023-2024)</span></label>
                            <input type="text" placeholder="Date" required>
                        </div>
                    </div>

                    <button class="nextBtn">
                        <span class="btnText">Next</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div> 
            </div>

            <div class="form second">
            <div class="details subjects">
                    <span class="title">Subject Details</span>
                    <span class="subject-details">Kindly input the schedule codes for all your enrolled subjects</span>
                    <!-- Dynamic input fields based on user input -->
                <form id="dynamicForm">
                    <div class="input-field-ask">
                        <input type="text" id="numberOfFields" min="1" placeholder="Enter the number of subjects you have" required>
                        <button type="button" id="submitBtn" class="subjButton"><i class="ri-arrow-right-double-line"></i></button>
                    </div>
                </form>
               

                    <div id="inputFieldsContainer" class="fields"></div>



                    <div class="buttons">
                        <div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <span class="btnText">Back</span>
                        </div>
                        
                        <button class="submit">
                            <span class="btnText">Submit</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>