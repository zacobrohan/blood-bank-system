<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo '<div class="alert alert-danger"><b> Please Login First To Access Admin Portal.</b></div>';
    ?>
    <form method="post" action="login.php" class="form-horizontal">
        <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
    </form>
    <?php
    exit;
}

$username = $_SESSION['username'];

if (isset($_POST["submit"])) {
    $currpassword = $_POST["currpassword"];
    $newpassword = $_POST["newpassword"];
    $confirmpassword = $_POST["confirmpassword"];

    if (empty($currpassword) || empty($newpassword) || empty($confirmpassword)) {
        echo '<div class="alert alert-danger"><b> Please fill in all fields.</b></div>';
    } elseif ($newpassword != $confirmpassword) {
        echo '<div class="alert alert-warning"><b> New Password and Confirm Password Not Matched!</b></div>';
    } else {
        $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE admin_info SET admin_password = ? WHERE admin_username = ?");
        $stmt->bind_param("ss", $hashed_password, $username);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo '<div class="alert alert-success"><b> Password Changed Successfully.</b></div>';
        } else {
            echo '<div class="alert alert-danger"><b> Error updating password.</b></div>';
        }
    }
}
?>

<html>
<head>
    <!-- Bootstrap CSS and JavaScript files -->
</head>
<body>
    <div id="header">
        <?php include 'header.php'; ?>
    </div>
    <div id="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>
    <div id="content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 lg-12 sm-12">
                        <h1 class="page-title">Change Password</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">Password Fields</div>
                            <div class="panel-body">
                                <form method="post" name="chngpwd" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Current Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="currpassword" id="password" required>
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">New Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="newpassword" id="newpassword" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Confirm Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <button class="btn btn-primary" name="submit" type="submit">Change Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>