<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
     
    <!-- Iconscout CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    

    <title>Reg Form</title> 
</head>
<body>
    <div class="container scrollable-form">
        <header> Student Registration</header>

        <form action="#" class="scrollable-form">
            <div class="form first">
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

            <div class="form second"></div>
        </form>
    </div>

    <script src="tryscript.js"></script>
</body>
</html>
