<?php
session_start();
require '../db/config.php'; // Corrected path to your config.php

$query = "
SELECT 
    a.Student_Number, 
    a.Last_Name, 
    a.First_Name, 
    a.Middle_Name,
    a.Course,
    a.Department, 
    a.Section, 
    a.Year_Graduated, 
    a.Contact_Number, 
    a.Personal_Email, 
    ws.Working_Status,
    a.Alumni_ID_Number  -- Ensure this is included to identify the record
FROM 
    `2024-2025` a
LEFT JOIN 
    `2024-2025_ws` ws ON a.Alumni_ID_Number = ws.Alumni_ID_Number
"; // Use hyphen in the table name

$query_run = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Alumni Details</title>
</head>

<body>
    <div class="container mt-4">
        <h4>Alumni Details</h4>

        <!-- Link to Add Alumni Form -->
        <a href="alumni-add.php" class="btn btn-primary mb-3">Add New Alumni</a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Student Number</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Course</th>
                    <th>Department</th>
                    <th>Section</th>
                    <th>Year Graduated</th>
                    <th>Contact Number</th>
                    <th>Personal Email</th>
                    <th>Working Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $alumni) {
                ?>
                        <tr>
                            <td><?= $alumni['Student_Number']; ?></td>
                            <td><?= $alumni['Last_Name']; ?></td>
                            <td><?= $alumni['First_Name']; ?></td>
                            <td><?= $alumni['Middle_Name']; ?></td>
                            <td><?= $alumni['Course']; ?></td>
                            <td><?= $alumni['Department']; ?></td>
                            <td><?= $alumni['Section']; ?></td>
                            <td><?= $alumni['Year_Graduated']; ?></td>
                            <td><?= $alumni['Contact_Number']; ?></td>
                            <td><?= $alumni['Personal_Email']; ?></td>
                            <td><?= $alumni['Working_Status']; ?></td>
                            <td>
                                <!-- Edit Button -->
                                <a href="alumni-edit.php?id=<?= $alumni['Alumni_ID_Number']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <!-- Delete Button -->
                                <form action="index.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="delete_alumni" value="<?= $alumni['Alumni_ID_Number']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='12'>No Record Found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// PHP code to handle form submissions for adding, updating, and deleting records
if (isset($_POST['delete_alumni'])) {
    // Code to delete alumni record
    $alumni_id = mysqli_real_escape_string($con, $_POST['delete_alumni']);
    $delete_query = "DELETE FROM `2024-2025` WHERE Alumni_ID_Number='$alumni_id'";
    
    // Execute the delete query
    if (mysqli_query($con, $delete_query)) {
        $_SESSION['message'] = "Alumni Deleted Successfully";
    } else {
        $_SESSION['message'] = "Alumni Not Deleted: " . mysqli_error($con);
    }
    
    header("Location: index.php"); // Redirect to avoid resubmission
    exit(0);
}
?>
