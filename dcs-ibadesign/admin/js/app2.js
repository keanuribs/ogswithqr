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
// SweetAlert2 library for creating modals
import 'https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js';

// DataTable initialization
var studentListTable = $('#studentList').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
    "ajax": "fetchStudentData.php", // Adjust the path based on your file structure
    "columnDefs": [
        { "orderable": false, "targets": 8 }
    ]
});

// Redraw the table on document ready
$(document).ready(function () {
    studentListTable.draw();
});

// Function to open the modal for adding a new student
function addStudentData() {
    $('.frm-status').html('');
    $('#studentModalLabel').html('Add New Student');
    // Clear input fields
    $('#studentLastName').val('');
    $('#studentFirstName').val('');
    $('#studentMiddleName').val('');
    $('#studentNumber').val('');
    $('#course').val('');
    $('#year').val('');
    $('#section').val('');
    $('#studentID').val(0);
    // Show the modal
    $('#studentDataModal').modal('show');
}

// Attach click event to the "Add New Student" button
$(document).on('click', '#addStudentBtn', function () {
    addStudentData();
});

// Function to open the modal for editing a student
function editData(student_data) {
    $('.frm-status').html('');
    $('#studentModalLabel').html('Edit Student # ' + student_data.student_number);
    // Populate input fields with student data
    $('#studentLastName').val(student_data.last_name);
    $('#studentFirstName').val(student_data.first_name);
    $('#studentMiddleName').val(student_data.middle_name);
    $('#studentNumber').val(student_data.student_number);
    $('#course').val(student_data.course);
    $('#year').val(student_data.year);
    $('#section').val(student_data.section);
    $('#studentID').val(student_data.id);
    // Show the modal
    $('#studentDataModal').modal('show');
}

// Event listener for clicking the "Edit" button
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

// Function to submit student data
function submitStudentData() {
    $('.frm-status').html('');
    // Get input values
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
    // Send data to the server using fetch
    fetch("eventHandlerStudent.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ request_type: 'addEditUser', student_data: input_data_arr }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.status == 1) {
                // Display success message with Swal
                Swal.fire({
                    title: data.msg,
                    icon: 'success',
                }).then((result) => {
                    // Redraw the table
                    studentListTable.draw();
                    // Hide the modal
                    $('#studentDataModal').modal('hide');
                    // Reset the form
                    $("#studentDataFrm")[0].reset();
                });
            } else {
                // Display error message
                $('.frm-status').html('<div class="alert alert-danger" role="alert">' + data.error + '</div>');
            }
        })
        .catch(console.error);
}

// Attach click event to the "Submit" button
$(document).on('click', '#submitStudentBtn', function () {
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

// Function to delete a student
function deleteData(studentId) {
    // Display confirmation modal with Swal
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
            fetch("eventHandlerStudent.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ request_type: 'deleteStudent', student_id: studentId }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status == 1) {
                        // Display success message with Swal
                        Swal.fire({
                            title: data.msg,
                            icon: 'success',
                        }).then((result) => {
                            // Redraw the table
                            studentListTable.draw();
                        });
                    } else {
                        // Display error message
                        Swal.fire(data.error, '', 'error');
                    }
                })
                .catch(console.error);
        } else {
            // Close the Swal modal
            Swal.close();
        }
    });
}
