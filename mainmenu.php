// mainmenu.php
<?php
// Main menu page for hospital management system
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .menu-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .menu-item {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .menu-item a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <h1>Hospital Management System</h1>
    <div class="menu-container">
        <div class="menu-item">
            <a href="list_patients.php">List All Patients</a>
        </div>
        <div class="menu-item">
            <a href="add_patient.php">Add New Patient</a>
        </div>
        <div class="menu-item">
            <a href="delete_patient.php">Delete Patient</a>
        </div>
        <div class="menu-item">
            <a href="modify_patient.php">Modify Patient Weight</a>
        </div>
        <div class="menu-item">
            <a href="doctors_no_patients.php">Doctors Without Patients</a>
        </div>
        <div class="menu-item">
            <a href="doctor_patients.php">Doctors and Their Patients</a>
        </div>
        <div class="menu-item">
            <a href="nurse_details.php">Nurse Work Details</a>
        </div>
    </div>
</body>
</html>

