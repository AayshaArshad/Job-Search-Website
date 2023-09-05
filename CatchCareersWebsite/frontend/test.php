<link rel="stylesheet" href="styles.css">
<?php
    include('include/connect.php');

// Fetch job details from the database
$query = "SELECT JobID, JobTitle, JobType, Description, Requirement, adminID FROM job";
$result = mysqli_query($conn, $query);

// Check if any jobs are found
if (mysqli_num_rows($result) > 0) {
    // Loop through each job
    while ($row = mysqli_fetch_assoc($result)) {
        $jobID = $row['JobID'];
        $jobTitle = $row['JobTitle'];
        $jobType = $row['JobType'];
        $description = $row['Description'];
        $requirement = $row['Requirement'];
        $adminID = $row['adminID'];

        // Display job details in separate boxes
        echo '<div class="job-box">';
        echo '<h4>'.$jobTitle.'</h4>';
        echo '<p><strong>Job ID:</strong> '.$jobID.'</p>';
        echo '<p><strong>Job Type:</strong> '.$jobType.'</p>';
        echo '<p><strong>Description:</strong> '.$description.'</p>';
        echo '<p><strong>Requirement:</strong> '.$requirement.'</p>';
        echo '<p><strong>Admin ID:</strong> '.$adminID.'</p>';
        echo '</div>';
    }
} else {
    echo 'No jobs found.';
}

// Close the database connection
mysqli_close($conn);
?>