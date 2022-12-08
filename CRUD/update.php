<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $expdate = $location = "";
$name_err = $expdate_err = $location_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

     // Validate name
     $input_name = trim($_POST["name"]);
     if (empty($input_name)) {
         $name_err = "Please enter product name.";
     } else {
         $name = $input_name;
     }
 
     // Validate date
     $input_expdate = $_POST["expdate"];
     if ($input_expdate != '') {
         $expdate = $input_expdate;
     } 
     else {
         $expdate_err = "Please select the expiration date.";    
     }
  
     // Validate location stored
     $input_locationstored =  isset($_POST['location-stored']);
     if($input_locationstored){
         if ($_POST["location-stored"] != '') {
             $location = $_POST["location-stored"];
          } 
          else {
            $location_err = "Please select where you have stored your item.";
          }
     }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($expdate_err) && empty($location_err)) {
        // Prepare an update statement
        $sql = "UPDATE productrecord SET product=?, bestBefore=?, locationStored=? WHERE id=?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssi", $param_name, $param_expdate, $param_location, $param_id);

            // Set parameters
            $param_name = $name;
            $param_expdate = $expdate;
            $param_location = $location;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM productrecord WHERE id = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $name = $row["product"];
                    $expdate = $row["bestBefore"];
                    $location = $row["locationStored"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();

        // Close connection
        $mysqli->close();
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
            <a href="logout.php" class="btn btn-danger ml-3">Log Out</a>
        </div>
    </nav>
    <!-- nav bar -->

    <div class="container-sm">
        <div class="d-flex justify-content-center align-items-center container">
            <div class="update-container">
                <div class="main-container">
                    <div class="wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 name="update-title" class="mt-5">Update Record</h2>
                                    <p>Please edit the input values and submit to update the record of the tracker.</p>
                                    <hr>
                                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>"
                                        method="post">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" name="name"
                                                class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                                value="<?php echo $name; ?>">
                                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Expiration Date</label>
                                                    <br>
                                                    <input type="date" placeholder="dd-mm-yyyy"
                                                        value="<?php echo $expdate; ?>" min="2022-01-01"
                                                        max="2050-01-01" name="expdate">
                                                    <br>
                                                    <span class="text-danger"><small><?php echo $expdate_err; ?></small>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Location Stored</label>
                                                    <br>
                                                    <select name="location-stored" id="" class="form-dropdown">
                                                        <option selected="" value="">Select</option>
                                                        <option value="refrigerator">Refrigerator</option>
                                                        <option value="cupboard">Cupboard</option>
                                                        <option value="table">Table</option>
                                                    </select>
                                                    <br>
                                                    <span
                                                        class="text-danger"><small><?php echo $location_err; ?></small>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <input type="submit" class="btn btn-success" value="Submit">
                                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                                    </form>
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