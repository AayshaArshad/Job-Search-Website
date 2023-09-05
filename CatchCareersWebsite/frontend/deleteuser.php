<?php
     include('include/connect.php');
     if(isset($_GET['deleteuserid'])){
        $id=$_GET['deleteuserid'];

        $sql="DELETE FROM  user WHERE UserID=$id";
        $result=mysqli_query($conn,$sql);

        if($result){
            //echo "Deleted Successfully";
            header("Location:webAdmin.php");

        }else{
            die("Connection Failed".$conn->connect_error);
        }
     }
?>