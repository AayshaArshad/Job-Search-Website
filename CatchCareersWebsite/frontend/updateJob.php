<?php
session_start();
include('include/connect.php');


// Function to fetch all job details
function getAllJobDetails()
{
    global $conn; // Replace with your database connection variable

    $query = "SELECT * FROM job";
    $result = mysqli_query($conn, $query);

    // Check if there are any jobs in the database
    if (mysqli_num_rows($result) > 0) {
        // Fetch all job details
        $jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $jobs;
    } else {
        // No jobs found
        return [];
    }
}

// Function to update job details
function updateJobDetails($jobId, $newJobTitle, $newJobType, $newDescription, $newRequirement, $newAdminId)
{
    global $conn; // Replace with your database connection variable

    // Sanitize input to prevent SQL injection
    $newJobTitle = mysqli_real_escape_string($conn, $newJobTitle);
    $newJobType = mysqli_real_escape_string($conn, $newJobType);
    $newDescription = mysqli_real_escape_string($conn, $newDescription);
    $newRequirement = mysqli_real_escape_string($conn, $newRequirement);
    $newAdminId = mysqli_real_escape_string($conn, $newAdminId);

    // Update the job details in the database
    $query = "UPDATE job SET JobTitle='$newJobTitle', JobType='$newJobType', Description='$newDescription', Requirement='$newRequirement', adminID='$newAdminId' WHERE JobID='$jobId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Update successful
        return true;
    } else {
        // Update failed
        return false;
    }
}

// Process the update form submission
if (isset($_POST['update'])) {
    $jobId = $_POST['JobID']; // Job ID of the job to be updated
    $newJobTitle = $_POST['JobTitle']; // Updated job title
    $newJobType = $_POST['JobType']; // Updated job type
    $newDescription = $_POST['Description']; // Updated job description
    $newRequirement = $_POST['Requirement']; // Updated job requirement
    $newAdminId = $_POST['adminID']; // Updated admin ID

    // Call the updateJobDetails function
    if (updateJobDetails($jobId, $newJobTitle, $newJobType, $newDescription, $newRequirement, $newAdminId)) {
        // Update successful
        echo "Job details updated successfully.";
    } else {
        // Update failed
        echo "Failed to update job details.";
    }
}

// Fetch all job details
$jobs = getAllJobDetails();
?>

<!-- Display all job details in a table -->
<link rel="stylesheet" type="text/css" href="dashboard.css">
<table id='updateJob-Table'>
    <thead>
        <tr>
            <th>Job ID</th>
            <th>Job Title</th>
            <th>Job Type</th>
            <th>Description</th>
            <th>Requirement</th>
            <th>Admin ID</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($jobs as $job) { ?>
            <tr>
                <td><?php echo $job['JobID']; ?></td>
                <td><?php echo $job['JobTitle']; ?></td>
                <td><?php echo $job['JobType']; ?></td>
                <td><?php echo $job['Description']; ?></td>
                <td><?php echo $job['Requirement']; ?></td>
                <td><?php echo $job['adminID']; ?></td>
                <td>
                    <!-- Update form for each job -->
                    <center> <form method="POST" id='updateForm' >
                        <input type="hidden" name="JobID" value="<?php echo $job['JobID']; ?>">
                        <input type="text" name="JobTitle" value="<?php echo $job['JobTitle']; ?>">
                        <input type="text" name="JobType" value="<?php echo $job['JobType']; ?>">
                        <input type="text" name="Description" value="<?php echo $job['Description']; ?>">
                        <input type="text" name="Requirement" value="<?php echo $job['Requirement']; ?>">
                        <input type="text" name="adminID" value="<?php echo $job['adminID']; ?>">
                        <input type="submit" name="update" value="Update" id='updateButton'>
                    </form></center>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>






