<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT product, bestBefore, dateAdded, locationStored FROM productrecord WHERE id = ? ";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
             /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);

                // Retrieve individual field value
                $product = $row["product"];
                $best_before = $row["bestBefore"];
                $date_added = $row["dateAdded"];
                $locationStored= $row["locationStored"];

                // check and compare dates
                $date1 = new DateTime(); //current date or any date
                $date2 = new DateTime($row["bestBefore"]);   //expiration date
                $diff = $date2->diff($date1)->format("%a");  //find difference
                $days = intval($diff);   //rounding days
                $status = "";
                $statusFont = "";
                if($days == 0){
                    $statusFont = "text-danger";
                    $status = "Expired";
                }
                else if($days <= 10 && $days >= 0){
                    $statusFont = "text-warning";
                    $status = "Eat Now";
                }
                else if($days <= 20 && $days >= 10){
                    $statusFont = "text-warning";
                    $status = "Near";
                }
                else if($days <= 40 && $days >= 20){
                    $statusFont = "text-primary";
                    $status = "Okay";
                }
                else if($days >= 40){
                    $statusFont = "text-success";
                    $status = "Good";
                }
                
            } 
            // else {
            //     // URL doesn't contain valid id parameter. Redirect to error page
            //     header("location: error.php");
            //     exit();
            // }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();
} 
// else {
//     // URL doesn't contain id parameter. Redirect to error page
//     header("location: error.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record | Best Before</title>
    <!-- icon -->
    <link rel="icon" href="img/letter-b.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- nav bar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="user-information">
                <img src="img\user-logo.png" alt="" id="user-icon">
                <a class="navbar-brand"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
            </div>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
            <a href="logout.php" class="btn btn-danger ml-3">Log Out</a>
        </div>
    </nav>
    <!-- nav bar -->

    <div class="container-sm">
        <div class="d-flex justify-content-center align-items-center container">
            <div class="read-container">
                <div class="main-container">
                    <div class="wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="mt-5 mb-3">View Record</h2>

                                    <hr>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col"><label>Product Name:</label></div>
                                            <div class="col">
                                                <p><b><?php echo $row["product"]; ?></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col"><label>Status:</label></div>
                                            <div class="col">
                                                <p class="<?php echo $statusFont; ?>"><b><?php echo $status; ?></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col"><label>Days Left:</label></div>
                                            <div class="col">
                                                <p><b><?php echo $days . " days left"; ?></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col"><label>Best Before:</label></div>
                                            <div class="col">
                                                <p><b><?php echo $row["bestBefore"]; ?></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col"><label>Date Added:</label></div>
                                            <div class="col">
                                                <p><b><?php echo $row["dateAdded"]; ?></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col"><label>Stored Location:</label></div>
                                            <div class="col">
                                                <p><b><?php echo $row["locationStored"]; ?></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- button back -->
                                    <p><a href="index.php" class="btn btn-primary">Back</a></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>