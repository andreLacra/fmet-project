<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $expdate = $salary = "";
$name_err = $expdate_err = $salary_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter product name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate date
    $input_expdate = $_POST['expdate'];
    if ($input_expdate != '') {
        $expdate = $input_expdate;
    } 
    else {
        $expdate_err = "Please select the expire date.";    
    }
    // function IsDateTime($input_expdate) {
    //     try {
    //         $fTime = new DateTime($input_expdate);
    //         $fTime->format('d/m/Y H:i:s');
    //         $expdate = $input_expdate;
    //     }
    //     catch (Exception $e) {
    //         $expdate_err = "Please select the expire date.";
    //     }
    // }

    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if (empty($input_salary)) {
        $salary_err = "Please enter the salary amount.";
    } elseif (!ctype_digit($input_salary)) {
        $salary_err = "Please enter a positive integer value.";
    } else {
        $salary = $input_salary;
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($expdate_err) && empty($salary_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, expdate, salary) VALUES (?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_name, $param_expdate, $param_salary);

            // Set parameters
            $param_name = $name;
            $param_expdate = $expdate;
            $param_salary = $salary;

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
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="main-container">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="mt-5">Create Record</h2>
                            <p>Please fill to track the expiration date of your food</p>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="name"
                                        class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                        value="<?php echo $name; ?>">
                                    <span class="invalid-feedback"><?php echo $name_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Expiration Date</label>
                                    <br>
                                    <span class="datepicker-container"> <input type="date" class="expDateInput"
                                            name="expdate">
                                    </span>
                                    <span class="invalid-feedback"><?php echo $expdate_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Salary</label>
                                    <input type="text" name="salary"
                                        class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>"
                                        value="<?php echo $salary; ?>">
                                    <span class="invalid-feedback"><?php echo $salary_err; ?></span>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>