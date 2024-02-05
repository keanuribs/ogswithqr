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



var studentListTable = new DataTable('#studentList', {
  responsive: true,
  "processing": true,
  "serverSide": true,
  "ajax": "fetchData.php",  // Update this line to match your actual file name
  "columnDefs": [
    { "orderable": false, "targets": 8 }
  ]
});



function addStudentData() { 
    $('.frm-status').html('');
    $('#userModalLabel').html('Add New Student');
    $('#studentLastName').val('');
    $('#studentFirstName').val('');
    $('#studentMiddleName').val('');
    $('#studentNumber').val('');
    $('#course').val('');
    $('#year').val('');
    $('#section').val('');
    $('#studentID').val(0);
    $('#userDataModal').modal('show');
}
// Attach click event to the "Add New User" button
$(document).on('click', '#addStudentBtn', function() {
  addStudentData();
});

document.addEventListener('click', function (event) {
  if (event.target.classList.contains('edit-btn')) {
      // Extract the data attribute value
      let userData = event.target.getAttribute('data-user-data');

      // Parse the JSON data
      try {
          userData = JSON.parse(userData);

          // Now you can use userData in your function
          editData(userData);
      } catch (error) {
          console.error('Error parsing JSON:', error);
      }
  }
});


function editData(student_data){
  $('.frm-status').html('');
  $('#userModalLabel').html('Edit Student # '+student_data.student_number);
  $('#studentLastName').val(student_data.last_name);
  $('#studentFirstName').val(student_data.first_name);
  $('#studentMiddleName').val(student_data.middle_name);
  $('#studentNumber').val(student_data.student_number);
  $('#course').val(student_data.course);
  $('#years').val(student_data.year);
  $('#section').val(student_data.section); // Add this line for the 'section' input
  $('#studentID').val(student_data.id);
  $('#userDataModal').modal('show');
}




function submitStudentData(){
  $('.frm-status').html('');
  let input_data_arr = [
      document.getElementById('studentLastName').value,
      document.getElementById('studentFirstName').value,
      document.getElementById('studentMiddleName').value,
      document.getElementById('studentNumber').value,
      document.getElementById('course').value,
      document.getElementById('year').value,
      document.getElementById('section').value,
      document.getElementById('studentID').value
  ];
  fetch("eventHandler.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ request_type:'addEditUser', student_data: input_data_arr}),
  })
  .then(response => response.json())
  .then(data => {
      if (data.status == 1) {
          Swal.fire({
              title: data.msg,
              icon: 'success',
          }).then((result) => {
              // Redraw the table
              studentListTable.draw();
              $('#userDataModal').modal('hide');
              $("#userDataFrm")[0].reset();
          });
      } else {
          $('.frm-status').html('<div class="alert alert-danger" role="alert">'+data.error+'</div>');
      }
  })
  .catch(console.error);
}
// Attach click event to the "Add New User" button
$(document).on('click', '#submitStudentBtn', function() {
  submitStudentData();
});

// Use event delegation to capture clicks on the document
document.addEventListener('click', function (event) {
  // Check if the clicked element has the class 'delete-btn'
  if (event.target.classList.contains('delete-btn')) {
    // Extract the data attribute value
    let studentId = event.target.getAttribute('data-student-id');

    // Call the deleteData function with the student ID
    deleteData(studentId);
  }
});

// app2.js

// Use event delegation to capture clicks on the document
document.addEventListener('click', function (event) {
  // Check if the clicked element has the class 'delete-btn'
  if (event.target.classList.contains('delete-btn')) {
    // Extract the data attribute value
    let studentId = event.target.getAttribute('data-student-id');

    // Call the deleteData function with the student ID
    deleteData(studentId);
  }
});

// Your existing deleteData function
function deleteData(studentId) {
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
        body: JSON.stringify({ request_type: 'deleteStudent', student_id: studentId }),
      })
        .then(response => response.json())
        .then(data => {
          if (data.status == 1) {
            Swal.fire({
              title: data.msg,
              icon: 'success',
            }).then((result) => {
              studentListTable.draw();
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