<?php
include 'conn.php';
include 'session.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <style>
        #sidebar{position:relative;margin-top:-20px}
        #content{position:relative;margin-left:210px}
        @media screen and (max-width: 600px) {
            #content {
                position:relative;margin-left:auto;margin-right:auto;
            }
        }
        .block-anchor {
            color:red;
            cursor: pointer;
        }
    </style>
</head>
<body style="color:black;">
    <div id="header">
        <?php include 'header.php'; ?>
    </div>
    <div id="sidebar">
        <?php
        $active="dashboard";
        include 'sidebar.php'; ?>
    </div>
    <div id="content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 lg-12 sm-12">
                        <h1 class="page-title">Dashboard</h1>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <?php
                    try {
                        $stmt = $conn->prepare("SELECT * FROM donor_details");
                        $stmt->execute();
                        $donorCount = $stmt->rowCount();

                        $stmt = $conn->prepare("SELECT * FROM contact_query");
                        $stmt->execute();
                        $queryCount = $stmt->rowCount();

                        $stmt = $conn->prepare("SELECT * FROM contact_query WHERE query_status = 2");
                        $stmt->execute();
                        $pendingQueryCount = $stmt->rowCount();

                    ?>
                    <div class="col-md-3">
                        <div class="panel panel-default panel-info" style="border-radius:50px;">
                            <div class="panel-body panel-info bk-primary text-light" style="background-color:#D6EAF8; border-radius:50px">
                                <div class="stat-panel text-center">
                                    <div class="stat-panel-number h1"><?= $donorCount ?></div>
                                    <div class="stat-panel-title text-uppercase">Blood Donors Available</div>
                                    <br>
                                    <button class="btn btn-danger" onclick="window.location.href = 'donor_list.php';">
                                        Full Detail <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="panel panel-default panel-info" style="border-radius:50px;">
                            <div class="panel-body panel-info bk-primary text-light" style="background-color:#ABEBC6;border-radius:50px;">
                                <div class="stat-panel text-center">
                                    <div class="stat-panel-number h1"><?= $queryCount ?></div>
                                    <div class="stat-panel-title text-uppercase">All User Queries</div>
                                    <br>
                                    <button class="btn btn-danger" onclick="window.location.href = 'query.php';">
                                        Full Detail <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="panel panel-default panel-info" style="border-radius:50px;">
                            <div class="panel-body panel-info bk-primary text-light" style="background-color:#E8DAEF ;border-radius:50px; ">
                                <div class="stat-panel text-center">
                                    <div class="stat-panel-number h1"><?= $pendingQueryCount ?></div>
                                    <div class="stat-panel-title text-uppercase">Pending Queries</div>
                                    <br>
                                    <button class="btn btn-danger" onclick="window.location.href = 'pending_query.php';">
                                        Full Detail <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    } catch (Exception $e) {
                        echo 'Error: ' . $e->getMessage();
                    }
                    ?>
                </div>
            </div