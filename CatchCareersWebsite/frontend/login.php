<?php
     include('include/connect.php');
?>
  
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="FirstPagecss.css">
    <title>LoginPage</title>
</head>

<body>
    <nav class="navbar">
        <h2 class="navbar-logo"><a href="home.php">CatchCareer</a></h2>
        <div class="navbar-menu">
            <div class="LogInContainer">
                <button type="button" name="buttonLogin" class="buttonLogin" id="buttonLogin" onclick="openForm()">Log
                    in</button>
                
                    <button type="button" name="buttonSignUp" class="buttonSignUp" onclick="myFunction()">Sign
                        Up</button>
                    <div id="dropdown" class="dropdown">
                        <p class="rgstr">Register As,</p><br>
                        <a href="#" onclick="openFormUser()">User</a>
                        <br>
                        <a href="#" onclick="openFormCA()">Company Admin</a>
                    </div>
            </div>
        </div>
     
        <div class="menu-toggler">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

    </nav>
    <h1 data-text="WELCOME!">WELCOME!</h1>
    <h1 data-text="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To</h1>
    <h1 data-text="CatchCareers">CatchCareers</h1>
    <center>
        <div class="loginBox" id="loginBox">
            <button onclick="closeForm()" class="btnClose">
                <ion-icon name="close-circle-outline"></ion-icon>
            </button>
            <form method="POST" action="phplogin.php">
                <p class="login"><b>LogIn</p>

                <?php
                if(isset($_GET['error'])){ ?>
                
                <p id="error">
                    <?php
                    echo $_GET['error'];
                    ?>
                </p>
                <?php
                }
                ?>

                <div class="inputBox">
                    <span class="icon">
                        <center><ion-icon name="person-outline"></ion-icon></center>
                    </span>
                    <input type="text" id="username" name="username" required>
                    <label for="username">UserName</label>

                </div>
                <div class="inputBox">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <button type="Submit" name="Login" class="Login" id="Login"><b>Log In</b></button>
                <div class="register">
                    <p>Don't have an Account?<a href="#" onclick="openFormUser()"> Register</a></p>
                </div>

            
                

                
            </form>
            <script>
                    document.getElementById("Login").addEventListener("click", function () {
                            alert("Do you wish to login?");
                        });     
                    </script>
        </div>
    </center>
 
    <center>
        <div class="registerBoxCA" id="registerBoxCA">
            <button onclick="closeFormRgstr()" class="btnCloseCA">
                <ion-icon name="close-circle-outline"></ion-icon>
            </button>
            <form action="#" method="post">
                <p class="RegisterCA"><b>SignUp As Company Admin</b></p>
                <div class="set">
                    <input type="text" name="name" id="name" required>
                    <label for="name">Name</label>
                </div>
                <span class="iconCA">
                    <ion-icon name="mail-outline"></ion-icon>
                </span>
                <div class="set">
                    <input type="text" name="email" id="email" required>
                    <label for="email">email</label>
                </div>
                <span class="iconCA">
                    <ion-icon name="podium-outline"></ion-icon>
                </span>
                <div class="set">
                    <input type="text" name="companyName" id="companyName" >
                    <label for="companyName">CompanyName</label>
                </div>
                <span class="iconCA">
                    <ion-icon name="person-outline"></ion-icon>
                </span>
                <div class="set">
                    
                    <input type="text" name="UN" id="UN" required>
                    <label for="UN">UserName</label>
                </div>
                <span class="iconCA">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                </span>
                <div class="set">
                    <input type="password" name="passwordCA" id="passwordCA" required>
                    <label for="passwordCA">Password</label>
                </div>
                <button type="reset" name="reset" class="reset"><b>Reset</b></button><br><br>
                <button type="submit" name="creat" class="create" id="create"><b>Create</b></button>
                <div class="lgIn">
                    <p>Already have an Account?<a href="#" onclick="openForm()"> Login</a></p>
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name=$_POST['name'];
                $email=$_POST['email'];
                $companyName=$_POST['companyName'];
                $userName=$_POST['UN'];
                $Password=$_POST['passwordCA'];

                $sql="INSERT INTO companyadmin(Name,email,companyName,UserName,Password)VALUES('$name','$email','$companyName','$userName','$Password')";
                if ($conn->query($sql)===TRUE){
                    echo"Data Saved Successfully!";
                }else{
                    echo "Error".$sql."<br>".$conn->error;
                }
            }
                ?>
            </form>

            <script>
                    document.getElementById("create").addEventListener("click", function () {
                            alert("Confirm Registration?");
                        });     
                    </script>

        </div>
    </center>

    <center>
        <div class="registerBoxUser" id="registerBoxUser">
            <button onclick="closeFormRgstrUser()" class="btnCloseUser">
                <ion-icon name="close-circle-outline"></ion-icon>
            </button>
            <form action="#" method="post">
                <p class="RegisterUser"><b>SignUp As User</b></p>
                <div class="setUser">
                    <input type="text" name="fn" id="fn" required>
                    <label for="fn">FullName</label>
                </div>
                <div class="setUser">
                    <input type="date" name="dob" id="dob" required>
                    <label for="dob">DateOfBirth</label>
                </div>
                <div class="setUser">
                    <span class="iconUser">
                        <ion-icon name="mail-outline"></ion-icon>
                    </span>
                    <input type="text" name="emailUser" id="email" required>
                    <label for="email">email</label>
                </div>

        
                <div class="setUser">
                    <span class="iconUser">
                        <ion-icon name="call-outline"></ion-icon>
                    </span>
                    <input type="text" name="ContactNumber" id="ContactNumber" >
                    <label for="ContactNumber">ContactNumber</label>
                </div>

                 <div class="setUser">
                    <input type="text" name="WExp" id="WExp" >
                    <label for="WExp">Working Experiences</label>
                </div>

                <div class="setUser">
                    <input type="text" name="EduQ" id="EduQ" >
                    <label for="EduQ">&nbsp;&nbsp;&nbsp;Educational Qulification</label>
                </div>
                <div class="jobType" >
                   <b><select id="jobType" name="jobType">
                    <option value="Type">Job Type</option>
                    <option value="Type">Full-Time</option>
                    <option value="Type">Contract</option>
                    <option value="Type">Part-Time</option>
                    <option value="Type">Internship</option>
                    <option value="Type">Temporary</option>
                   </select></b>
                </div>
                <div class="setUser">
                    <input type="text" name="jobTitle" id="jobTitle" >
                    <label for="jobTitle">Job Title</label>
                </div>

                <div class="setUser">
                    <span class="iconUser">
                        <ion-icon name="person-outline"></ion-icon>
                    </span>
                    <input type="text" name="UserName" id="UN" required>
                    <label for="UN">UserName</label>
                </div>
                <div class="setUser">
                    <span class="iconUser">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password" name="passwordUser" id="passwordCA" required>
                    <label for="passwordCA">Password</label>
                </div>
                <button type="reset" name="reset" class="reset" id="resetUser"><b>Reset</b></button><br><br>
                <button type="submit" name="creat" class="create" id="createUser"><b>Create</b></button>
                <div class="lgInUser">
                    <p>Already have an Account?<a href="#" onclick="openForm()"> Login</a></p>
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $FullName=$_POST['FullName'];
                $DateOfBirth=$_POST['dob'];
                $Useremail=$_POST['emailUser'];
                $ContactNumber=$_POST['ContactNumber'];
                $WExp=$_POST['WExp'];
                $EduQ=$_POST['EduQ'];
                $jobType=$_POST['jobType'];
                $jobTitle=$_POST['jobTitle'];
                $UserName=$_POST['UserName'];
                $passwordUser=$_POST['passwordUser'];

                $sql="INSERT INTO user(FullName,DateOfBirth,email,ContactNumber,WorkingExperience,EducationalQulification,
                JobType,JobTitle,username,password)VALUES('$FullName',' $DateOfBirth','$Useremail','$ContactNumber',
                '$WExp','$EduQ','$jobType','$jobTitle','$UserName','$passwordUser')";
                if($conn->query($sql)===TRUE){
                    echo"Data Saved Successfully!";
                }else{
                    echo "Error".$sql."<br>".$conn->error;
                }
            }
                ?>
            </form>
        </div>
    </center>

    <script src="javascript.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
            