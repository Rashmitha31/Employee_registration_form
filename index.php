<?php
require_once('config.php');
$displayMessage = '';
$enteredData = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Employee Registration </title>
</head>
<body>
    <div>
    <?php
if(isset($_POST['create'])){
    $name  = $_POST['name'];
    $dob  = $_POST['dob'];
    $age  = $_POST['age'];
    $experience  = $_POST['experience'];
    $department  = $_POST['department'];
    $address  = $_POST['address'];
    $employee_id  = $_POST['employee_id'];
    $salary  = $_POST['salary'];
    $designation  = $_POST['designation'];

    $enteredData = [
        'Name' => $name,
        'Date of Birth' => $dob,
        'Age' => $age,
        'Experience' => $experience,
        'Department' => $department,
        'Address' => $address,
        'Employee ID' => $employee_id,
        'Salary' => $salary,
        'Designation' => $designation
    ];


    $conn = new mysqli("localhost:3008", "root", "chat", "registration");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO employee (name, dob, experience, department, address, employee_id, salary, designation, Age) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtinsert = $conn->prepare($sql);
    
    // Bind parameters and execute the statement
    $stmtinsert->bind_param("ssisssdss", $name, $dob, $experience, $department, $address, $employee_id, $salary, $designation, $age);
    $result = $stmtinsert->execute();

    //if($result){
       // echo 'Successfully saved';
       // header("Location: index.php");
       // exit();
    //} else {
       // echo 'There was an error';
    //}

    if ($result) {
        $displayMessage = 'Successfully saved';
    } else {
        $displayMessage = 'There was an error';
    }

    $stmtinsert->close();
    $conn->close();
}

    //$stmtinsert->close();
    //$conn->close();
//}
?>
    </div>
    <div id="message">
    <?php echo $displayMessage; ?>
    </div>
    <?php
    if (!empty($enteredData)) {
        echo '<h3>Entered Details:</h3>';
        echo '<ul>';
        foreach ($enteredData as $key => $value) {
            echo '<li><strong>' . $key . ':</strong> ' . $value . '</li>';
        }
        echo '</ul>';
    }
    ?>
    
    <h2>Employee Registration</h2>
    <form action="index.php" method="post" id="registrationForm" onsubmit="return validateForm()">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob" onchange="calculateAge()" required><br>

        <label for="age">Age:</label>
        <input type="text" name="age" id="age" readonly><br>

        <label for="experience">Experience:</label>
        <input type="number" name="experience" required><br>

        <label for="department">Department:</label>
        <input type="text" name="department" required><br>

        <label for="address">Address:</label>
        <textarea name="address" rows="4" required></textarea><br>

        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" required><br>

        <label for="salary">Salary:</label>
        <input type="number" name="salary" required><br>

        <label for="designation">Designation:</label>
        <input type="text" name="designation" required><br>

        <input type="submit" name="create" value="Register">
    </form>
    <script src="script.js"></script>
</body>
</html>


