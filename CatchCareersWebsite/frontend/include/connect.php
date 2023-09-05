<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="catchcareerswebsite";

    //Creating Connection
    $conn=new mysqli($servername,$username,$password,$dbname);
    //checking connection
    if ($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }
   // echo "Connected Successfully";
?>