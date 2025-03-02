<?php
require_once('db_connect.php');
$conn = connectDB();

$error_message = '';
$success_message = '';
$patient_data = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['find_patient'])) {
        $ohip = mysqli_real_escape_string($conn, $_POST['ohip']);
        $query = "SELECT p.*, d.firstname as doc_firstname, d.lastname as doc_lastname 
                  FROM patient p 
                  LEFT JOIN doctor d ON p.treatsdocid = d.docid 
                  WHERE p.ohip = '$ohip'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $patient_data = mysqli_fetch_assoc($result);
        } else {
            $error_message = "No patient found with this OHIP number.";
        }
    } elseif (isset($_POST['confirm_delete'])) {
        $ohip = mysqli_real_escape_string($conn, $_POST['ohip']);
        $delete_query = "DELETE FROM patient WHERE ohip = '$ohip'";
        
        if (mysqli_query($conn, $delete_query)) {
            $success_message = "Patient deleted successfully!";
            $patient_data = null;
        } else {
            $error_message = "Error deleting patient: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Patient</title>
    <style>
        .error { color: red; }
        .success { color: green; }
        .patient-info { margin: 20px 0; padding: 10px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h1>Delete Patient</h1>
    
    <?php if ($error_message): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    
    <?php if ($success_message): ?>
        <p class="success"><?php echo $success_message; ?></p>
    <?php endif; ?>
    
    <?php if (!$patient_data): ?>
        <form method="POST">
            <div>
                <label>Enter OHIP Number: <input type="text" name="ohip" required pattern="[0-9]{9}"></label>
            </div>
            <div>
                <input type="submit" name="find_patient" value="Find Patient">
            </div>
        </form>
    <?php else: ?>
        <div class="patient-info">
            <h2>Patient Information</h2>
            <p>Name: <?php echo "{$patient_data['firstname']} {$patient_data['lastname']}"; ?></p>
            <p>OHIP: <?php echo $patient_data['ohip']; ?></p>
            <p>Birth Date: <?php echo $patient_data['birthdate']; ?></p>
            <p>Doctor: <?php echo "{$patient_data['doc_firstname']} {$patient_data['doc_lastname']}"; ?></p>
            
            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this patient?');">
                <input type="hidden" name="ohip" value="<?php echo $patient_data['ohip']; ?>">
                <input type="submit" name="confirm_delete" value="Delete Patient">
            </form>
        </div>
    <?php endif; ?>
    
    <p><a href="mainmenu.php">Back to Main Menu</a></p>
</body>
</html>
<?php
disconnectDB($conn);
?>
