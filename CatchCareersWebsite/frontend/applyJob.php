<?php
include('include/connect.php');
?>
<!DOCTYPE html>
<html>

<head>
  <title>Job Application Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      width: 100%;
  
      background-size:cover;
    
     
    }

    form {
      width: 70%;
      margin-left: 40rem;
      margin-top: 4rem;
      border-radius:4px;
      
      border:4px;
    }

    h1 {
    
      margin-left: 10rem;
      margin-top: 10rem;
      font-size: 40px;
      color: #1f034b;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #390a92;
      font-size: 18px;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"],
    textarea {
      background-color:#b5b1b1;
      width: 50%;
      padding: 8px;
      border: none;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 10px;
      color: #390a92;
      height: 3rem;
      font-size: 15px;
    }


    textarea {
      height: 100px;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="file"]:focus,
    textarea:focus {
      background-color: #ddd;
      outline: none;
    }

    .btn {
      background-color: #1f034b;
      color: white;
      padding: 10px 20px;
      border: none;
      margin-left: 42rem;
      cursor: pointer;
    }

    .btn:hover {
      text-transform: uppercase;
      font-size: 15px;
    }
  </style>
</head>

<body>
  
  <form id="jobApplicationForm" method="POST" enctype="multipart/form-data">
  <h1>Job Application Form</h1>
    <label for="jobID">Job ID:</label>
    <input type="text" id="jobID" name="jobID" required>

    <label for="userID">User ID:</label>
    <input type="text" id="userID" name="userID" required>

    <label for="fullName">Full Name:</label>
    <input type="text" id="fullName" name="fullname" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required>

    <label for="cv">Attach CV:</label>
    <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx">

    <label for="message">Message:</label>
    <textarea id="message" name="message"></textarea>

    <br>
    <button type="submit" class="btn" name="Submit">Submit</button>
  </form>

  <?php
    

      // Get form data
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $jobID = $_POST['jobID'];
      $userID = $_POST['userID'];
      $fullName = $_POST['fullname'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $cvName = $_FILES['cv']['name'];
      $cvTemp = $_FILES['cv']['tmp_name'];
      $message = $_POST['message'];

      // Move uploaded CV file to desired directory
      $targetDirectory = "cv_uploads/"; // Change this to your desired directory
      $targetFile = $targetDirectory . basename($cvName);
      move_uploaded_file($cvTemp, $targetFile);

      // Insert data into database
      $sql = "INSERT INTO appliedjobs(jobID, userID, fullName, email, phone, cv, message) 
              VALUES ('$jobID', '$userID', '$fullName', '$email', '$phone', '$cvName', '$message')";

      if ($conn->query($sql) === TRUE) {
        echo "<p>Application submitted successfully!</p>";
        echo "<p>Thank you for applying.</p>";
        // Additional actions after successful submission
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      // Close the database connection
      $conn->close();
      }
  ?>

  <script>
    document.getElementById("jobApplicationForm").addEventListener("submit", function (event) {
      event.preventDefault();

      // Fetch form data
      var fullName = document.getElementById("fullName").value;
      var email = document.getElementById("email").value;
      var phone = document.getElementById("phone").value;
      var cvFile = document.getElementById("cv").files[0];
      var message = document.getElementById("message").value;

      // Create FormData object
      var formData = new FormData();
      formData.append("fullName", fullName);
      formData.append("email", email);
      formData.append("phone", phone);
      formData.append("cv", cvFile);
      formData.append("message", message);

      // Send form data to the server using AJAX or fetch
      // Replace the URL below with your server-side script URL
      var url = "applyJob.php";
      fetch(url, {
        method: "POST",
        body: formData
      })
        .then(function (response) {
          // Handle response from the server
          if (response.ok) {
            alert("Application submitted successfully!");
            document.getElementById("jobApplicationForm").reset();
          } else {
            alert("Failed to submit application.");
          }
        })
        .catch(function (error) {
          console.log(error);
          alert("An error occurred while submitting the application.");
        });
    });
  </script>
</body>

</html>