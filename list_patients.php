<?php
require_once('db_connect.php');
$conn = connectDB();

$orderBy = isset($_POST['orderBy']) ? $_POST['orderBy'] : 'lastname';
$orderDir = isset($_POST['orderDir']) ? $_POST['orderDir'] : 'ASC';

$query = "SELECT p.*, d.firstname as doc_firstname, d.lastname as doc_lastname 
          FROM patient p 
          LEFT JOIN doctor d ON p.treatsdocid = d.docid 
          ORDER BY p.$orderBy $orderDir";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .order-form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Patient List</h1>
    
    <form method="POST" class="order-form">
        <div>
            Order by:
            <input type="radio" name="orderBy" value="lastname" <?php echo $orderBy == 'lastname' ? 'checked' : ''; ?>> Last Name
            <input type="radio" name="orderBy" value="firstname" <?php echo $orderBy == 'firstname' ? 'checked' : ''; ?>> First Name
        </div>
        <div>
            Order direction:
            <input type="radio" name="orderDir" value="ASC" <?php echo $orderDir == 'ASC' ? 'checked' : ''; ?>> Ascending
            <input type="radio" name="orderDir" value="DESC" <?php echo $orderDir == 'DESC' ? 'checked' : ''; ?>> Descending
        </div>
        <input type="submit" value="Update Order">
    </form>

    <table>
        <tr>
            <th>OHIP</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Weight (kg/lbs)</th>
            <th>Height (m/ft-in)</th>
            <th>Birth Date</th>
            <th>Doctor</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $weightLbs = round($row['weight'] * 2.20462, 2);
            $heightInches = round($row['height'] * 39.3701);
            $feet = floor($heightInches / 12);
            $inches = $heightInches % 12;
            
            echo "<tr>";
            echo "<td>{$row['ohip']}</td>";
            echo "<td>{$row['firstname']}</td>";
            echo "<td>{$row['lastname']}</td>";
            echo "<td>{$row['weight']} kg / {$weightLbs} lbs</td>";
            echo "<td>{$row['height']} m / {$feet}'{$inches}\"</td>";
            echo "<td>{$row['birthdate']}</td>";
            echo "<td>{$row['doc_firstname']} {$row['doc_lastname']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <p><a href="mainmenu.php">Back to Main Menu</a></p>
</body>
</html>
<?php
disconnectDB($conn);
?>
