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


var professorListTable = $('#professorList').DataTable({
  responsive: true,
 "processing": true,
 "serverSide": true,
 "ajax": "fetchProfessorData.php", // Change the file name accordingly
 "columnDefs": [
     { "orderable": false, "targets":  5} // Adjust the number of columns accordingly
 ]
});

$(document).ready(function(){
 professorListTable.draw();
});

function addProfessorData() { 
   $('.frm-status').html('');
   $('#professorModalLabel').html('Add New Professor');
   $('#professorLastName').val('');
   $('#professorFirstName').val('');
   $('#professorMiddleName').val('');
   $('#professorEmail').val('');
   $('#professorID').val(0);
   $('#professorDataModal').modal('show');
}

// Attach click event to the "Add New Professor" button
$(document).on('click', '#addProfessorBtn', function() {
 addProfessorData();
});

document.addEventListener('click', function (event) {
 if (event.target.classList.contains('edit-professor-btn')) {
     // Extract the data attribute value
     let professorData = event.target.getAttribute('data-professor-data');

     // Parse the JSON data
     try {
         professorData = JSON.parse(professorData);

         // Now you can use professorData in your function
         editProfessorData(professorData);
     } catch (error) {
         console.error('Error parsing JSON:', error);
     }
 }
});

function editProfessorData(professor_data){
 $('.frm-status').html('');
 $('#professorModalLabel').html('Edit Professor # '+professor_data.email);
 $('#professorLastName').val(professor_data.last_name);
 $('#professorFirstName').val(professor_data.first_name);
 $('#professorMiddleName').val(professor_data.middle_name);
 $('#professorEmail').val(professor_data.email);
 $('#professorID').val(professor_data.id);
 $('#professorDataModal').modal('show');
}

function submitProfessorData(){
 $('.frm-status').html('');
 let input_data_arr = [
     document.getElementById('professorLastName').value,
     document.getElementById('professorFirstName').value,
     document.getElementById('professorMiddleName').value,
     document.getElementById('professorEmail').value,
     document.getElementById('professorID').value
 ];
 fetch("eventHandler.php", { // Change the file name accordingly
     method: "POST",
     headers: { "Content-Type": "application/json" },
     body: JSON.stringify({ request_type:'addEditProfessor', professor_data: input_data_arr}),
 })
 .then(response => response.json())
 .then(data => {
     if (data.status == 1) {
         Swal.fire({
             title: data.msg,
             icon: 'success',
         }).then((result) => {
             // Redraw the table
             professorListTable.draw();
             $('#professorDataModal').modal('hide');
             $("#professorDataFrm")[0].reset();
         });
     } else {
         $('.frm-status').html('<div class="alert alert-danger" role="alert">'+data.error+'</div>');
     }
 })
 .catch(console.error);
}

// Attach click event to the "Submit Professor" button
$(document).on('click', '#submitProfessorBtn', function() {
 submitProfessorData();
});

// Use event delegation to capture clicks on the document
document.addEventListener('click', function (event) {
 // Check if the clicked element has the class 'delete-professor-btn'
 if (event.target.classList.contains('delete-professor-btn')) {
   // Extract the data attribute value
   let professorId = event.target.getAttribute('data-professor-id');

   // Call the deleteProfessorData function with the professor ID
   deleteProfessorData(professorId);
 }
});

// Your existing deleteData function for students
function deleteData(studentId) {
 Swal.fire({
   title: 'Are you sure to Delete?',
   text: 'You won\'t be able to revert this!',
   icon: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, delete it!'
 }).then((result) => {
   if (result.isConfirmed) {
     // Delete student event
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

// New function to delete professors
function deleteProfessorData(professorId) {
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
     // Delete professor event
     fetch("eventHandler.php", { // Change the file name accordingly
       method: "POST",
       headers: { "Content-Type": "application/json" },
       body: JSON.stringify({ request_type: 'deleteProfessor', professor_id: professorId }),
     })
       .then(response => response.json())
       .then(data => {
         if (data.status == 1) {
           Swal.fire({
             title: data.msg,
             icon: 'success',
           }).then((result) => {
             professorListTable.draw();
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












// JAVACSRIPT FOR THE MENU BAR
let sideMenu = document.querySelectorAll(".nav-link");

sideMenu.forEach((item) => {
  let li = item.parentElement;
  item.addEventListener("click", () => {
    sideMenu.forEach((link) => {
      link.parentElement.classList.remove("active");
    });

    li.classList.add("active");
  });
});

let menuBar = document.querySelector(".menu-btn");
let sideBar = document.querySelector(".sidebar");
let switchMode = document.getElementById("switch-mode");
let searchFrom = document.querySelector(".content nav form");
let searchBtn = document.querySelector(".search-btn");
let searchIcon = document.querySelector(".search-icon");

// Check if sidebar state is stored in localStorage
const isSidebarHidden = localStorage.getItem("sidebarHidden") === "true";
if (isSidebarHidden) {
  sideBar.classList.add("hide");
}


menuBar.addEventListener("click", () => {
  sideBar.classList.toggle("hide");
  // Store the state of the sidebar in localStorage
  localStorage.setItem("sidebarHidden", sideBar.classList.contains("hide"));
});

switchMode.addEventListener("change", (e) => {
  if (e.target.checked) {
    document.body.classList.add("dark");
  } else {
    document.body.classList.remove("dark");
  }
});

let arrows = document.querySelectorAll(".arrow");
for (var i = 0; i < arrows.length; i++) {
  arrows[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement; // selecting the main parent of the arrow
    arrowParent.classList.toggle("showMenu");
  });
}

searchBtn.addEventListener("click", (e) => {
  if (window.innerWidth < 576) {
    e.preventDefault();
    searchFrom.classList.toggle("show");
    if (searchFrom.classList.contains("show")) {
      searchIcon.classList.replace("fa-search", "fa-times");
    } else {
      searchIcon.classList.replace("fa-times", "fa-search");
    }
  }
});

window.addEventListener("resize", () => {
  if (window.innerWidth > 576) {
    searchIcon.classList.replace("fa-times", "fa-search");
    searchFrom.classList.remove("show");
  }
  if (window.innerWidth < 768) {
    sideBar.classList.add("hide");
  }
});

if (window.innerWidth < 768) {
  sideBar.classList.add("hide");
}
// JAVASCRIPT FOR THE MENU BAR