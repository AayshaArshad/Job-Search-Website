<?php
session_start();
     include('include/connect.php');
     if(isset($_SESSION['username'])){
        
?>
<!DOCTYPE html>
<html>

<head>
    <title>Website Admin's Dashboard</title>
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
                <li><a href="#" onclick="showDiv('div1')">Company Admin's Details</a></li>
                <li><a href="#" onclick="showDiv('div2')">User Details</a></li>
                <li><a href="#" onclick="showDiv('div3')">Feedbacks</a></li>
                <li><a href="#" onclick="showDiv('div4')">Add a New Admin</a></li>
                <li><a href="#" onclick="showDiv('div5')">LogOut</a></li>
       

            </ul>
        </center>
    </div>
    <div class="header">
        <h1>Welcome <?php echo $_SESSION['username']; ?>
        </h1>
    </div>
    <div class="main" id="mainSection">

        <div id="div1" class="content" style="display: none;">
            <h2 class="div">&nbsp;&nbsp;&nbsp;&nbsp;COMPAY ADMIN'S PERSONAL INFORMATION</h2>

            <?php
                    $sql="SELECT * FROM companyadmin";
                    $result=$conn->query($sql);

                    if($result->num_rows > 0){
                       echo"<table id='personalInfo-Table'>";
                       echo"<tr><th>AdminID</th><th>Name</th><th>email</th><th>UserName</th><th>Password</th>
                       <th>Action</th></tr>";
                       while($row=$result-> fetch_assoc()){
                           echo "<tr><td>".$row["adminID"]."</td><td>".$row["Name"]."</td><td>".$row["email"].
                           "</td><td>".$row["username"]."</td><td>".$row["password"]."</td><td>
                           <a href='deleteadmin.php?deleteadminid=".$row["adminID"]."' id='dlt'>Delete</a></td></tr>";
                       }
                       echo"</table>";
                   }else{
                       echo "<div id='No-Results-Found'>
                       No Results Found !</div>";
                   }
                    ?>

        </div>



        <div id="div2" class="content" style="display: none;">
            <h2 class="div">&nbsp;&nbsp;&nbsp;USER'S PERSONAL INFORMATION</h2>
            <?php
           $sql="SELECT * FROM user";
           $result=$conn->query($sql);
             if($result->num_rows>0){
                echo "<table id='personalInfo-Table'>";
                echo"<tr><th>UserID</th><th>FullName</th><th>DateOfBirth</th><th>email</th><th>ContactNumber</th><th>WorkingExperience</th>
                <th>EducationalQulification</th><th>JobType</th><th>JobTitle</th><th>username</th><th>password</th><th>Action</th></tr>";
                while($row=$result-> fetch_assoc()){
                echo "<tr><td>".$row["UserID"]."</td><td>".$row["FullName"]."</td><td>".$row["DateOfBirth"].
                    "</td><td>".$row["email"]."</td><td>".$row["ContactNumber"]."</td><td>".$row["WorkingExperience"]."</td><td>".$row["EducationalQulification"]."</td><td>".$row["JobType"].
                    "</td><td>".$row["JobTitle"]."</td><td>".$row["username"]."</td><td>".$row["password"].
                    "</td><td><a href='deleteuser.php?deleteuserid=".$row["UserID"]."' id='dlt'>Delete</a></td></tr>";
                }
                echo"</table>";
            }else{
                echo "<div id='No-Results-Found'>
                No Results Found !</div>";
             }
           ?>

        </div>



        <div id="div3" class="content" style="display: none;">
            <h2 class="div">&nbsp;&nbsp;&nbsp;USER FEEDBACKS</h2>
            <?php
                 $sql="SELECT * FROM feedback";
                 $result=$conn->query($sql);
                 if($result->num_rows>0){
                    echo "<table id='personalInfo-Table'>";
                  
                    echo "<tr>
                    <th>Feedback ID</th>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                    </tr>";

                    while($row=$result->fetch_assoc()){
                    echo "<tr><td>".$row["feedbackID"]."</td><td>".$row["UserName"]."</td><td>".$row["email"]."</td><td>".$row["Message"].
                    "</td><td><a href='deleteFeedback.php?deleteFeedbackid=".$row["feedbackID"]."' id='dlt'>Delete</a></td></tr>";
                 }
                }
            ?>
        </div>


        <div id="div4" class="content" style="display: none;">
            <h2 class="div">&nbsp;&nbsp;&nbsp;ADD A NEW ADMIN</h2>
            <form method="POST" action="#">
                <div class="container">
                    <h1>Register a New Admin</h1>
                    <br><br>

                    <label for="nm"><b>Name</b></label>
                    <input type="text" placeholder="Enter Name" name="nm" id="nm" required>

                    <label for="username"><b>UserName</b></label>
                    <input type="text" placeholder="Enter UserName" name="username" id="username" required>

                    <label for="password"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="password" required>

                    <button type="submit" name="submit" class="registerbtn" id="registerbtn"> Register</button>
                    <script>
                        document.getElementById("registerbtn").addEventListener("click", function () {
                            alert("Confirm Registration!");
                        });     
                    </script>

                    <?php
                      if($_SERVER['REQUEST_METHOD'] === 'POST'){
                        $name=$_POST['nm'];
                        $username=$_POST['username'];
                        $password=$_POST['password'];
      
                        $sql="INSERT INTO websiteadmin(adminName,username,password) VALUES('$name','$username','$password')";
                        if($conn->query($sql)===TRUE){
                          echo"Data Saved Successfully!";
                        }
                        else
                        {
                          echo "Error".$sql."<br>".$conn->error;
                        }
                      }
                     ?>

                </div>
            </form>
        </div>


        <div id="div5" class="content" style="display: none;">


            <h2 class="div">&nbsp;&nbsp;&nbsp;LOGOUT FROM Web Admin's DASHBOARD</h2>
            <button id="logoutButton">Logout</button>

            <script>
                // JavaScript code for logout button and confirmation pop-up
                window.addEventListener('DOMContentLoaded', () => {
                    const logoutButton = document.getElementById('logoutButton');

                    // Event listener for logout button click
                    logoutButton.addEventListener('click', () => {
                        // Display the confirmation pop-up
                        const confirmLogout = confirm('Are you sure you want to logout from Company Admin\'s Dashboard?');

                        // Redirect to logout page or perform logout action
                        if (confirmLogout) {
                            // Replace the URL below with the actual logout page or action
                            window.location.href = 'logout.php';
                        }
                    });
                });
            </script>
        </div>
        <?php
} // Add the closing brace here
?>
    </div>
</body>

</html>