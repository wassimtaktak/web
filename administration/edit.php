<?php 
include ('header.php'); 
require_once ('config.php');
$ID=$_GET['id_aliment'];
$get_id=$_REQUEST['id_aliment'];
// initialisation 
$libelle_aliment = $prix = $description = "";
$libelle_err = $prix_err = $desc_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    //valider le nom d'utilisateur
    if(empty($_POST["libelle_aliment"]))
    {
        $libelle_err = "Please enter a name";
    }  
    else{
        $libelle_aliment = $_POST["libelle_aliment"];
    }
    
    // Validate password
    if(empty($_POST["price"])){
        $prix_err = "Please enter a price.";     
    }
     else{
        $prix =$_POST["price"];
    }
    
    // Validate phone number
    if(empty($_POST["description"])){
        $desc_err = "Please enter a description.";     
    } 
    else
    {
        $description=$_POST["description"];
    }



    
    // Check input errors before inserting in database
    if(empty($desc_err) && empty($libelle_err)  && empty($prix_err))
    { 
        
        // Prepare an insert statement
        $sql = "UPDATE aliment SET libelle_aliment =?, prix =?, description = ? WHERE id_aliment = ? ";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameter
              mysqli_stmt_bind_param($stmt, "ssss", $param_lib, $param_prix, $param_desc,$param_id);
                
            // Set parameters
            $param_lib = $libelle_aliment;
            $param_prix=$prix;
            $param_desc=$description;
            $param_id=$get_id;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                 header ('location:index.php');
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

<body>


<div class="container">
<div class="hero-unit-header">
 <div class="container-con">
<!-- end banner & menunav -->

<div class="container">
<div class="row-fluid">
<div class="span12">
<div class="row-fluid">
<div class="span3"></div>
<div class="span6">


<div class="hero-unit-3">
<center>

<?php
include('db.php');
$result = $conn->prepare("SELECT * FROM aliment where id_aliment='$ID'");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['id_aliment'];

?>

<form class="form-horizontal" method="post"  enctype="multipart/form-data" style="float: right;">
                                <legend><h4>Edit</h4></legend>
                                <h4>informations to be edited</h4>
                                <hr>
							<!--	<div class="control-group">
                                    <label class="control-label" for="inputPassword">dish's id:</label>
                                    <div class="controls">
                                        <input type="text" name="fname" required value= ?>>
                                    </div> 
                                </div> -->
								<div class="control-group">
                                    <label class="control-label" >dish's name</label>
                                    <div class="controls">
                                        <input type="text" name="libelle_aliment" required value=<?php echo $row['libelle_aliment']; ?> >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" >price:</label>
                                    <div class="controls">
                                        <input type="number" name="price" required value=<?php echo $row['prix']; ?> >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputPassword">description</label>
                                    <div class="controls">
                                        <input type="text" name="description" required value=<?php echo $row['description']; ?> >
                                    </div>
                                </div>                  
								 <div class="control-group">
                                    <div class="controls">

                                        <button type="submit" name="submit" class="btn btn-success" style="margin-right: 65px;">Save</button>
										<a href="index.php" class="btn">Back</a>
                                    </div>
                                </div>
                            </form>
<?php 
}
 ?>
								</center>
								</center>

								</div>
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