<?php
require_once "config.php";
 
$name =  "";
$mobile =  "";
$email = "";
$name_err =  "";
$mobile_err =  "";
$email_err = "";
 
// if have data
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    
    // Validation
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } 
     else{
        $name = $input_name;
    }
    $input_mobile = trim($_POST["mobile"]);
    if(empty($input_mobile)){
        $mobile_err = "Please enter mobile number.";     
    } else{
        $mobile = $input_mobile;
    }
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter the email address.";     
    } 
    else{
        $email = $input_email;
    }

    if(empty($name_err) && empty($mobile_err) && empty($email_err)){
        
        $sql = "UPDATE contacts SET name=?, mobile=?, email=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_mobile, $param_email, $param_id);
            
           
            $param_name = $name;
            $param_mobile = $mobile;
            $param_email = $email;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} 
else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM contacts WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $name = $row["name"];
                    $mobile = $row["mobile"];
                    $email = $row["email"];
                } else{
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        mysqli_stmt_close($stmt);
        
        mysqli_close($link);
    }  else{
        header("location: error.php");
        exit();
    }
}
?>