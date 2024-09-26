<?php
session_start();
require '../db/config.php'; 

// Delete Alumni
if (isset($_POST['delete_alumni'])) {
    $alumni_id = $_POST['delete_alumni'];

    $stmt = $con->prepare("DELETE FROM `2024-2025` WHERE Alumni_ID_Number = ?");
    $stmt->bind_param("s", $alumni_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Alumni Deleted Successfully";
    } else {
        $_SESSION['message'] = "Alumni Not Deleted: " . $stmt->error;
    }
    header("Location: index.php");
    exit(0);
}

// Update Alumni
if (isset($_POST['update_alumni'])) {
    // Retrieve and sanitize input
    $alumni_id = mysqli_real_escape_string($con, $_POST['alumni_id']);
    $student_number = mysqli_real_escape_string($con, $_POST['student_number']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($con, $_POST['middle_name']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $department = mysqli_real_escape_string($con, $_POST['department']);
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $year_graduated = mysqli_real_escape_string($con, $_POST['year_graduated']);
    $contact_number = mysqli_real_escape_string($con, $_POST['contact_number']);
    $personal_email = mysqli_real_escape_string($con, $_POST['personal_email']);

    $stmt = $con->prepare("UPDATE `2024-2025` SET 
        Student_Number=?, 
        Last_Name=?, 
        First_Name=?, 
        Middle_Name=?, 
        Course=?, 
        Department=?, 
        Section=?, 
        Year_Graduated=?, 
        Contact_Number=?, 
        Personal_Email=? 
        WHERE Alumni_ID_Number=?");

    $stmt->bind_param(
        "sssssssssss",
        $student_number,
        $last_name,
        $first_name,
        $middle_name,
        $course,
        $department,
        $section,
        $year_graduated,
        $contact_number,
        $personal_email,
        $alumni_id
    );

    if ($stmt->execute()) {
        $_SESSION['message'] = "Alumni Updated Successfully";
    } else {
        $_SESSION['message'] = "Alumni Not Updated: " . $stmt->error;
    }
    header("Location: index.php");
    exit(0);
}

// Save Alumni
if (isset($_POST['save_alumni'])) {
    // Retrieve and sanitize input
    $student_number = mysqli_real_escape_string($con, $_POST['student_number']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($con, $_POST['middle_name']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $department = mysqli_real_escape_string($con, $_POST['department']);
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $year_graduated = mysqli_real_escape_string($con, $_POST['year_graduated']);
    $contact_number = mysqli_real_escape_string($con, $_POST['contact_number']);
    $personal_email = mysqli_real_escape_string($con, $_POST['personal_email']);

    $stmt = $con->prepare("INSERT INTO `2024-2025` 
        (Student_Number, Last_Name, First_Name, Middle_Name, Course, Department, Section, Year_Graduated, Contact_Number, Personal_Email) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssssssssss",
        $student_number,
        $last_name,
        $first_name,
        $middle_name,
        $course,
        $department,
        $section,
        $year_graduated,
        $contact_number,
        $personal_email
    );

    if ($stmt->execute()) {
        $alumni_id = $stmt->insert_id; // Get the last inserted ID

        // Now also add to the 2024-2025_ws table
        $stmt_ws = $con->prepare("INSERT INTO `2024-2025_ws` (Alumni_ID_Number, Working_Status) VALUES (?, ?)");
        $stmt_ws->bind_param("ss", $alumni_id, $working_status);
        $stmt_ws->execute(); // Insert into the working status table

        $_SESSION['message'] = "Alumni Created Successfully";
        header("Location: alumni-add.php"); // Update to redirect back to the add form after success
        exit(0);
    } else {
        $_SESSION['message'] = "Alumni Not Created: " . $stmt->error;
        header("Location: alumni-add.php"); // Update to redirect back to the add form on failure
        exit(0);
    }
}
