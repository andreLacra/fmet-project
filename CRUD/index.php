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
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
            <a href="logout.php" class="btn btn-danger ml-3">Log Out</a>
        </div>
    </nav>
    <!-- nav bar -->

    <div class="d-flex justify-content-center align-items-center container ">
        <div class="main-container">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mt-5 mb-3 clearfix">
                                <i class="fa-sharp fa-solid fa-plate-utensils"></i>
                                <h2 class="pull-left">Products Details</h2>
                                <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i>
                                    Add
                                    Product To Track</a>
                            </div>
                            <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $productID = htmlspecialchars($_SESSION["username"]);
                    $sql = "SELECT product, bestBefore, dateAdded, locationStored FROM productrecord WHERE productID =\"$productID\"
                            ";
                            if ($result = $mysqli->query($sql)) {
                            if ($result->num_rows > 0) {
                            echo '<table class="table table-bordered table-striped">';
                                echo '<thead class="table-group-divider">';
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Product</th>";
                                        echo "<th>Best Before</th>";
                                        echo "<th>Date Added</th>";
                                        echo "<th>Location Stored</th>";
                                        echo '<th><select name="sor-dropdwon" id="" class="form-dropdown">
                            <option selected="" value="">Sort By</option>
                            <option value="near-expired">Expired: Near - Not Near</option>
                            <option value="not-near-expired">Expired: Not Near - Near</option>
                            <option value="latest-item">Latest Item</option>
                            <option value="oldest-item">Oldest Item</option>
                            </select></th>';
                            echo "</tr>";
                            echo "</thead>";
                            echo '<tbody>';
                                while ($row = $result->fetch_array()) {
                                $countProductBase = 0;
                                $countProductIncre = $countProductBase + 1;
                                echo "<tr>";
                                    echo "<td>" . $countProductIncre . "</td>";
                                    echo "<td>" . $row['product'] . "</td>";
                                    echo "<td>" . $row['bestBefore'] . "</td>";
                                    echo "<td>" . $row['dateAdded'] . "</td>";
                                    echo "<td>" . $row['locationStored'] . "</td>";
                                    echo "<td>";
                                        echo '<a href="read.php?id=' . $row[$countProductIncre] . '" class="mr-3"
                                            title="View Record" data-toggle="tooltip"><span
                                                class="fa fa-eye"></span></a>';
                                        echo '<a href="update.php?id=' . $row[$countProductIncre] . '" class="mr-3"
                                            title="Update Record" data-toggle="tooltip"><span
                                                class="fa fa-pencil"></span></a>';
                                        echo '<a href="delete.php?id=' . $row[$countProductIncre] . '"
                                            title="Delete Record" data-toggle="tooltip"><span
                                                class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            $result->free();
                            } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
                            } else {
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

</body>

</html>