<?php
     include('include/connect.php');
     
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles.css">
   
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital@1&display=swap" rel="stylesheet"> <!--fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--icons-->

    <title>Catch Careers Website</title>

</head>

<body>
    <nav class="navbar" id="navbar">
        <h2 class="navbar-logo"><a href="home.php">CatchCareer</a></h2>
        <div class="navbar-menu">
            <a href="#job-list"><b>Jobs</b></a>
            <a href="#companues"><b>Companies</b></a>
            <a href="#CareerA"><b>Career Advice</b></a>
            <a href="#Feedback"><b>Feedback</b></a>
            <a href="#Footer-wrapper"><b>About</b></a>
            <a href="login.php"><img src=""><b>LogIn</b></a>
        </div>
        <div class="menu-toggler">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>

    <header>
        <br><br><br><br><br>
        <h1 class="header-title">
            &nbsp;&nbsp;FIND YOUR <br><span>&nbsp;&nbsp;PERFECT JOB</span><br>&nbsp;&nbsp;EASILY
            <br><br><br><br><br>
        </h1>
    </header>
    <!--search bar-->
    <div class="search-wrapper">
        <div class="search-box">
            <div class="search-card">
                <input class="Search-input" type="text" placeholder="Search Your Job Here..">
                <button class="search-button" type="submit">Search job here</button>
            </div>
        </div>
    </div>
    <!--Filter boy by category-->
    <div class="filter-wrapper">
        <div class="filte-dropdown">
            <br><p>Filter Job By Category</p><br>
            <select class="Cfilter-select" id="category" name="category">
                <option>Category</option>
                <option>IT</option>
                <option>Human Resources</option>
                <option>Construction</option>
                <option>Technician</option>
                <option>Education</option>
                <option>Security</option>
                <option>Customer Service</option>
                <option>Architect</option>
                <option>Accountant</option>
            </select>
        </div>
    </div>
    
    <div class="filter-WrapperL">
        <div class="filte-dropdownL">
            <br><p>Filter Job By Location</p><br> 
            <select class="Lfilter-select" id="location" name="location" >
                <option>Sri-Lanka</option>
                <option>UK</option>
                <option>US</option>
                <option>USE</option>
                <option>Australia</option>
            </select>
        </div>
    </div>
    <div class="JTfilter-wrapper">
        <div class="JTfilter-dropdown">
            <br><p>Filter Job By Type</p><br> 
            <select class="JTfilter-select" id="type" name="type">
                <option>Full Time</option>
                <option>Part Time</option>
                <option>Contract</option>
                <option>Internship</option>
                <option>Temporary</option>
            </select>
        </div>
    </div>
    <!--Job List-->
    
<div class="job-list" id="job-list">
<?php
    include('include/connect.php');
/*
// Fetch job details from the database
$query = "SELECT JobID, JobTitle, JobType, Description, Requirement, adminID FROM job";
$result = mysqli_query($conn, $query);

// Check if any jobs are found
if (mysqli_num_rows($result) > 0) {
    // Loop through each job
    while ($row = mysqli_fetch_assoc($result)) {
        $jobID = $row['JobID'];
        $jobTitle = $row['JobTitle'];
        $jobType = $row['JobType'];
        $description = $row['Description'];
        $requirement = $row['Requirement'];
        $adminID = $row['adminID'];

        // Display job details in separate boxes
        echo '<div class="job-box">';
        echo '<h2>'.$jobTitle.'</h3>';
        echo '<br>';
        echo '<hr id="hr">';
        echo '<br>';
        echo '<p><strong>Job ID:</strong> '.$jobID.'</p>';
        echo '<p><strong>Job Type:</strong> '.$jobType.'</p>';
        echo '<p><strong>Description:</strong> '.$description.'</p>';
        echo '<p><strong>Requirement:</strong> '.$requirement.'</p>';
        echo '<p><strong>Admin ID:</strong> '.$adminID.'</p>';
        echo '<button id="display-job">Apply Job</button>';
        echo '</div>';
    }
} else {
    echo 'No jobs found.';
}

// Close the database connection
mysqli_close($conn);
?>    */



// Fetch job details from the database
$query = "SELECT JobID, JobTitle, JobType, 
Description, Requirement, adminID FROM job";
$result = mysqli_query($conn, $query);

