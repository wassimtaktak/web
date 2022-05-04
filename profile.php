<?php
session_start();
$username = $password = $confirm_password = $date =$phone=$adress= "";
$username_err = $password_err = $confirm_password_err = $confirm_date_err =$phone_err=$adress_err="";
include ("config.php");
$id_cli=$_SESSION['id'];
$query = "SELECT * FROM users WHERE id=$id_cli";
$result = $link->query($query);
$row = $result->fetch_assoc();
$phone=$row["telephone"];
$adress=$row["adress"];
$date=$row["date"];
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //valider le nom d'utilisateur
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter a username";
    }
     elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"])))
    {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } 
    elseif(trim($_POST["username"])!=$_SESSION['username']){
        // requete
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            
            // executerla requete
            if(mysqli_stmt_execute($stmt)){
            //store the stmt
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    else 
    {
        $username = trim($_POST["username"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm password.";     
    } 
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    // Validate date of birth
    if(empty(trim($_POST["birth"])))
    {
        $confirm_date_err = "Please confirm your date of birth.";     
    }
    else 
    {
        $date = trim($_POST["birth"]); 
    }
    // Validate phone number
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter you phone number.";     
    } 
    elseif (!preg_match('`[0-9]`',trim($_POST["phone"])))
    {
        $phone_err = "only number";
    }
    elseif(strlen(trim($_POST["phone"])) < 8)
    {
        $phone_err = "phone number must have atleast 8 characters.";
    } 
    else
    {
        $phone=$_POST["phone"];
    }
    //validate adress
    if(empty(trim($_POST["adresse"])))
    {
        $adress_err = "Please confirm your adress.";     
    }
    else 
    {
        $adress = trim($_POST["adresse"]); 
    }

    echo $username_err;
    echo $password_err;
    echo $confirm_password_err;
    echo $confirm_date_err;
    echo $adress_err;
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($confirm_date_err) && empty($adress_err))
    { 
        // Prepare an insert statement
        echo "tnezlet";
        $sql = "UPDATE users  SET username =? ,password=?, date=? , telephone=? ,adress=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_date,$param_phone,$param_adress,$id_cli);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_date=$date;
            $param_phone=$phone;
            $param_adress=$adress;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                //echo "tzedet";
                $_SESSION['id']=$username;
                //sweetalert lenna
                // header("location: index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
           }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap core css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<!-- font awesome style -->
<link href="css/font-awesome.min.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="css/responsive.css" rel="stylesheet" />
    <title>profile</title>
</head>
<body>
<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="images\768px-Circle-icons-profile.svg.png" alt="">
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                            <input class="form-control" name="username" type="text" placeholder="Enter your username" value="<?php echo $_SESSION['username']?>">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Password</label>
                                <input class="form-control" name="password" type="password" placeholder="Enter your Password" value="<?php echo $_SESSION['password']?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Confirm Password</label>
                                <input class="form-control" name="confirm_password" type="password" placeholder="Confirm your Password" value="<?php echo $_SESSION['password']?>">
                            </div>
                        </div>
                    <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" id="inputBirthday" type="date" name="birth" placeholder="Enter your birthday" value="<?php echo $date?>">
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Phone number</label>
                                <input class="form-control" name="phone" type="text" placeholder="Enter your phone number" value="<?php echo $phone?>">
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Address</label>
                            <input class="form-control" name="adresse" type="text" placeholder="Enter your address" value="<?php echo $adress?>">
                        </div>
                    <!-- Form Row-->
                        <!-- Save changes button-->
                        <input type="submit" class="btn btn-primary" value="Save changes">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>