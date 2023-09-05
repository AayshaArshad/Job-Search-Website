<?php
session_start();
include('include/connect.php');
/*
if(isset($_POST['UserName']) && isset($_POST['password'])){
    function validate($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
$username= validate($_POST['UserName']);
$password = validate($_POST["password"]);

if(empty($username)){
    header("Location:login.php?error=UserName is required");
    exit();
}elseif(empty($password)){
    header("Location:login.php?Password is required");
    exit();
}else{
    //echo "Valid input!!!";
    $sql="SELECT * FROM user  WHERE 	UserName='$username' AND Password='$password'"; //OR companyadmin
    $result=mysqli_query($conn,$sql);

    if (mysqli_num_rows($result)===1){
       // echo "Hello";
       $row=mysqli_fetch_assoc($result);
      // print_r( $row);
      if($row['UserName']===$username && $row['Password']===$password){
        echo "Logged in!";
        $_SESSION['UserName']=$row['UserName'];
        $_SESSION['UserID']=$row['	UserID'];
        header("Location:UserDashboard.php");
      }else{
        header("Location:login.php?error=Incorrect UserName or Password");
        exit();
    }


    }else{
        header("Location:login.php?error=Incorrect UserName or Password");
    exit();
    }
}

}else{
    header("Location:login.php");
    exit();
}
?>--------------------------------------------------------------
*/
if(isset($_POST['username']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $username = validate($_POST['username']);
    $password = validate($_POST["password"]);
    $Name= validate($_POST['Name']);
    
    if(empty($username)){
        header("Location: login.php?error=Username is required");
        exit();
    } elseif(empty($password)){
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        // Check in the user table
        $userQuery = "SELECT * FROM user WHERE username = ? AND password = ?";
        $userStmt = $conn->prepare($userQuery);
        $userStmt->bind_param("ss", $username, $password);
        $userStmt->execute();
        $userResult = $userStmt->get_result();
        
        // Check in the admin table
        $adminQuery = "SELECT * FROM companyadmin WHERE username = ? AND password = ?";
        $adminStmt = $conn->prepare($adminQuery);
        $adminStmt->bind_param("ss", $username, $password);
        $adminStmt->execute();
        $adminResult = $adminStmt->get_result();

        $websiteAdminQuery = "SELECT * FROM websiteadmin WHERE username = ? AND password = ?";
        $websiteAdminStmt = $conn->prepare($websiteAdminQuery);
        $websiteAdminStmt->bind_param("ss", $username, $password);
        $websiteAdminStmt->execute();
        $websiteAdminResult = $websiteAdminStmt->get_result();

        
        if($userResult->num_rows === 1) {
            $userRow = $userResult->fetch_assoc();
            if($userRow['username'] === $username && $userRow['password'] === $password) {
                echo "Logged in as User!";
                $_SESSION['username'] = $userRow['username'];
               
                header("Location: UserDashboard.php");
                exit();
            }
        } elseif($adminResult->num_rows === 1) {
            $adminRow = $adminResult->fetch_assoc();
            if($adminRow['username'] === $username && $adminRow['password'] === $password) {
                echo "Logged in as Admin!";
                $_SESSION['username'] = $adminRow['username'];
               
                header("Location:CompanyAdminDashboard.php");
                exit();
            }
        }elseif($websiteAdminResult->num_rows === 1) {
            $websiteAdminRow = $websiteAdminResult->fetch_assoc();
            if($websiteAdminRow['username'] === $username && $websiteAdminRow['password'] === $password) {
                echo "Logged in as Website Admin!";
                $_SESSION['username'] = $websiteAdminRow['username'];

                header("Location: webAdmin.php");
                exit();
            }
        }

        
        header("Location: login.php?error=Incorrect Username or Password");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}/*





if(isset($_POST['username']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST["password"]);
     $Name= validate($_POST['Name']);

    if(empty($username)){
        header("Location: login.php?error=Username is required");
        exit();
    } elseif(empty($password)){
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        // Check in the user table
        $userQuery = "SELECT * FROM user WHERE username = ? AND password = ?";
        $userStmt = $conn->prepare($userQuery);
        $userStmt->bind_param("ss", $username, $password);
        $userStmt->execute();
        $userResult = $userStmt->get_result();

        // Check in the admin table
        $adminQuery = "SELECT * FROM companyadmin WHERE username = ? AND password = ?";
        $adminStmt = $conn->prepare($adminQuery);
        $adminStmt->bind_param("ss", $username, $password);
        $adminStmt->execute();
        $adminResult = $adminStmt->get_result();

        // Check in the websiteadmintable
        $websiteAdminQuery = "SELECT * FROM websiteadmin WHERE username = ? AND password = ?";
        $websiteAdminStmt = $conn->prepare($websiteAdminQuery);
        $websiteAdminStmt->bind_param("ss", $username, $password);
        $websiteAdminStmt->execute();
        $websiteAdminResult = $websiteAdminStmt->get_result();

        if($userResult->num_rows === 1) {
            $userRow = $userResult->fetch_assoc();
            if($userRow['username'] === $username && $userRow['password'] === $password) {
                echo "Logged in as User!";
                $_SESSION['username'] = $userRow['username'];

                header("Location: UserDashboard.php");
                exit();
            }
        } elseif($adminResult->num_rows === 1) {
            $adminRow = $adminResult->fetch_assoc();
            if($adminRow['username'] === $username && $adminRow['password'] === $password) {
                echo "Logged in as Admin!";
                $_SESSION['username'] = $adminRow['username'];

                header("Location: CompanyAdminDashboard.php");
                exit();
            }
        } elseif($websiteAdminResult->num_rows === 1) {
            $websiteAdminRow = $websiteAdminResult->fetch_assoc();
            if($websiteAdminRow['username'] === $username && $websiteAdminRow['password'] === $password) {
                echo "Logged in as Website Admin!";
                $_SESSION['username'] = $websiteAdminRow['username'];

                header("Location: WebsiteAdminDashboard.php");
                exit();
            }
        }

        header("Location: login.php?error=Incorrect Username or Password");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
*/

?>