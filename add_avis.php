<?php
require_once "config.php";
session_start();
// initialisation 
$avis_client= "";
$avis_err="";

$get_id=$_SESSION['id'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["avis_client"])))
    {
        $avis_err = "Please enter an opinion";
    }
     
    else{
            $avis_client = trim($_POST["avis_client"]);
    }
    
    

    
    // Check input errors before inserting in database
    if(empty($avis_err))
    { 
        // Prepare an insert statement
        $sql = "INSERT INTO avis (avis_c,id_user) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_avis, $param_id);
            
            // Set parameters
            $param_avis = $avis_client;
            $param_id=$get_id;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                 header("location: index.php");
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
    <title>Opinion</title>
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
 <?php
 include ('navbar.php');
 ?>
    <form method="post" enctype="multipart/form-data">
    <div class="form-group purple-border">
     <h2><center>share your opinion </center> </h1>
     <textarea name='avis_client' id="exampleFormControlTextarea4" rows="3"></textarea>
    </div>
    </div>
    <div class="modal-footer">
    <button class="btn"  data-dismiss="modal" aria-hidden="true">Close</button>
    <button type="submit" name="Submit" class="btn btn-primary">Add</button>
    </div>
	

</form>
    </div>	
<?php include ("footer.php"); 
?>
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
