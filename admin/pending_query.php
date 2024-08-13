<?php
session_start();
include 'conn.php';
include 'session.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
#sidebar{position:relative;margin-top:-20px}
#content{position:relative;margin-left:210px}
@media screen and (max-width: 600px) {
  #content {
    position:relative;margin-left:auto;margin-right:auto;
  }
}
#he{
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
  padding: 3px 7px;
  color: #fff;
  text-decoration: none;
  border-radius: 3px;
  align:center
}
</style>

</head>

<body style="color:black">
<div id="header">
<?php include 'header.php'; ?>
</div>

<div id="sidebar">
<?php $active="query"; include 'sidebar.php'; ?>

</div>

<div id="content" >
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 lg-12 sm-12">

          <h1 class="page-title">Pending Query</h1>

        </div>

      </div>
      <hr>
      <script>
      function clickme(id){
        if(confirm("Do you really Want to Read ?"))
        {
            document.getElementById("demo").innerHTML = "Read";
            <?php
            echo '<div class="alert alert-info alert_dismissible"><b><button type="button" class="close" data-dismiss="alert">&times;</button></b><b>Pending Request "Read".</b></div>';

            $que_id = $_GET['id'];
             $sql1="update contact_query set query_status='1' where  query_id={$que_id}";
              $result=mysqli_query($conn,$sql1);
            ?>
        }
      }

      </script>

      <?php
        include 'conn.php';

          $limit = 10;
          if(isset($_GET['page'])){
            $page = (int)$_GET['page'];
          }else{
            $page = 1;
          }
          $offset = ($page - 1) * $limit;
          $count=$offset+1;
        $sql= " select * from contact_query where query_status>1 LIMIT {$offset},{$limit}";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0)   {
       ?>

       <div class="table-responsive">
      <table class="table table-bordered" style="text-align:center">
          <thead style="text-align:center">
          <th style="text-align:center">S.no</th>
          <th style="text-align:center">Name</th>
          <th style="text-align:center">Email Id</th>
          <th style="text-align:center">Mobile Number</th>
          <th style="text-align:center">Message</th>
          <th style="text-align:center">Posting Date</th>
          <th style="text-align:center">Status</th>
          <th style="text-align:center">Action</th>
          </thead>
          <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result)) { ?>
          <tr>

                  <td><?php echo $count++; ?></td>
                  <td><?php echo htmlspecialchars($row['query_name']); ?></td>
                  <td><?php echo htmlspecialchars($row['query_mail']); ?></td>
                  <td><?php echo htmlspecialchars($row['query_number']); ?></td>
                  <td><?php echo htmlspecialchars($row['query_message']); ?></td>
                  <td><?php echo htmlspecialchars($row['query_date']); ?></td>
                  <?php if($row['query_status']==1)
{
?><td>Read<br></td>
<?php } else {?>

<td><a href="query.php?id=<?php echo $row['query_id'];?>" onclick="clickme(<?php echo $row['query_id'];?>)"><b id="demo">Pending</b></a><br>


</td>
<?php } ?>
                    <td id="he" style="width:100px">
                   