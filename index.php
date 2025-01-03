<?php
require_once 'connection/db.php';
$aboutResult = $db->conn->query("SELECT COUNT(*) AS total FROM about");
$aboutRow = $aboutResult->fetch_assoc();
if ($aboutRow['total'] == 0) {
    $defaultContentNeeded['about'] = true;
}

// Check if experience table is empty
$experienceResult = $db->conn->query("SELECT COUNT(*) AS total FROM experience");
$experienceRow = $experienceResult->fetch_assoc();
if ($experienceRow['total'] == 0) {
    $defaultContentNeeded['experience'] = true;
}

// Check if projects table is empty
$projectsResult = $db->conn->query("SELECT COUNT(*) AS total FROM projects");
$projectsRow = $projectsResult->fetch_assoc();
if ($projectsRow['total'] == 0) {
    $defaultContentNeeded['projects'] = true;
}


// Load static content from default.html
$defaultContent = file_get_contents('default.html');
$dom = new DOMDocument();
libxml_use_internal_errors(true); //HTML warnings
$dom->loadHTML($defaultContent);
libxml_clear_errors();

// default.html
$defaultSections = [
    'hero' => $dom->saveHTML($dom->getElementById('hero')),
    'about' => $dom->saveHTML($dom->getElementById('about')),
    'experience' => $dom->saveHTML($dom->getElementById('experience')),
    'projects' => $dom->saveHTML($dom->getElementById('projects')),
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <nav>
        <ul class="side">
            <li onclick = "hideSideBar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#experience">Experience</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <ul>
            <h3><span style="color: #3b6d91;">A</span>fomiya</h3>
            <li class="hide"><a href="#about">About</a></li>
            <li class="hide"><a href="#experience">Experince</a></li>
            <li class="hide"><a href="#projects">Projects</a></li>
            <li class="hide"><a href="#contact">contact</a></li>
            <li onclick = "showSideBar()" class="menu"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="#5f6368"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>

        </ul>
    </nav>
    <!-- Hero Section -->
<header class="hero">
  <div class="profile-container">
    <img src="me.jpeg" alt="Afomiya Mesfin">
  </div>
  <div class="header-content">
    <h1>Hello, I'm <span style="color: #3b6d91;">A</span>fomiya Mesfin</h1>
    <p>Web Designer</p>
    <div class="btn-container">  
        <button><a href="#contact">contact info</a></button>
      </div>
  </div>
 
</header>

<section id="about" class="about-section">
<h2>About Me</h2>
<?php
    $aboutContent = $db->manageAbout('read');
    if ($aboutContent->num_rows > 0) {
        while ($row = $aboutContent->fetch_assoc()) {
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    
        }
    }
    ?>
    <div class="container1">
        <div class="profile-photo">
            <img src="me2.jpg"  class="profile-photo"> 
            <?php
    $aboutContent = $db->manageAbout('read');
    if ($aboutContent->num_rows > 0) {
        while ($row= $aboutContent->fetch_assoc()) {
            if (!empty($row['picture'])) {
                echo "<img src='" . htmlspecialchars($row['picture']) . "' alt='About Picture'>";
            }
           
        }
    }
    ?>
          </div>
          <div class="about-content">
     <p>I'm Afomiya Mesfin, a motivated web developer with growing expertise in frontend technologies and a keen interest in expanding my backend skill
    While I'm currently exploring the world of backend development, my strengths lie in crafting responsive, user-friendly websites using HTML, CSS, and JavaScript.        
    </p>
    
    <p>I'm eager to learn and apply these skills to create more complex web applications, focusing on improving user experiences and delivering efficient solutions.
        As I continue my journey into backend development, I'm excited about the opportunity to learn and grow.
        My goal is to develop a well-rounded skill set that allows me to contribute effectively to both frontend and backend aspects of web projects.
               
    </p>
    <?php
    $aboutContent = $db->manageAbout('read');
    if ($aboutContent->num_rows > 0) {
        while ($row = $aboutContent->fetch_assoc()) {
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
           
        }
    }
    ?>
    </div>

    </div>

    
   
   
</section>

<!-- Experience Section -->
<h2 class="experience-head"  id="experience">Experience</h2>
<section id="experience" class="experience-section">
<div class="container">
        <h3>frontend development</h3>
        <p><span>HTML</span>: intermediate</p>
        <p><span>CSS</span>: intermediate</p>
        <p><span>JavaScript</span>: basic</p>
        <?php
    $experienceContent = $db->manageExperience('read');
    if ($experienceContent->num_rows > 0) {
        while ($row = $experienceContent->fetch_assoc()) {
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
           
        }
    }
    ?>  
      
    </div>
    <div class="container">
        <h3>Backend development</h3>
        <p><span>PHP</span>: basic</p>
        <p><span>C#</span>: basic</p>
        <?php
    $experienceContent = $db->manageExperience('read');
    if ($experienceContent->num_rows > 0) {
        while ($row = $experienceContent->fetch_assoc()) {
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
           
        }
    }
    ?>
    </div>
   
</section>

<!-- Projects Section -->
<div class="project-head" id="projects"> <h2>Projects</h2></div>
<section id="projects" class="projects-section">
     
<div class="container1">
        <div class="project-photo">
            <img src="mind.avif">  
            <div class="ptoject-para"><h4>Mindful Moments</h4><p>Will provide the website link soon.</p></div>
            <?php
    $projectContent = $db->manageProject('read');
    if ($projectContent->num_rows > 0) {
        while ($row = $projectContent->fetch_assoc()) {
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<a href='" . htmlspecialchars($row['url_link']) . "' target='_blank'>View Project</a>";
            if (!empty($row['picture'])) {
                echo "<img src='" . htmlspecialchars($row['picture']) . "' alt='Project Picture'>";
            }
        }
    }
    ?>
        </div>
        
    </div>
   
     
</section>
<section id="contact" class="contact-section">
    <h2>Contact Me</h2>
    <div class="contact-links">
        <a href="mailto:afomiyamesfin@gmail.com">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/></svg>
            afomiyamesfin@gmail.com
        </a>

        <a href="https://www.linkedinmobileapp.com/\?trk\=qrcode-onboarding" target="_parent">
            <img src="linkedin.png">
            LinkedIn 
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <ul class="top-nav">
        <li><a href="#about">About</a></li>
        <li><a href="#experience">Experience</a></li>
        <li><a href="#projects">Projects</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
</footer>
<div class="footer">
    &copy; 2024 Afomiya Mesfin. All rights reserved.
</div>

    <script src="home.js"></script>

</body>
</html>