<?php
session_start();
require '../db/config.php';

if (isset($_GET['id'])) {
    $alumni_id = $_GET['id'];
    $stmt = $con->prepare("SELECT * FROM `2024-2025` WHERE Alumni_ID_Number = ?");
    $stmt->bind_param("s", $alumni_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $alumni = $result->fetch_assoc();
    } else {
        $_SESSION['message'] = "No record found!";
        header("Location: index.php");
        exit(0);
    }
} else {
    $_SESSION['message'] = "Invalid ID!";
    header("Location: index.php");
    exit(0);
}
?>

<!Doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Alumni Edit</title>
</head>
<body>

    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Alumni Edit 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="submit-alumni.php" method="POST">

                            <input type="hidden" name="alumni_id" value="<?= $alumni['Alumni_ID_Number']; ?>">

                            <div class="mb-3">
                                <label>Student Number</label>
                                <input type="text" name="student_number" class="form-control" value="<?= $alumni['Student_Number']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?= $alumni['Last_Name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?= $alumni['First_Name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" value="<?= $alumni['Middle_Name']; ?>">
                            </div>
                            <div class="mb-3">
                                <label>Department</label>
                                <select name="department" class="form-control" required>
                                    <option value="" disabled>Select Course</option>
                                    <option value="CITCS" <?= $alumni['Course'] === 'CITCS' ? 'selected' : ''; ?>>CITCS</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Course</label> 
                                <select name="course" class="form-control" required>
                                    <option value="" disabled>Select Department</option>
                                    <option value="BSCS" <?= $alumni['Department'] === 'BSCS' ? 'selected' : ''; ?>>BSCS</option>
                                    <option value="BSIT" <?= $alumni['Department'] === 'BSIT' ? 'selected' : ''; ?>>BSIT</option>
                                    <option value="ACT" <?= $alumni['Department'] === 'ACT' ? 'selected' : ''; ?>>ACT</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Section</label> 
                                <select name="section" class="form-control" required>
                                    <option value="" disabled>Select Section</option>
                                    <option value="CS4A" <?= $alumni['Section'] === 'CS4A' ? 'selected' : ''; ?>>CS4A</option>
                                    <option value="CS4B" <?= $alumni['Section'] === 'CS4B' ? 'selected' : ''; ?>>CS4B</option>
                                    <option value="CS4C" <?= $alumni['Section'] === 'CS4C' ? 'selected' : ''; ?>>CS4C</option>
                                    <option value="CS4D" <?= $alumni['Section'] === 'CS4D' ? 'selected' : ''; ?>>CS4D</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Year Graduated</label>
                                <input type="number" name="year_graduated" class="form-control" value="<?= $alumni['Year_Graduated']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" value="<?= $alumni['Contact_Number']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Personal Email</label>
                                <input type="email" name="personal_email" class="form-control" value="<?= $alumni['Personal_Email']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Working Status</label>
                                <select name="working_status" class="form-control" required>
                                    <option value="Employed" <?= $alumni['Working_Status'] === 'Employed' ? 'selected' : ''; ?>>Employed</option>
                                    <option value="Unemployed" <?= $alumni['Working_Status'] === 'Unemployed' ? 'selected' : ''; ?>>Unemployed</option>
                                    <option value="Self-employed" <?= $alumni['Working_Status'] === 'Self-employed' ? 'selected' : ''; ?>>Self-employed</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_alumni" class="btn btn-primary">Update Alumni</button> 
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
s