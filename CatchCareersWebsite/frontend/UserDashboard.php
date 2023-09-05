<?php
session_start();
if(isset($_SESSION['username'])){
?>

<?php
     include('include/connect.php');

?>
<!DOCTYPE html>
<html>

<head>
  <title>User Dashboard</title>
  <link rel="stylesheet" type="text/css" href="dashboard.css">
  <script src="javascript.js"></script>
</head>

<body>
  <div class="sidebar">
    <center>
      <h2 class="CA-dashboard-logo"><a href="home.php">CatchCareers</a></h2>
    </center>
    <center>
      <ul>

        <li><a href="#" onclick="showDiv('div2')">View Applied Jobs</a></li>
        <li><a href="#" onclick="showDiv('div3')">Notifications</a></li>
        <li><a href="#" onclick="showDiv('div4')">Add Feedback</a></li>
        <li><a href="#" onclick="showDiv('div5')">LogOut</a></li>
      </ul>
    </center>
  </div>
  <div class="header">
    <h1>Welcome&nbsp;
      <?php echo $_SESSION['username']; } ?>
    </h1>
  </div>
  <div class="main" id="mainSection">






    <div id="div2" class="content" style="display: none;">
      <h2 class="div">&nbsp;&nbsp;&nbsp;VIEW APPLIED JOBS</h2>


      <table id="personalInfo-Table">
        <tr>
          <th>AplyID	</th>
          <th>jobID	</th>
          <th>UserID</th>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>

        </table>

    </div>
    <div id="div2.2" class="content" style="display: none;">
      <h2 class="div">&nbsp;&nbsp;&nbsp;VIEW APPLIED JOBS</h2>


      <?php
// Check if the user is logged in
if (isset($_SESSION['UserID'])) {
    $userID = $_SESSION['UserID'];
    
    // Query the database for the user's applied jobs
    $sql = "SELECT * FROM appliedjobs WHERE UserID = '$userID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Job ID</th><th>Job Title</th><th>Company</th><th>Application Date</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            // Retrieve job details using the JobID stored in the applied_jobs table
            $jobID = $row['JobID'];
            $jobQuery = "SELECT * FROM job WHERE JobID = '$jobID'";
            $jobResult = $conn->query($jobQuery);
            
            if ($jobResult->num_rows > 0) {
                $jobRow = $jobResult->fetch_assoc();
                echo "<tr><td>" . $jobRow["JobID"] . "</td><td>" . $jobRow["AplyID"]. "</td></tr>";
            }
        }
        
        echo "</table>";
    } else {
        echo "No applied jobs found!";
    }
} else {
    echo "Please log in to view your applied jobs.";
}
?>




    </div>



    <div id="div3" class="content" style="display: none;">
      <h2 class="div">&nbsp;&nbsp;&nbsp;CHECK NOTIFICATIONS</h2>
      <p>This is the content for Option 3.</p>
    </div>

    <div id="div4" class="content" style="display: none;">
      <h2 class="div">&nbsp;&nbsp;&nbsp;ADD YOUR FEEDBACKS</h2>
      <div class="container">

        <form method="POST">
          <label for="username">User Name:</label>
          <input type="text" id="username" name="username" required value="<?php echo $_SESSION['username']; ?>">

          <label for="email">Email:</label>
          <input type="text" id="email" name="email" required>

          <label for="message">Message:</label>
          <textarea id="message" name="message" required></textarea>

          <button class="button-feedback" type="submit">Submit</button>
          <?php
                  if($_SERVER['REQUEST_METHOD'] === 'POST'){
                  $username=$_POST['username'];
                  $email=$_POST['email'];
                  $message=$_POST['message'];

                  $sqls="INSERT INTO feedback(UserName,email,Message) VALUES('$UserName','$email','$message')";
                  if($conn->query($sqls)===TRUE){
                    echo"Data Saved Successfully!";
                  }
                  else
                  {
                    echo "Error".$sql."<br>".$conn->error;
                  }
                }
                  ?>
        </form>
      </div>



    </div>


    <div id="div5" class="content" style="display: none;">
      <h2 class="div">&nbsp;&nbsp;&nbsp;LOGOUT FROM USER DASHBOARD</h2>
      <!--<button name="btnLogout" id="btnLogout">LOGOUT</button>-->
      <div class="containerbtn">

        <button id="logoutButton">Logout</button>

        <script>
          // JavaScript code for logout button and confirmation pop-up
          window.addEventListener('DOMContentLoaded', () => {
            const logoutButton = document.getElementById('logoutButton');

            // Event listener for logout button click
            logoutButton.addEventListener('click', () => {
              // Display the confirmation pop-up
              const confirmLogout = confirm('Are you sure you want to logout from User Dashboard?');

              // Redirect to logout page or perform logout action
              if (confirmLogout) {
                // Replace the URL below with the actual logout page or action
                window.location.href = 'logout.php';
              }
            });
          });
        </script>


      </div>


    </div>
  </div>


</body>

</html>