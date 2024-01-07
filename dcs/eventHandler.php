<?php      
// Include database configuration file  
require_once 'config.php'; 
 
// Retrieve JSON from POST body 
$jsonStr = file_get_contents('php://input'); 
$jsonObj = json_decode($jsonStr); 
 
if($jsonObj->request_type == 'addEditUser'){ 
    $student_data = $jsonObj->student_data; 
    $last_name = !empty($student_data[0])?$student_data[0]:''; 
    $first_name = !empty($student_data[1])?$student_data[1]:'';
    $middle_name = !empty($student_data[2])?$student_data[2]:'';
    $student_number = !empty($student_data[3])?$student_data[3]:'';
    $course = !empty($student_data[4])?$student_data[4]:'';
    $year_section = !empty($student_data[5])?$student_data[5]:'';
    $id = !empty($student_data[6])?$student_data[6]:0;
    
    $err = ''; 
    if(empty($last_name)){ 
        $err .= 'Please enter a Last Name.<br/>';
    } 
    if(empty($first_name)){ 
        $err .= 'Please enter a First Name.<br/>'; 
    }
    if(empty($middle_name)){ 
        $err .= 'Please enter a Middle Name.<br/>'; 
    } 
    if(empty($student_number)){ 
        $err .= 'Please enter a Student Number.<br/>'; 
    }
    if(empty($course)){ 
        $err .= 'Please enter a Course<br/>'; 
    }
    if(empty($year_section)){ 
        $err .= 'Please enter a Year and Section<br/>'; 
    }
  
  

    if(!empty($student_data && empty($err))){ 
        if(!empty($id)){ 
            // Update user data into the database 

            $sqlQ = "UPDATE tblstudents SET last_name=?,first_name=?,middle_name=?,student_number=?,course=?,year_section=? WHERE id=?"; 
            $stmt = $conn->prepare($sqlQ); 
            $stmt->bind_param("sssissi", $last_name, $first_name, $middle_name, $student_number, $course, $year_section, $id); 
            $update = $stmt->execute(); 
 
            if($update){ 
                $output = [ 
                    'status' => 1, 
                    'msg' => 'Student record updated successfully!' 
                ]; 
                echo json_encode($output); 
            }else{ 
                echo json_encode(['error' => 'Student update request failed!']); 
            } 
        }else{ 
            // Insert event data into the database 
            $sqlQ = "INSERT INTO tblstudents (last_name, first_name, middle_name, student_number, course, year_section) VALUES (?, ?, ?, ?, ?, ?)"; 
            $stmt = $conn->prepare($sqlQ); 
            $stmt->bind_param("sssiss", $last_name, $first_name, $middle_name, $student_number, $course, $year_section);  
            $insert = $stmt->execute(); 
 
            if($insert){ 
                $output = [ 
                    'status' => 1, 
                    'msg' => 'Student added successfully!' 
                ]; 
                echo json_encode($output); 
            }else{ 
                echo json_encode(['error' => 'Student adding request failed!']); 
            } 
        } 
    }else{ 
        echo json_encode(['error' => trim($err, '<br/>')]); 
    } 
}elseif($jsonObj->request_type == 'deleteStudent'){ 
    $id = $jsonObj->student_id; 
 
    $sql = "DELETE FROM tblstudents WHERE id=$id"; 
    $delete = $conn->query($sql); 
    if($delete){ 
        $output = [ 
            'status' => 1, 
            'msg' => 'Student deleted successfully!' 
        ]; 
        echo json_encode($output); 
    }else{ 
        echo json_encode(['error' => 'Member Delete request failed!']); 
    } 
}

//Course

