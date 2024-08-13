<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $number = $_POST['mobileno'];
    $email = $_POST['emailid'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood'];
    $address = $_POST['address'];

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "blood_donation");
    if (!$conn) {
        die("Connection error: " . mysqli_connect_error());
    }

    // Prepare and bind the query
    $sql = "INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sssissss", $name, $number, $email, $age, $gender, $blood_group, $address);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        header("Location: http://localhost/BDMS/admin/donor_list.php");
        exit;
    } else {
        die("Query unsuccessful: " . mysqli_error($conn));
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>