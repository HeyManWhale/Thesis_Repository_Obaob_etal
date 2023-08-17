<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../lib/report-create.css">

    <title>Bamboo Report Create</title>
</head>
<body>

    <nav>
        <div class="menu">
        <div class="logo">
            <a href="header_user.php">MaasinBamboo</a>
        </div>
        <ul>
            <li><a href="report-create.php">Report Form</a></li>
            <li><a href="report-view.php">View Report</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
        </div>
    </nav>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Bamboo Report
                            <a href="header_user.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">

                            <div class="mb-3">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Farmer's Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Barangay</label>
                                <input type="text" name="barangay" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Total Quantity of Bamboo Clumps</label>
                                <input type="number" name="quantity" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Total Quantity of Bamboo Clumps Harvested</label>
                                <input type="number" name="harvested" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Total Quantity of Bamboo Destroyed (if any in sq. m.)</label>
                                <input type="number" name="destroyed" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="save_report" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
