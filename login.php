<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to index page
                           // header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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
    <title>Login</title>
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
<div class="hero_area">
    <div class="bg-box">
      <img src="images//3ejja2.jpg" alt="">
    </div>
        <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <div class="logo">
            <a class="d-block" href="#">
              <img loading="lazy" src="./images/logo2.png" width=160px height=100px alt="Constra">
            </a>
        </div><!-- logo end -->

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
              </li>
                                     <!-- dropdown button.// -->
                                     <li class="nav-item dropdown custom-dropdown">
                              <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">starter</a>
                               <ul class="dropdown-menu">
                                <div class="mega-menu d-flex">
                                  <div class="lista">
                                    <ul class="list-unstyled">
                                      <li><a href="#">Salad </a></li>
                                      <li><a href="#">Bruschetta  </a></li>
                                      <li><a href="#">Soup </a></li>
                                      <li><a href="#">Nachos </a></li>
                                  <!--      <li><a href="#"> </a></li>-->
                                   <!--     <li><a href="#"> </a></li>-->
                                    </ul>
                                  </div>
                                <!--  <div class="lista">
                                    <ul class="list-unstyled"> -->
                                   <!--     <li><a href="#"></a></li>-->
                                   <!--     <li><a href="#"></a></li>-->
                                    <!--    <li><a href="#"></a></li>-->
                                    <!--    <li><a href="#"></a></li>-->
                                    <!--    <li><a href="#"></a></li>-->
                                     <!--   <li><a href="#"></a></li>-->
                                  <!--  </ul>
                                  </div>
                                </div> -->
              
                               </ul>
                           </li>
              <!-- dropdown button.// -->
              <li class="nav-item dropdown custom-dropdown">
                <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">main course</a>
                 <ul class="dropdown-menu">
                  <div class="mega-menu d-flex">
                    <div class="lista">
                      <ul class="list-unstyled">
                        <li><a href="#">Hamburger </a></li>
                        <li><a href="#">Pizza</a></li>
                        <li><a href="#">Pasta </a></li>
                      <!--  <li><a href="#"></a></li> -->
                       <!-- <li><a href="#"></a></li>-->
                      <!--  <li><a href="#"></a></li>-->
                      </ul>
                    </div>
                  <!--  <div class="lista">
                      <ul class="list-unstyled"> -->
                     <!--     <li><a href="#"></a></li>-->
                       <!--   <li><a href="#"></a></li>-->
                       <!--   <li><a href="#"></a></li>-->
                      <!--    <li><a href="#"></a></li>-->
                      <!--    <li><a href="#"></a></li>-->
                      <!--    <li><a href="#"></a></li>-->
                  <!--    </ul>
                    </div>
                  </div> -->

                 </ul>
             </li>
                            <!-- dropdown button.// -->
                            <li class="nav-item dropdown custom-dropdown">
                              <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">dessert</a>
                               <ul class="dropdown-menu">
                                <div class="mega-menu d-flex">
                                  <div class="lista">
                                    <ul class="list-unstyled">
                                      <li><a href="#">cheesecake</a></li>
                                      <li><a href="#">tiramisu</a></li>
                                      <li><a href="#">Cake</a></li>
                                      <li><a href="#">fruit salad</a></li>
                                    <!--    <li><a href="#"></a></li> -->
                                     <!--   <li><a href="#"></a></li>-->
                                    </ul>
                                  </div>
                                <!--  <div class="lista"
                                   <ul class="list-unstyled"> -->
                                  <!--      <li><a href="#"></a></li>-->
                                  <!--      <li><a href="#"></a></li>-->
                                   <!--     <li><a href="#"></a></li>-->
                                   <!--     <li><a href="#"></a></li>-->
                                    <!--    <li><a href="#"></a></li>-->
                                   <!--     <li><a href="#"></a></li>-->
                                 <!--   </ul>
                                  </div>
                                </div> -->
              
                               </ul>
                           </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">about</a>
              </li>
            </ul>
            <!--iconet-->
            <div class="user_option">
               <!-- recherche -->
               <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
              <a href="" class="user_link">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <a class="cart_link" href="#">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                  <g>
                    <g>
                      <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                   c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                    </g>
                  </g>
                  <g>
                    <g>
                      <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                   C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                   c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                   C457.728,97.71,450.56,86.958,439.296,84.91z" />
                    </g>
                  </g>
                  <g>
                    <g>
                      <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                   c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                    </g>
                  </g>
                </svg>
              </a>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>
  <section class="vh-100" style="background-color: white;">
   <div class="mask d-flex align-items-center h-100 gradient-custom-3">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-5">
  <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
              </div>
            </div>
        </div>
      </div>
    </div> 
</section>
    <!-- footer section -->
    <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Contact Us
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  ARIANA VILLE 09 RUE XXX 
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +216 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  Ralouu@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
              Ralouu
            </a>
            <p>
              Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Opening Hours
          </h4>
          <p>
            Everyday
          </p>
          <p>
            10.00 Am -10.00 Pm
          </p>
        </div>
      </div>
    </div>
  </footer>
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