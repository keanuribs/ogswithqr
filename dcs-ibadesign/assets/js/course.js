// jQuery library for DOM manipulation and other utility functions
import 'https://code.jquery.com/jquery-3.7.0.js';
// DataTables library for enhanced HTML tables and data manipulation
import 'https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js';
// DataTables Bootstrap 5 extension for Bootstrap styling integration
import 'https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js';
// DataTables Responsive extension for creating responsive tables
import 'https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js';
// DataTables Responsive Bootstrap 5 extension for responsive tables with Bootstrap styling
import 'https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js';
//SweetAlert2 library for creating modals


import 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js';


var CourseListTable = $('#CourseList').DataTable({
  responsive: true,
 "processing": true,
 "serverSide": true,
 "ajax": "fetchCourseData.php",
 "columnDefs": [
     { "orderable": false, "targets": 2 }
 ]
});

$(document).ready(function(){
 CourseListTable.draw();
});

function addcourseData() { 
  $('.frm-status').html('');
  $('#courseModalLabel').html('Add Course');
  $('#course').val('');
  $('#courseID').val(0);
  $('#courseDataModal').modal('show');
}
// Attach click event to the "Add New User" button
$(document).on('click', '#addcourseBtn', function() {
addcourseData();
});

document.addEventListener('click', function (event) {
  if (event.target.classList.contains('edit-btn')) {
      // Extract the data attribute value
      let courseData = event.target.getAttribute('data-course-data');

      // Parse the JSON data
      try {
          courseData = JSON.parse(courseData);

          // Now you can use userData in your function
          editCourseData(courseData);
      } catch (error) {
          console.error('Error parsing JSON:', error);
      }
  }
});


function editCourseData(course_data){
  $('.frm-status').html('');
  $('#userModalLabel').html('Edit Course');
  $('#course').val(course_data.course);
  $('#courseID').val(course_data.id);
  $('#courseDataModal').modal('show');
}



function submitCourseData(){
  $('.frm-status').html('');
  let input_data_arr = [
      document.getElementById('course').value,
      document.getElementById('courseID').value
  ];
  fetch("eventHandler.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ request_type:'addEditCourse', course_data: input_data_arr}),
  })
  .then(response => response.json())
  .then(data => {
      if (data.status == 1) {
          Swal.fire({
              title: data.msg,
              icon: 'success',
          }).then((result) => {
              // Redraw the table
              CourseListTable.draw();
              $('#courseDataModal').modal('hide');
              $("#courseDataFrm")[0].reset();
          });
      } else {
          $('.frm-status').html('<div class="alert alert-danger" role="alert">'+data.error+'</div>');
      }
  })
  .catch(console.error);
}
// Attach click event to the "Add New User" button
$(document).on('click', '#submitCourseBtn', function() {
  submitCourseData();
});

// Use event delegation to capture clicks on the document
document.addEventListener('click', function (event) {
  // Check if the clicked element has the class 'delete-btn'
  if (event.target.classList.contains('delete-btn')) {
    // Extract the data attribute value
    let courseId = event.target.getAttribute('data-course-id');

    // Call the deleteData function with the student ID
    deleteData(courseId);
  }
});


// Your existing deleteData function
function deleteData(courseId) {
  Swal.fire({
    title: 'Are you sure to Archive?',
    text: 'You won\'t be able to revert this!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, archive it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Delete event
      fetch("eventHandler.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ request_type: 'deletecourse', course_id: courseId }),
      })
        .then(response => response.json())
        .then(data => {
          if (data.status == 1) {
            Swal.fire({
              title: data.msg,
              icon: 'success',
            }).then((result) => {
              CourseListTable.draw();
            });
          } else {
            Swal.fire(data.error, '', 'error');
          }
        })
        .catch(console.error);
    } else {
      Swal.close();
    }
  });
}