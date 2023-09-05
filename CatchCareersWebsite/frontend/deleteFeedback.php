<?php
     include('include/connect.php');
     if(isset($_GET['deleteFeedbackid'])){
        $id=$_GET['deleteFeedbackid'];

        $sql="DELETE FROM  feedback WHERE feedbackID=$id";
        $result=mysqli_query($conn,$sql);

        if($result){
            //echo "Deleted Successfully";
            header("Location:webAdmin.php");

        }else{
            die("Connection Failed".$conn->connect_error);
        }
     }
?>