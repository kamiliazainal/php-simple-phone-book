<?php include('function/read.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>View Contact</title>
<?php include('head.php'); ?>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Contact</h1>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <p><b><?php echo $row["mobile"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <p><b><?php echo $row["email"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>