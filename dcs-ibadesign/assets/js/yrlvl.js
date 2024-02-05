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



// Year Level

var yrLvlListTable = $('#yrLvlList').DataTable({
   responsive: true,
  "processing": true,
  "serverSide": true,
  "ajax": "fetchYrLvlData.php",
  "columnDefs": [
      { "orderable": false, "targets": 2 }
  ]
});

$(document).ready(function(){
  yrLvlListTable.draw();
});



function addYrLvlData() { 
    $('.frm-status').html('');
    $('#yrlLvlModalLabel').html('Add Year Level');
    $('#yrLvl').val('');
    $('#yrLvlID').val(0);
    $('#yrLvlDataModal').modal('show');
}
// Attach click event to the "Add New User" button
$(document).on('click', '#addYrLvlBtn', function() {
  addYrLvlData();
});

document.addEventListener('click', function (event) {
  if (event.target.classList.contains('edit-btn')) {
      // Extract the data attribute value
      let yrLvlData = event.target.getAttribute('data-yrLvl-data');

      // Parse the JSON data
      try {
          yrLvlData = JSON.parse(yrLvlData);

          // Now you can use userData in your function
          editData(yrLvlData);
      } catch (error) {
          console.error('Error parsing JSON:', error);
      }
  }
});


function editData(yrLvl_data){
  $('.frm-status').html('');
  $('#userModalLabel').html('Edit Student Year Level');
  $('#yrLvl').val(yrLvl_data.yr_lvl);
  $('#yrLvlID').val(yrLvl_data.id);
  $('#yrLvlDataModal').modal('show');
}



function submitYrLvlData(){
  $('.frm-status').html('');
  let input_data_arr = [
      document.getElementById('yrLvl').value,
      document.getElementById('yrLvlID').value
  ];
  fetch("eventHandler.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ request_type:'addEditYrLvl', yrLvl_data: input_data_arr}),
  })
  .then(response => response.json())
  .then(data => {
      if (data.status == 1) {
          Swal.fire({
              title: data.msg,
              icon: 'success',
          }).then((result) => {
              // Redraw the table
              yrLvlListTable.draw();
              $('#yrLvlDataModal').modal('hide');
              $("#yrLvlDataFrm")[0].reset();
          });
      } else {
          $('.frm-status').html('<div class="alert alert-danger" role="alert">'+data.error+'</div>');
      }
  })
  .catch(console.error);
}
// Attach click event to the "Add New User" button
$(document).on('click', '#submitYrLvlBtn', function() {
  submitYrLvlData();
});


// Use event delegation to capture clicks on the document
document.addEventListener('click', function (event) {
  // Check if the clicked element has the class 'delete-btn'
  if (event.target.classList.contains('delete-btn')) {
    // Extract the data attribute value
    let yrLvlId = event.target.getAttribute('data-yrLvl-id');
    
    console.log('yrLvlId:', yrLvlId);

    // Call the deleteData function with the student ID
    deleteYrLvlData(yrLvlId);
  }
});

// Your existing deleteData function
function deleteYrLvlData(yrLvlId) {
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
        body: JSON.stringify({ request_type: 'deleteyearLvl', yrLvl_id: yrLvlId }),
      })
        .then(response => response.json())
        .then(data => {
          if (data.status == 1) {
            Swal.fire({
              title: data.msg,
              icon: 'success',
            }).then((result) => {
              yrLvlListTable.draw();
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




var SectionListTable = $('#SectionList').DataTable({
  responsive: true,
 "processing": true,
 "serverSide": true,
 "ajax": "fetchCourseData.php",
 "columnDefs": [
     { "orderable": false, "targets": 2 }
 ]
});

$(document).ready(function(){
 SectionListTable.draw();
});













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