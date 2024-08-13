<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <?php
  $active = 'donate';
  if (file_exists('head.php') && is_readable('head.php')) {
    include('head.php');
  } else {
    echo 'Error: head.php not found or not readable.';
  }
  ?>

  <div id="page-container" class="container-fluid">
    <div class="container">
      <div id="content-wrap" class="py-5">
        <div class="row">
          <div class="col-lg-6">
            <h1 class="mt-4 mb-3">Donate Blood</h1>
          </div>
        </div>
        <form name="donor" action="savedata.php" method="post">
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Full Name <span style="color:red">*</span></div>
              <div><input type="text" name="fullname" class="form-control" required></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Mobile Number <span style="color:red">*</span></div>
              <div><input type="text" name="mobileno" class="form-control" required></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Email Id</div>
              <div><input type="email" name="emailid" class="form-control"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Age <span style="color:red">*</span></div>
              <div><input type="text" name="age" class="form-control" required></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Gender <span style="color:red">*</span></div>
              <div>
                <select name="gender" class="form-control" required>
                  <option value="">Select</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Blood Group <span style="color:red">*</span></div>
              <div>
                <select name="blood" class="form-control" required>
                  <option value="" selected disabled>Select</option>
                  <?php
                  include 'conn.php';
                  $stmt = $conn->prepare("SELECT * FROM blood");
                  $stmt->execute();
                 