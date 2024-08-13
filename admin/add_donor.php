<?php
session_start();
include 'conn.php';

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    // Validate input data
    if (empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
        echo '<div class="alert alert-danger"><b> Please fill in all fields.</b></div>';
    } elseif ($password != $confirmpassword) {
        echo '<div class="alert alert-warning"><b> Password and Confirm Password Not Matched!</b></div>';
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT admin_username FROM admin_info WHERE admin_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo '<div class="alert alert-danger"><b> Username already exists.</b></div>';
        } else {
            // Hash and salt the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert into database
            $stmt = $conn->prepare("INSERT INTO admin_info (admin_username, admin_email, admin_password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo '<div class="alert alert-success"><b> Registration successful.</b></div>';
            } else {
                echo '<div class="alert alert-danger"><b> Error registering user.</b></div>';
            }
        }
    }
}
?>

<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>Register</h1>
                <form method="post" name="register" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="confirmpassword" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button class="btn btn-primary" name="submit" type="submit">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
session_start();
include 'conn.php';

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate input data
    if (empty($username) || empty($password)) {
        echo '<div class="alert alert-danger"><b> Please fill in all fields.</b></div>';
    } else {
        // Check if username and password are correct
        $stmt = $conn->prepare("SELECT admin_password FROM admin_info WHERE admin_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hashed_password = $row['admin_password'];

        if (password_verify($password, $hashed_password)) {
            // Login successful, set session variables
            $_SESSION['loggedin'] = true;
           