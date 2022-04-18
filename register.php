<?php
require_once "config.php";
 
// initialisation 
$username = $password = $confirm_password = $date =$phone=$adress= "";
$username_err = $password_err = $confirm_password_err = $confirm_date_err =$phone_err=$adress_err="";
 
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
    else{
        // requete
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
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
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
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


    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($confirm_date_err) && empty($adress_err))
    { 
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, date,telephone,adress) VALUES (?, ?, ? ,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_date,$param_phone,$param_adress);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_date=$date;
            $param_phone=$phone;
            $param_adress=$adress;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                 header("location: login.php");
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="stylelog.css">
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>
<body class="sub_page">
    <!--  header section -->
    <?php include "navbar.php" ?>
    <!-- end header section -->
    <?php echo $date;?>
  <section class="vh-100" style="background-color: white;">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-5">
                <h2><center>Sign Up</center></h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-outline mb-4">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-outline mb-4">
                        <label>date of birth</label>
                        <input type="date" name="birth" class="form-control <?php echo (!empty($confirm_date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_date_err; ?></span>
                    </div>
                    <div class="form-outline mb-4">
                        <label>phone number</label>
                        <input type="text" name="phone" placeholder="00000000" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                        <span class="invalid-feedback"><?php echo $phone_err; ?></span>
                    </div>
                    <div class="form-outline mb-4">
                        <label>adress</label>
                        <input type="text" name="adresse" placeholder="avenue and street detailed" class="form-control <?php echo (!empty($adress_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $adress; ?>">
                        <span class="invalid-feedback"><?php echo $adress_err; ?></span>
                    </div>    
                    <div class="form-outline mb-4">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-outline mb-4">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                    </div>
                        <p>Already have an account? <a href="login.php">Login here</a>.</p>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div> 
</section>
  <!-- footer section -->
  <?php include "footer.php" ?>
  <!-- footer section -->
  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>  
</body>
</html>