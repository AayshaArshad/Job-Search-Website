<?php
session_start();
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
    
?>
<?php
     include('include/connect.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
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

                <li><a href="#" onclick="showDiv('div2')">Add Jobs</a></li>
                <li><a href="#" onclick="showDiv('div3')">View or Make Changes to Job</a></li>
                <li><a href="#" onclick="showDiv('div4')">Send Notifications</a></li>
                <li><a href="#" onclick="showDiv('personalInfo')">User Applied Jobs</a></li>
                <li><a href="#" onclick="showDiv('div6')">Logout</a></li>

            </ul>
        </center>
    </div>
    <div class="header">
        <h1>&nbsp;Welcome 
            <?php echo $_SESSION['username']; } ?> 
        </h1>
    </div>
    <div class="main" id="mainSection">
        <div id="personalInfo" class="content" style="display: none;">



            <h2 class="personal-info-title">&nbsp;&nbsp;&nbsp;&nbsp;PERSONAL INFORMATION</h2>


            <?php
                    $sql="SELECT * FROM appliedjobs";
                    $result=$conn->query($sql);

                  

                    if($result->num_rows > 0){
                       echo"<table id='personalInfo-Table'>";
                       echo"<tr>Apply ID<th></th><th>Job ID </th><th>UserID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>CV</th><th>Message</th><th>Action</th></tr>";
                       while($row=$result-> fetch_assoc()){
                           echo "<tr><td>".$row["AplyID"]."</td><td>".$row["jobID"]."</td><td>".$row["UserID"].
                           "</td><td>".$row["fullname"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["cv"]."</td><td>".$row["message"]."</td>
                           <td>
                           <a href='deleteAppliedJob.php?deleteid=".$row["AplyID"]."' id='dlt'>Delete</a>
                           </td>
                           
                           </tr>";
                       }
                       echo"</table>";
                   }else{
                       echo "<div id='No-Results-Found'>
                       No Results Found !</div>";
                   }
                    ?>


        </div>
        <div id="div2" class="content" style="display: none;">
            <h2 class="div">&nbsp;&nbsp;&nbsp;ADD NEW JOBS</h2>


            <div class="add-job">

                <form action="" method="post">


                    <label for="title" class="adjb">Job Title:</label>
                    <input type="text" id="title" name="title" required>
                    <br>
                    <label for="type" class="adjb">Job Type:</label>
                    <select id="type" name="type" class="title-select" required>
                        <option value="">---Select a type---</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Internship">Internship</option>
                        <option value="Temporary">Temporary</option>
                    </select>
                    <br>
                    <label for="requirements" class="adjb">Requirements:</label>
                    <textarea id="requirements" name="requirements" rows="4" class="title1" required></textarea>
                    <br>
                    <label for="description" class="adjb">Description:</label>
                    <textarea id="description" name="description" rows="8" class="title1" required></textarea>
                    <br>
                    <label for="title" class="adjb">Company Admin ID</label>
                    <input type="text" id="title" name="adminID" required>
                    <br>
                    <button type="submit" class="add-job-button">Submit</button>


                    <?php

                    if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $adminID=$_POST['adminID'];
                    $title=$_POST['title'];
                    $type=$_POST['type'];
                    $requirements=$_POST['requirements'];
                    $description=$_POST['description'];

                    $sql="INSERT INTO job(JobTitle,JobType,Description,Requirement,adminID)VALUES('$title','$type','$requirements','$description','$adminID')";
                    if ($conn->query($sql)===TRUE){
                        echo"Data Saved Successfully!";
                    }else{
                        echo "Error".$sql."<br>".$conn->error;
                    }
                }
                ?>
                      
                </form>

            </div>


        </div>





        <div id="div3" class="content" style="display: none;">
            <h2 class="div">&nbsp;&nbsp;&nbsp;VIEW OR MAKES CHANGES TO JOBS</h2>
            <?php

            $sql="SELECT * FROM job";
            $result=$conn->query($sql);
            if($result->num_rows>0){
            
            echo "<table id='personalInfo-Table'>";
           
            echo" <tr>
                <th>JobID</th>
                <th>JobTitle</th>
                <th>JobType</th>
                <th>Description</th>
                <th>Requirement</th>
                <th>adminID</th>
              
                <th>Delete</th>

                ";
                while($row=$result->fetch_assoc()){
                    echo"<tr><td>".$row["JobID"]."</td><td>".$row["JobTitle"]."</td><td>".$row["JobType"].
                    "</td><td>".$row["Description"]."</td><td>".$row["Requirement"]."</td><td>".$row["adminID"]."</td>
                   
                    <td>
                    <a href='deleteJob.php?deleteid=".$row["JobID"]."' id='dlt'>Delete</a> 
                   
                    </td>
                    <tr>";
                }
                echo"</table>";
                echo"<br><br>";
                echo "<button id='updateBtn'>
                <td>
                <a href='updateJob.php' id='update'>Update</a> 
                </td>
                
                </button>";
              
            }else{
                echo"<div id='No-Results-Found'>No Results Found!!</div>";
                }
            
            ?>
            



        </div>


        <div id="div6" class="content" style="display: none;">
            <h2 class="div">&nbsp;&nbsp;&nbsp;&nbsp;LOGOUT FROM THE DASHBOARD</h2>


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

    </div>

</body>

</html>