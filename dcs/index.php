<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="css/landingstyle.css" />
    <link rel="icon" href="image/dcss.png" type="image" />
    <title>DCS Online Grading</title>
  </head>
  <body>

    <div class="nav__container">

    </div>
    <nav class="navigator">
      <div class="nav__logo">
        <a href="#"><img src="image/dcss.png" alt="Department of Computer Studies">Department of Computer Studies</a>
      </div>
      <ul class="nav__links" id="nav-links">
        <li class="active"><a href="#home">Home</a></li>
        <li class="link"><a href="#about2">About</a></li>
        <li class="link"><a href="#programs">Programs</a></li>
        <li class="link"><a href="#contact">Contact</a></li>
        <li class="link"><a href="login.php">Login</a></li>
      </ul>
      <div class="nav__menu__btn" id="menu-btn">
        <span><i class="ri-menu-3-line"></i></span>
      </div>
    </nav>

    <header class="section__container header__container" id="home">
      <div class="header__content">
        
        <h1>Department of Computer Studies</h1>
        <div class="header__content__details">
          <p>
            Grading Today, Grading Tomorrow
          </p>
          <a class="header__content__btn" href="#about2">Read More</a>
        </div>
      </div>
      <div class="header__image">
        <div class="image-overlay"></div>
        <img src="image/deppic.jpg" alt="header" />
      </div>

    </header>

    <section class="section__container about__container" id="about">
      <div class="about__header">
        <div class="about__image">
          <img src="image/objectives.jpg" alt="about" />
        </div>
        <div class="about__content">
          <h2 class="section__header">Objectives</h2>
          <p class="paragraph">
            The Department of Computer Studies through its curricular programs in Computer Science and Information Technology aims to produce graduates who shall be young skilled professionals, and globally competitive and morally upright individuals.<br><br>
            Specifically, it strives to:<br><Br>
              • Give students advance knowledge through a research work and respond effectively to changing societal needs and conditions;<br><br>
              • Promote leadership, develop and apply IT skills for the improvement of the quality of life; and <br><br>
              • Provide students both local and International careers not only in the IT industry but in various fields such as medicine, arts, entertainment, engineering, communication, and a lot more. <br><br>
          </p>
        </div>
      </div>
    </section>

    <section class="section2__container about2__container" id="about2" >
      <div class="about2__header" >
        <div class="about2__content">
          <h2 class="section__header" >DCS Department</h2>
          <p class="paragraph">
            Department of Computer Studies offers Bachelor of Science in Computer Science (BSCS), Bachelor of Science in Information Technology (BSIT) which features a CHED-based curriculum, competent faculty, involved students in learning development programs.
            <br><br>
            Our faculty work keenly to provide advance knowledge and relevant education to produce skilled graduates who are ready to meet industry demands.
          </p>
        </div>
        <div class="about2__image">
          <img src="image/banner.jpg" alt="about" />
        </div>
      </div>
    </section>

    <section class="philosophy" id="philosophy">
      <div class="section__container philosophy__container">
        <h2 class="section__header">
          PHILOSOPHY
        </h2>
        <div class="philosophy_text">
          <p>
            Guided with the University’s Vision and Mission, the Department of Information Technology adheres to provide venue for the pursuit of excellence in computer education and information technology, and to prepare students and educators of the highest quality in comparison with its neighboring competitors.
          </p>
        </div>
      </div>
    </section>

    <section class="section__container news__container" id="programs">
      <h2 class="section__header">Programs Offered</h2>
      <div class="news__grid">
        <div class="news__card">
          <img src="image/dcss.png" alt="DCS" />
          <div>
            <h4>Department of Computer Studies - Imus Campus</h4>
            <p>
              As of now, Cavite State University-Imus Campus' Department of Computer Studies offers 2 programs. 
              Would I rather be feared or loved? Easy. Both. I want people to be afraid of how much they love me.
            </p>
          </div>
        </div>
        <div class="news__card">
          <img src="image/bsit.jpg" alt="BSIT" />
          <div>
            <h4>Bachelor of Science in Information Technology</h4>
            <p>
              Information technology encompasses both the hardware and software components of computer systems.
            </p>
          </div>
        </div>
        <div class="news__card">
          <img src="image/css.jpg" alt="BSCS" />
          <div>
            <h4>Bachelor of Science in Computer Science</h4>
            <p>
              Computer Science is the study of computers and everything related to them with the end goal of processing information.
            </p>
          </div>
        </div>
      </div>
    </section>
    

    <footer class="section__container footer__container" id="contact">
      <div class="footer__col">
        <h5><a href="#">DCS - Imus Cavite</a></h5>
        <br>
        <p>Cavite Civic Center, Palico IV, Imus City, Cavite<br><br>
          <strong>Phone:</strong>(046) 471-6607<br>
          <strong>Email:</strong>dcsimus@cvsu.edu.ph<br>
        </p>
        
    
      </div>
      <div class="footer__col">
        <h4>Useful Links:</h4>
          <ul>
            <li><i class="ri-arrow-right-s-line"></i><a href="#home">Home </a></li>
            <li><i class="ri-arrow-right-s-line"></i><a href="#about2">About</a></li>
            <li><i class="ri-arrow-right-s-line"></i><a href="#about">Objectives</a></li>
            <li><i class="ri-arrow-right-s-line"></i><a href="#philosophy">Philosophy</a></li>
            <li><i class="ri-arrow-right-s-line"></i><a href="#programs">Programs Offered</a></li>
          </ul>        
      </div>
      <div class="footer__col">
        <h4>About Us</h4>
        <p>
          Our faculty work keenly to provide advance knowledge and relevant 
          education to produce skilled graduates who are ready to meet industry demands.
        </p>
      </div>
      <div class="footer__col">
        <h4>Subscribe</h4>
        <form action="/">
          <input type="text" placeholder="Your Email" />
          <button><i class="ri-send-plane-2-fill"></i></button>
        </form>
        <div class="footer__socials">
          <h4>Follow Us</h4>
          <div>
            <a href="https://www.facebook.com/dcsimusofficial"><i class="ri-facebook-box-fill"></i></a>
            <a href="https://cvsu-imus.edu.ph/academics/departments/department-of-computer-studies"><i class="ri-pages-line"></i></a>
          </div>
        </div>
      </div>
    </footer>

    <a href="#" class="back-to-top"><i class="ri-arrow-up-fill"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
  
    <script src="js/main.js"></script>
  </body>
</html>
