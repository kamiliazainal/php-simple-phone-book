<?php
// Include config file
require_once "config.php";

$name ="";
$mobile = "";
$email = "";
$name_err = "";
$mobile_err = "";
$email_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validattion
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }
    $input_mobile = trim($_POST["mobile"]);
    if (empty($input_mobile)) {
        $mobile_err = "Please enter mobile number.";
    } else {
        $mobile = $input_mobile;
    }
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter email.";
    } else {
        $email = $input_email;
    }

    // something like try catch
    if (empty($name_err) && empty($mobile_err) && empty($email_err)) {
       
        $sql = "INSERT INTO contacts (name, mobile, email) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
        
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_mobile, $param_email);

            
            $param_name = $name;
            $param_mobile = $mobile;
            $param_email = $email;

           
            if (mysqli_stmt_execute($stmt)) {
                // Contact added successfully. Redirect to index page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>