<?php
     include('include/connect.php');
     if(isset($_GET['deleteadminid'])){
        $id=$_GET['deleteadminid'];

        $sql="DELETE FROM  companyadmin WHERE adminID=$id";
        $result=mysqli_query($conn,$sql);

        if($result){
            //echo "Deleted Successfully";
            header("Location:webAdmin.php");

        }else{
            die("Connection Failed".$conn->connect_error);
        }
     }
?>