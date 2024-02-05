<?php

$servername = "localhost"; // MySQL server hostname (usually 'localhost' for local development)
$username = "root"; // MySQL username
$password = "pandasql"; // MySQL password
$dbname = "Employee_REG"; // Name of your MySQL database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert Employee Details
if(isset($_POST['insert'])){
    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
    $emp_name = mysqli_real_escape_string($conn, $_POST['emp_name']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Insert data into the database
    $sql = "INSERT INTO employees (emp_id, emp_name, department, phone) VALUES ('$emp_id', '$emp_name', '$department', '$phone')";
    if (mysqli_query($conn, $sql)) {
        echo "Employee details inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Delete Employee Record
if(isset($_POST['delete'])){
    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);

    // Delete record from the database
    $sql = "DELETE FROM employees WHERE emp_id='$emp_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Employee record deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Update Employee Details
if(isset($_POST['update'])){
    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
    $updated_name = mysqli_real_escape_string($conn, $_POST['emp_name']);
    $updated_department = mysqli_real_escape_string($conn, $_POST['department']);
    $updated_phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Update record in the database
    $sql = "UPDATE employees SET emp_name='$updated_name', department='$updated_department', phone='$updated_phone' WHERE emp_id='$emp_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Employee details updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Display Updated Employee Details
if(isset($_POST['display'])){
    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id_display']);

    // Retrieve and display data from the database
    $sql = "SELECT * FROM employees WHERE emp_id='$emp_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "ID: " . $row["emp_id"]. " - Name: " . $row["emp_name"]. " - Department: " . $row["department"]. " - Phone: " . $row["phone"]. "<br>";
        }
    } else {
        echo "0 results found";
    }
}

mysqli_close($conn);
?>