if($jsonObj->request_type == 'addEditCourse'){ 
  $course_data = $jsonObj->course_data; 
  $course = !empty($course_data[0])?$course_data[0]:''; 
  $id = !empty($course_data[1])?$course_data[1]:0;
  
  $err = ''; 
  if(empty($course)){ 
      $err .= 'Please enter a Course<br/>';
  } 
  
  if(!empty($course_data && empty($err))){ 
      if(!empty($id)){ 
          // Update user data into the database 

          $sqlQ = "UPDATE tblcourse SET course=? WHERE id=?"; 
          $stmt = $conn->prepare($sqlQ); 
          $stmt->bind_param("si", $course, $id); 
          $update = $stmt->execute(); 

          if($update){ 
              $output = [ 
                  'status' => 1, 
                  'msg' => 'Course updated successfully!' 
              ]; 
              echo json_encode($output); 
          }else{ 
              echo json_encode(['error' => 'Course update request failed!']); 
          } 
      }else{ 
          // Insert event data into the database 
          $sqlQ = "INSERT INTO tblcourse (course) VALUES (?)"; 
          $stmt = $conn->prepare($sqlQ); 
          $stmt->bind_param("s", $course); 
          $insert = $stmt->execute(); 

          if($insert){ 
              $output = [ 
                  'status' => 1, 
                  'msg' => 'Course added successfully!' 
              ]; 
              echo json_encode($output); 
          }else{ 
              echo json_encode(['error' => 'Course adding request failed!']); 
          } 
      } 
  }else{ 
      echo json_encode(['error' => trim($err, '<br/>')]); 
  } 
}elseif($jsonObj->request_type == 'deletecourse'){ 
    $id = $jsonObj->course_id; 

    $sql = "DELETE FROM tblcourse WHERE id=$id"; 
    $delete = $conn->query($sql); 
    if($delete){ 
        $output = [ 
            'status' => 1, 
            'msg' => 'Course deleted successfully!' 
        ]; 
        echo json_encode($output);  
    }else{ 
        echo json_encode(['error' => 'Course Delete request failed!']); 
    } 
  }


if($jsonObj->request_type == 'addEditYrLvl'){ 
  $yrLvl_data = $jsonObj->yrLvl_data; 
  $yr_lvl = !empty($yrLvl_data[0])?$yrLvl_data[0]:''; 
  $id = !empty($yrLvl_data[1])?$yrLvl_data[1]:0;
  
  $err = ''; 
  if(empty($yr_lvl)){ 
      $err .= 'Please enter a Year Level<br/>';
  } 
  
  if(!empty($yrLvl_data && empty($err))){ 
      if(!empty($id)){ 
          // Update user data into the database 

          $sqlQ = "UPDATE tblyearlvl SET yr_lvl=? WHERE id=?"; 
          $stmt = $conn->prepare($sqlQ); 
          $stmt->bind_param("ii", $yr_lvl, $id); 
          $update = $stmt->execute(); 

          if($update){ 
              $output = [ 
                  'status' => 1, 
                  'msg' => 'Year Level record updated successfully!' 
              ]; 
              echo json_encode($output); 
          }else{ 
              echo json_encode(['error' => 'Year Level update request failed!']); 
          } 
      }else{ 
          // Insert event data into the database 
          $sqlQ = "INSERT INTO tblyearlvl (yr_lvl) VALUES (?)"; 
          $stmt = $conn->prepare($sqlQ); 
          $stmt->bind_param("i", $yr_lvl); 
          $insert = $stmt->execute(); 

          if($insert){ 
              $output = [ 
                  'status' => 1, 
                  'msg' => 'Year Level added successfully!' 
              ]; 
              echo json_encode($output); 
          }else{ 
              echo json_encode(['error' => 'Year Level adding request failed!']); 
          } 
      } 
  }else{ 
      echo json_encode(['error' => trim($err, '<br/>')]); 
  } 
}elseif($jsonObj->request_type == 'deleteyearLvl'){ 
    $id = $jsonObj->yrLvl_id; 

    $sql = "DELETE FROM tblyearlvl WHERE id=$id"; 
    $delete = $conn->query($sql); 
    if($delete){ 
        $output = [ 
            'status' => 1, 
            'msg' => 'Year Level deleted successfully!' 
        ]; 
        echo json_encode($output); 
    }else{ 
        echo json_encode(['error' => 'Year Level Delete request failed!']); 
    } 
  }


// Section
  
