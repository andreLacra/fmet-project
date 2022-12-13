<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | Best Before</title>
    <script src="script.js"></script>
    <!-- icon -->
    <link rel="icon" href="img/letter-b.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
</head>

<body>
    <!-- nav bar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="user-information">
                <img src="img\user-logo.png" alt="" id="user-icon">
                <a class="navbar-brand"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
            </div>
            <a href="logout.php" class="btn btn-danger ml-3">Log Out</a>
        </div>
    </nav>
    <!-- nav bar -->

    <div class="container-sm">
        <div class="d-flex justify-content-center align-items-center container ">
            <div class="table-container">
                <div class="main-container">
                    <div class="wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mt-5 mb-3 clearfix">
                                        <i class="fa-sharp fa-solid fa-plate-utensils"></i>
                                        <h2 class="pull-left">Products Details</h2>
                                        <a href="create.php" class="btn btn-success pull-right"><i
                                                class="fa fa-plus"></i>
                                            Add Product To Track</a>
                                    </div>

                                    <hr>

                                    <div class="sort-container">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>"
                                            method="post" onchange="this.form.submit()">
                                            <div class="row">
                                                <div class="col-4">
                                                    <select name="sortDropdown" id="sort-dropdown"
                                                        class="form-dropdown-3">
                                                        <option selected="" value="">Sort By</option>
                                                        <option value="nearExpired">Expired: Ascending</option>
                                                        <option value="notNearExpired">Expired: Descending</option>
                                                        <option value="latestItem">Latest Item</option>
                                                        <option value="oldestItem">Oldest Item</option>
                                                    </select>
                                                </div>
                                                <div class="col"><button type="submit" id="btnSort">- sort -</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $productID = htmlspecialchars($_SESSION["username"]);
                    $sql = "SELECT id, product, bestBefore, dateAdded, locationStored FROM productrecord WHERE productID =\"$productID\"
                    ";   
                    $sortSelect = isset($_POST["sortDropdown"]) ;
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (($_POST["sortDropdown"]) == "nearExpired") {
                            $sql = "SELECT id, product, bestBefore, dateAdded, locationStored FROM productrecord WHERE productID =\"$productID\" ORDER BY date(bestBefore)asc";
                        }
                        else if(($_POST["sortDropdown"]) == "notNearExpired") {
                            $sql = "SELECT id, product, bestBefore, dateAdded, locationStored FROM productrecord WHERE productID =\"$productID\" ORDER BY date(bestBefore)desc";
                        }
                        else if(($_POST["sortDropdown"]) == "latestItem") {
                            $sql = "SELECT id, product, bestBefore, dateAdded, locationStored FROM productrecord WHERE productID =\"$productID\" ORDER BY date(dateAdded)desc";
                        }
                        else if(($_POST["sortDropdown"]) == "oldestItem") {
                            $sql = "SELECT id, product, bestBefore, dateAdded, locationStored FROM productrecord WHERE productID =\"$productID\" ORDER BY date(dateAdded)asc";
                        }
                    }
                        if ($result = $mysqli->query($sql)) {
                            if ($result->num_rows > 0) {
                            echo '<div class="table-container-content">';
                            echo '<table class="table table-bordered table-striped table-responsive-sm WIDTH="50%">';
                                echo '<thead>';
                                    echo "<tr>";
                                        echo "<th>Product</th>";
                                        echo "<th>Status</th>";
                                        echo "<th>Days Left</th>";
                                        echo "<th>Best Before</th>";
                                        echo "<th>Date Added</th>";
                                        echo "<th>Location Stored</th>";
                                        echo '<th></th>';
                            echo "</tr>";
                            echo "</thead>";
                            echo '<tbody class="tableBody">';
                                while ($row = $result->fetch_array()) {
                                    $storeID = $row['id'];
                                    // check and compare dates
                                    $date1 = new DateTime(); //current date or any date
                                    $date2 = new DateTime($row['bestBefore']);   //expiration date
                                    $diff = $date2->diff($date1)->format("%a");  //find difference
                                    $days = $diff;   //rounding days
                                    $status = "";

                                    if ($date2 < $date1) {// easily comparison of 1355077800 > 1287426600
                                        $days = 0;
                                    } 
                                    
                                    if($days == 0){
                                        $status = '<span class="text-danger">Expired</span>';
                                    }
                                    else if($days <= 10 && $days >= 0){
                                        $status = '<span class="text-danger">Eat Now</span>';
                                    }
                                    else if($days <= 20 && $days >= 10){
                                        $status = '<span class="text-warning">Near</span>';
                                    }
                                    else if($days <= 40 && $days >= 20){
                                        $status = '<span class="text-primary">Okay</span>';
                                    }
                                    else if($days >= 40){
                                        $status = '<span class="text-success">Good</span>';
                                    }
                                    
                                    echo "<tr>";
                                    echo "<td>" . $row['product'] . "</td>";
                                    echo "<td>" . $status . "</td>";
                                    echo "<td>" . $days . "</td>";
                                    echo "<td>" . $row['bestBefore'] . "</td>";
                                    echo "<td>" . $row['dateAdded'] . "</td>";
                                    echo "<td>" . $row['locationStored'] . "</td>";
                                    echo "<td>";
                                        echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3"
                                            title="View Record" data-toggle="tooltip"><svg id="icon-table" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                          </svg></a>';
                                        echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3"
                                            title="Update Record" data-toggle="tooltip"><svg id="icon-table" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                          </svg></a>';
                                        echo '<a href="delete.php?id=' . $row['id'] . '"
                                            title="Delete Record" data-toggle="tooltip"><svg id="icon-table" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2-fill" viewBox="0 0 16 16">
                                            <path d="M2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225zm9.89-.69C10.966 2.214 9.578 2 8 2c-1.58 0-2.968.215-3.926.534-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466-.18-.14-.498-.307-.975-.466z"/>
                                          </svg></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            echo '</div>';
                            // Free result set
                            $result->free();
                            } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';     
                            }
                            } 
                            else {
                            echo "Oops! Something went wrong. Please try again later.";
                            }

                            // Close connection
                            $mysqli->close();
                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    if (<?php echo $days; ?> == 0 || <?php echo $days; ?> < 0) {
        alert("It looks like one of the item is expired. Please DISPOSE, and DO NOT CONSUME.");
    }
    </script>

</body>

</html>