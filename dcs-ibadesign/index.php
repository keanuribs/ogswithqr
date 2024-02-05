<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>DCS - Grading and Attendance </title>
  <meta name="title" content="DCS - Grading and Attendance">
  <meta name="description" content="">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="assets/images/dcss.png" type="image">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/indexstyle.css">
   <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">


</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">
      <a href="#" class="logo">
        <img src="./assets/images/dcs-logo-with-text.png" width="162" height="40" alt="DCS logo">
      </a>
  
      <nav class="navbar" data-navbar>
        <div class="wrapper">
          <a href="#" class="logo">
          <img src="./assets/images/dcs-logo-with-text.png" width="162" height="40" alt="DCS logo">
          </a>
          <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
            <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
          </button>
        </div>
  
        <ul class="navbar-list">
          <li class="navbar-item">
            <a href="#home" class="navbar-link" data-nav-link>Home</a>
          </li>
          <li class="navbar-item">
            <a href="#about" class="navbar-link" data-nav-link>About</a>
          </li>
          <li class="navbar-item">
            <a href="#courses" class="navbar-link" data-nav-link>Courses</a>
          </li>
          <li class="navbar-item" id="login-dropdown">
            <a href="#" class="navbar-link" data-nav-link>
              Login
              <i class='bx bx-chevron-down' class="down-icon"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a href="student/index.php">Student Login</a></li>
              <li><a href="faculty/index.php">Teacher Login</a></li>
            </ul>
          </li>
        </ul>
      </nav>
      
      <div class="header-actions">

        <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
          <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
        </button>

      </div>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="section hero has-bg-image" id="home" aria-label="home"
      style="background-image: url('./assets/images/deppic.jpg')">
<div class="container">
  <div class="hero-content">
    <!-- Remove the title, text, and button if you only want the image -->
  </div>
</div>
</section>


      <!-- 
        - #CATEGORY
      -->

      <section class="section category" aria-label="category">
        <div class="container">

          <p class="section-subtitle">The</p>
          <h2 class="h2 section-title">
            <span class="span">Department of Computer Studies</span>
          </h2>

          <p class="section-text">
            An alternative way to check your grades and attendance using QR codes! 
            Our platform is here to make school life simpler for everyone – <br>
            from administrators to teachers and students. Join us in exploring the future of education!
          </p>

        </div>
      </section>

      
      <!-- 
        - #COURSE
      -->

      <section class="section course" id="courses" aria-label="course">
        <div class="container">

          <h2 class="h2 section-title">OFFERED COURSES</h2>

          <ul class="grid-list">

            <li>
              <div class="course-card">

                <figure class="card-banner img-holder" style="--width: 370; --height: 150;">
                  <img src="./assets/images/bsit.jpg" width="150" height="150" loading="lazy"
                    alt="Java Programming Masterclass for Software Developers" class="img-cover">
                </figure>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Bachelor of Science in Information Technology</a>
                  </h3>

                  <div class="wrapper">

                    <p class="rating-text">Information technology encompasses both the hardware and software components of computer systems.</p>

                  </div>


                </div>

              </div>
            </li>

            <li>
              <div class="course-card">

                <figure class="card-banner img-holder" style="--width: 370; --height: 150;">
                  <img src="./assets/images/css.jpg" width="150" height="150" loading="lazy"
                    alt="The Complete Camtasia Course for Content Creators" class="img-cover">
                </figure>

                <div class="card-content">

                  <h3 class="h3">
                    <a href="#" class="card-title">Bachelor of Science in Computer Science</a>
                  </h3>

                  <div class="wrapper">
                    <p class="rating-text">Computer Science is the study of computers and everything related to them with the end goal of processing information.</p>
                  </div>

                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top section">
      <div class="container grid-list">

        <div class="footer-brand">

          <a href="#" class="logo">
            <img src="./assets/images/dcss.png" width="50" height="50" alt="EduWeb logo">
          </a>

          <p class="footer-brand-text">
            Our faculty work keenly to provide advance knowledge and relevant education to produce
            skilled graduates who are ready to meet industry demands.
          </p>

          <div class="wrapper">
            <span class="span">Phone: </span>
            <address class="address">(046) 471-6607</address>
          </div>

          <div class="wrapper">
            <span class="span">Email:</span>
            <a href="dcsimus@cvsu.edu.ph" class="footer-link">dcsimus@cvsu.edu.ph</a>
          </div>

        </div>

        

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Links</p>
          </li>

          <li>
            <a href="#" class="footer-link">Home</a>
          </li>

          <li>
            <a href="#" class="footer-link">About</a>
          </li>

          <li>
            <a href="#" class="footer-link">Courses</a>
          </li>
        </ul>

        <div class="footer-list">

          <p class="footer-list-title">Follow Us</p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-youtube"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

      </div>
    </div>

  </footer>





  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="back top top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/indexscript.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>