// Check if any jobs are found
if (mysqli_num_rows($result) > 0) {
    // Counter variable to keep track of the displayed jobs
    $counter = 0;

    // Loop through each job
    while ($row = mysqli_fetch_assoc($result)) {
        $jobID = $row['JobID'];
        $jobTitle = $row['JobTitle'];
        $jobType = $row['JobType'];
        $description = $row['Description'];
        $requirement = $row['Requirement'];
      

        // Display job details in separate boxes
        echo '<div class="job-box'.($counter >= 3 ? ' hidden' : '').'">';
        echo '<h2>'.$jobTitle.'</h2>';
        echo '<br>';
        echo '<hr id="hr">';
        echo '<br>';
        echo '<p><strong>Job ID:</strong> '.$jobID.'</p>';
        echo '<p><strong>Job Type:</strong> '.$jobType.'</p>';
        echo '<p><strong>Description:</strong> '.$description.'</p>';
        echo '<p><strong>Requirement: </strong>'.$requirement.'</p>';
        
        echo '<button id="display-job" onclick="applyJob.php"><a href="applyJob.php">Apply Job</a>
  
        
        
        </button>';
        echo '</div>';

        $counter++;
    }

    // Show the "View More Jobs" button if there are more than three jobs
    if (mysqli_num_rows($result) > 3) {
        echo '<button id="view-more-btn">View More Jobs</button>';
    }
} else {
    echo 'No jobs found.';
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user'])) {
        $userID = $_SESSION['user']['userID']; // 'userID' value in your '$_SESSION['user']' array
        $jobID = $_POST['jobID'];
        
        // Perform any necessary form validation or data sanitization
        
        // Insert the application details into the database
        $sql = "INSERT INTO job_applications (user_id, job_id) VALUES ('$userID', '$jobID')";
        // Execute the SQL query using your database connection
        
        // Redirect the user to a success page or display a success message
        // header("Location: success.php");
        // exit();
    } else {
        // User is not logged in, display an error message
        echo "Please log in to apply for the job.";
    }
}
?>




<script>
  document.getElementById("display-job").addEventListener("click", function() {
    var isLoggedIn = <?php echo isset($_SESSION['userID']) ? 'true' : 'false'; ?>;
    if (!isLoggedIn) {
      $('#loginModal').modal('show');
    } else {
      // Proceed with the application process
      // You can redirect the user to the application page or perform any other desired action
    }
  });
</script>
</div>


 

    
    <!--Advices-->
    <section class="CareerA" id="CareerA">
        <h1 class="carrerAdvice">Some Advices From Experties</h1>
        <div class="CareeWrapper">
            <div class="careerCard">
                <img>
                <div class="CareerDetails">
                   <p>"Your work is going to fill a large part of your life, and the only way to be truly 
                    satisfied is to do what you believe is great work. And the only way to do great work 
                    is to love what you do." </p> 
                    <h3>Steve Jobs</h3>
                </div>
            </div>
            <div class="careerCard">
                <img>
                <div class="CareerDetails">
                   <p>"The only way to do great work is to love what you do."</p> 
                    <h3>Warren Buffett</h3>
                </div>
            </div>
            <div class="careerCard">
                <div class="CareerDetails">
                   <p>"Success is not the key to happiness. Happiness is the key to success. 
                    If you love what you are doing, you will be successful." </p> 
                    <h3>Albert Schweitze</h3>
                </div>
            </div>
            <div class="careerCard">
                <div class="CareerDetails">
                   <p>"The biggest risk is not taking any risk. In a world that's changing quickly, 
                    the only strategy that is guaranteed to fail is not taking risks."</p> 
                    <h3>Mark Zuckerberg</h3>
                </div>
            </div>
            
            <span id="dots">...</span><span id="more">
                <div class="a">
            <div class="careerCard">
                <div class="CareerDetails">
                   <p>"Believe you can and you're halfway there." </p> 
                    <h3>Theodore Roosevel </h3>
                </div>
            </div>
            <div class="careerCard">
                <div class="CareerDetails">
                   <p>"The only limit to our realization of tomorrow will be our doubts of today."</p> 
                    <h3>Franklin D. Roosevelt</h3>
                </div>
            </div>
            <div class="careerCard">
                <div class="CareerDetails">
                   <p>"Your time is limited, don't waste it living someone else's life."</p> 
                    <h3> Steve Jobs</h3>
                </div>
            </div>
            <div class="careerCard">
                <div class="CareerDetails">
                   <p>"Success is not final, failure is not fatal: It is the courage to continue that counts."</p> 
                    <h3>Winston Churchill</h3>
                </div>
            </div>
        </div>
        <br></span>
        </div>
        <button onclick="moreFunction()" id="btnmore">View More</button>
    </section>

    <section class="Feedback" id="Feedback">
        <h1 class="feedbak-title">
            Let's see what our Beneficiaries say about us

        </h1>

        <?php

          

        

$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="feedback-box">';
        echo '<h3> ' . $row['UserName'] . '</h3>';
        echo '<p>Email: ' . $row['email'] . '</p>';
        echo '<p>Message: ' . $row['Message'] . '</p>';
        echo '</div>';
    }
} else {
    echo 'No feedbacks found.';
}
?>






    </section>

  <div class=footer>
    <div class="Footer-wrapper" id="Footer-wrapper">
        <h2 class="aboutHeadding"><a href="home.html">CatchCareer</a></h2>
        <p class="about">
            Catch Career is a website owned by a Group of undergraduates.
            We are a team of people who is there for not only making money but also help the people who seek jops.
            We provide the best services to the user who trust us
        </p>
        <div class="social-media">
            <a href=""><ion-icon name="logo-facebook"></ion-icon></a>
            <a href=""><ion-icon name="logo-twitter"></ion-icon></a>
            <a href=""><ion-icon name="logo-linkedin"></ion-icon></a>
            <a href=""><ion-icon name="logo-instagram"></ion-icon></a>
        </div>
    </div>
</div>

    <script src="javascript.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>