if($jsonObj->request_type == 'addEditsection'){ 
  $section_data = $jsonObj->section_data; 
  $section = !empty($section_data[0])?$section_data[0]:''; 
  $id = !empty($section_data[1])?$section_data[1]:0;
  
  $err = ''; 
  if(empty($section)){ 
      $err .= 'Please enter a Section<br/>';
  } 
  
  if(!empty($section_data && empty($err))){ 
      if(!empty($id)){ 
          // Update user data into the database 

          $sqlQ = "UPDATE tblsection SET section=? WHERE id=?"; 
          $stmt = $conn->prepare($sqlQ); 
          $stmt->bind_param("si", $section, $id); 
          $update = $stmt->execute(); 

          if($update){ 
              $output = [ 
                  'status' => 1, 
                  'msg' => 'Section updated successfully!' 
              ]; 
              echo json_encode($output); 
          }else{ 
              echo json_encode(['error' => 'Section update request failed!']); 
          } 
      }else{ 
          // Insert event data into the database 
          $sqlQ = "INSERT INTO tblsection (section) VALUES (?)"; 
          $stmt = $conn->prepare($sqlQ); 
          $stmt->bind_param("s", $section); 
          $insert = $stmt->execute(); 

          if($insert){ 
              $output = [ 
                  'status' => 1, 
                  'msg' => 'Section added successfully!' 
              ]; 
              echo json_encode($output); 
          }else{ 
              echo json_encode(['error' => 'Section adding request failed!']); 
          } 
      } 
  }else{ 
      echo json_encode(['error' => trim($err, '<br/>')]); 
  } 
}elseif($jsonObj->request_type == 'deletesection'){ 
    $id = $jsonObj->section_id; 

    $sql = "DELETE FROM tblsection WHERE id=$id"; 
    $delete = $conn->query($sql); 
    if($delete){ 
        $output = [ 
            'status' => 1, 
            'msg' => 'Section deleted successfully!' 
        ]; 
        echo json_encode($output);  
    }else{ 
        echo json_encode(['error' => 'Section Delete request failed!']); 
    } 
  }

//Professor

if ($jsonObj->request_type == 'addEditProfessor') {
    $professor_data = $jsonObj->professor_data;
    $last_name = !empty($professor_data[0]) ? $professor_data[0] : '';
    $first_name = !empty($professor_data[1]) ? $professor_data[1] : '';
    $middle_name = !empty($professor_data[2]) ? $professor_data[2] : '';
    $email = !empty($professor_data[3]) ? $professor_data[3] : '';
    $id = !empty($professor_data[4]) ? $professor_data[4] : 0;

    $err = '';
    if (empty($last_name)) {
        $err .= 'Please enter a Last Name.<br/>';
    }
    if (empty($first_name)) {
        $err .= 'Please enter a First Name.<br/>';
    }
    if (empty($middle_name)) {
        $err .= 'Please enter a Middle Name.<br/>';
    }
    if (empty($email)) {
        $err .= 'Please enter an Email.<br/>';
    }

    if (!empty($professor_data) && empty($err)) {
        if (!empty($id)) {
            // Update professor data in the database
            $sqlQ = "UPDATE tblprofessors SET last_name=?, first_name=?, middle_name=?, email=? WHERE id=?";
            $stmt = $conn->prepare($sqlQ);
            $stmt->bind_param("ssssi", $last_name, $first_name, $middle_name, $email, $id);
            $update = $stmt->execute();

            if ($update) {
                $output = [
                    'status' => 1,
                    'msg' => 'Professor record updated successfully!'
                ];
                echo json_encode($output);
            } else {
                echo json_encode(['error' => 'Professor update request failed!']);
            }
        } else {
            // Insert professor data into the database
            $sqlQ = "INSERT INTO tblprofessors (last_name, first_name, middle_name, email) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sqlQ);
            $stmt->bind_param("ssss", $last_name, $first_name, $middle_name, $email);
            $insert = $stmt->execute();

            if ($insert) {
                $output = [
                    'status' => 1,
                    'msg' => 'Professor added successfully!'
                ];
                echo json_encode($output);
            } else {
                echo json_encode(['error' => 'Professor adding request failed!']);
            }
        }
    } else {
        echo json_encode(['error' => trim($err, '<br/>')]);
    }
} elseif ($jsonObj->request_type == 'deleteProfessor') {
    $id = $jsonObj->professor_id;

    $sql = "DELETE FROM tblprofessors WHERE id=$id";
    $delete = $conn->query($sql);
    if ($delete) {
        $output = [
            'status' => 1,
            'msg' => 'Professor deleted successfully!'
        ];
        echo json_encode($output);
    } else {
        echo json_encode(['error' => 'Professor Delete request failed!']);
    }
}