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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        // Prepare an insert statement
        $sql = "INSERT INTO productrecord (productID, product, bestBefore, locationStored) VALUES (?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_productID, $param_name, $param_expdate, $param_location);

            // Set parameters
            $param_productID = htmlspecialchars($_SESSION["username"]);
            $param_name = $name;
            $param_expdate = $expdate;
            $param_location = $location;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record | Best Before</title>
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

            <a href="logout.php" class="btn btn-danger ml-3">Log Out</a>
        </div>
    </nav>
    <!-- nav bar -->

    <div class="d-flex justify-content-center">
        <div class="create-container">
            <div class="main-container">
                <div class="wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="mt-1">Create Record</h2>
                                <p>Please fill to track the expiration date of your food</p>
                                <hr>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                                                    value="<?php echo $expdate; ?>" min="2022-01-01" max="2050-01-01"
                                                    name="expdate">
                                                <br>
                                                <span class="text-danger"><small><?php echo $expdate_err; ?></small>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Location Stored</label>
                                                <br>
                                                <select name="location-stored" id="" class="form-dropdown"
                                                    value="<?php echo $location; ?>">
                                                    <option selected="" value="">Select</option>
                                                    <option value="Cabinet">Cabinet</option>
                                                    <option value="Cupboard">Cupboard</option>
                                                    <option value="Dispenser">Dispenser</option>
                                                    <option value="Pantry">Pantry</option>
                                                    <option value="Refrigerator">Refrigerator</option>
                                                    <option value="Table">Table</option>
                                                </select>
                                                <br>
                                                <span class="text-danger"><small><?php echo $location_err; ?></small>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

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

</body>

</html>