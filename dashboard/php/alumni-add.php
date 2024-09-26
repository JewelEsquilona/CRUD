<?php
// Start the session only if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Alumni Create</title>
</head>
<body>

    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Alumni Add 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="submit-alumni.php" method="POST">

                            <div class="mb-3">
                                <label>Student Number</label>
                                <input type="text" name="student_number" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" class="form-control">
                            </div>
                            
                            <div class="mb-3">
                                <label>Course</label>
                                <select name="course" id="course" class="form-control" required>
                                    <option value="">Select Course</option>
                                    <option value="CITCS">CITCS</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Department</label>
                                <select name="department" id="department" class="form-control" required>
                                    <option value="">Select Department</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Section</label>
                                <select name="section" id="section" class="form-control" required>
                                    <option value="">Select Section</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Year Graduated</label>
                                <input type="number" name="year_graduated" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Personal Email</label>
                                <input type="email" name="personal_email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Working Status</label>
                                <select name="working_status" class="form-control" required>
                                    <option value="">Select Working Status</option>
                                    <option value="Employed">Employed</option>
                                    <option value="Unemployed">Unemployed</option>
                                    <option value="Self-employed">Self-employed</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="save_alumni" class="btn btn-primary">Save Alumni</button> 
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const courses = {
            'CITCS': {
                'BSCS': ['CS4A', 'CS4B', 'CS4C', 'CS4D'],
                'BSIT': ['IT1', 'IT2', 'IT3', 'IT4'],
                'ACT': ['ACT1', 'ACT2', 'ACT3', 'ACT4'],
            }
        };

        document.getElementById('course').addEventListener('change', function() {
            const departmentSelect = document.getElementById('department');
            const sectionSelect = document.getElementById('section');

            const selectedCourse = this.value;

            departmentSelect.innerHTML = '<option value="">Select Department</option>';
            sectionSelect.innerHTML = '<option value="">Select Section</option>';

            if (selectedCourse) {
                Object.keys(courses[selectedCourse]).forEach(department => {
                    const option = document.createElement('option');
                    option.value = department;
                    option.textContent = department;
                    departmentSelect.appendChild(option);
                });
            }
        });

        document.getElementById('department').addEventListener('change', function() {
            const sectionSelect = document.getElementById('section');
            const selectedCourse = document.getElementById('course').value;
            const selectedDepartment = this.value;

            sectionSelect.innerHTML = '<option value="">Select Section</option>';

            if (selectedCourse && selectedDepartment) {
                courses[selectedCourse][selectedDepartment].forEach(section => {
                    const option = document.createElement('option');
                    option.value = section;
                    option.textContent = section;
                    sectionSelect.appendChild(option);
                });
            }
        });
    </script>
</body>
</html>
