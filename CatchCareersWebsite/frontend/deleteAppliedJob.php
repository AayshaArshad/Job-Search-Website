<?php
     include('include/connect.php');
     if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];

        $sql="DELETE FROM appliedjobs WHERE AplyID=$id";
        $result=mysqli_query($conn,$sql);

        if($result){
            //echo "Deleted Successfully";
            header("Location:CompanyAdminDashboard.php");

        }else{
            die("Connection Failed".$conn->connect_error);
        }
     }
?>