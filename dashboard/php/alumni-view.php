<?php
require 'db/config.php'; // Ensure this file connects to your database
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Alumni View</title>
</head>
<body>

<div class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Alumni View Details 
                        <a href="index.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if (isset($_GET['id'])) {
                        $alumni_id = mysqli_real_escape_string($con, $_GET['id']);
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
                            w.status AS Working_Status
                        FROM 
                            `2024-2025` a
                        LEFT JOIN 
                            working_status w ON a.Working_Status = w.id
                        WHERE 
                            a.Student_Number = '$alumni_id'
                        ";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $alumni = mysqli_fetch_array($query_run);
                            ?>

                            <div class="mb-3">
                                <label>Student Number</label>
                                <p class="form-control">
                                    <?= $alumni['Student_Number']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Last Name</label>
                                <p class="form-control">
                                    <?= $alumni['Last_Name']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>First Name</label>
                                <p class="form-control">
                                    <?= $alumni['First_Name']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Middle Name</label>
                                <p class="form-control">
                                    <?= $alumni['Middle_Name']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Course</label>
                                <p class="form-control">
                                    <?= $alumni['Course']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Department</label>
                                <p class="form-control">
                                    <?= $alumni['Department']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Section</label>
                                <p class="form-control">
                                    <?= $alumni['Section']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Year Graduated</label>
                                <p class="form-control">
                                    <?= $alumni['Year_Graduated']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Contact Number</label>
                                <p class="form-control">
                                    <?= $alumni['Contact_Number']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Personal Email</label>
                                <p class="form-control">
                                    <?= $alumni['Personal_Email']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Working Status</label>
                                <p class="form-control">
                                    <?= $alumni['Working_Status'] ?: 'N/A'; ?>
                                </p>
                            </div>

                            <?php
                        } else {
                            echo "<h4>No Such ID Found</h4>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
