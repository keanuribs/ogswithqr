import 'https://code.jquery.com/jquery-3.7.0.js';
import 'https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js';
import 'https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js';
import 'https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js';
import 'https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js';

new DataTable('#example', {
  responsive: true
});


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
menuBar.addEventListener("click", () => {
  sideBar.classList.toggle("hide");
});

let switchMode = document.getElementById("switch-mode");
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

let searchFrom = document.querySelector(".content nav form");
let searchBtn = document.querySelector(".search-btn");
let searchIcon = document.querySelector(".search-icon");
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

