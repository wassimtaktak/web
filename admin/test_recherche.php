<?php
include 'connect.php';
$searchErr = '';
$employee_details=$food='';
//requete li chetjib lmekla lkol
$requete = $con->prepare("select * from aliment order by libelle_aliment");
$requete->execute();
$food = $requete->fetchAll(PDO::FETCH_ASSOC);
// fin
if(isset($_POST['save']))
{
    if(!empty($_POST['search']))
    {
        $search = $_POST['search'];
        $stmt = $con->prepare("select * from aliment where libelle_aliment like '%$search%'");
        $stmt->execute();
        $employee_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($employee_details);
         
    }
    else
    {
        $searchErr = "Please enter the information";
    }
    
}
 
?>
<html>
<head>
<title>ajax example</title>
  <!-- bootstrap core css -->
<link rel="stylesheet" type="text/css" href="traiteur/css/bootstrap.css" />
<!-- font awesome style -->
<link href="traiteur/css/font-awesome.min.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="traiteur/css/style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="traiteur/css/responsive.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
    <h3><u>recherche</u></h3>
    <br/><br/>
    <form class="form-horizontal" action="#" method="post">
    <div class="row">
        <div class="form-group row">
            <label class="control-label col-sm-4" for="email"><b>Search mekla:</b>:</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="search" placeholder="search here">
            </div>
            <div class="col-sm-2">
              <button type="submit" name="save" class="btn btn-success btn-sm">Submit</button>
            </div>
        </div>
        <div class="form-group">
            <span class="error" style="color:red;">* <?php echo $searchErr;?></span>
        </div>
         
    </div>
    </form>
    <br/><br/>
    <h3><u>Search Result</u></h3><br/>
    <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>id</th>
            <th>libelle</th>
            <th>prix</th>
            <th>description</th>
            <th>image</th>
            <th>opérations</th>
          </tr>
        </thead>
        <tbody>
                <?php
                 if(!$employee_details)
                 {
                  foreach($food as $key=>$value)
                  {
                      ?>
                  <tr>
                      <td><?php echo $key+1;?></td>
                      <td><?php echo $value['libelle_aliment'];?></td>
                      <td><?php echo $value['prix'];?></td>
                      <td><?php echo $value['description'];?></td>
                      <!--tcodi l'image en base64 bch taffichiha -->
                      <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $value['image'] ).'"/>';?></td>
                      <td>
                        <div class="but">
                          <input type="button" class="btn btn-primary" value="edit">
                          <input type="button" class="btn btn-danger " value="delete">
                        </div>
                      </td>
                  </tr>
                       
                      <?php
                  }
                 }
                 else{
                    foreach($employee_details as $key=>$value)
                    {
                        ?>
                    <tr>
                        <td><?php echo $key+1;?></td>
                        <td><?php echo $value['libelle_aliment'];?></td>
                        <td><?php echo $value['prix'];?></td>
                        <td><?php echo $value['description'];?></td>
                        <!--tcodi l'image en base64 bch taffichiha -->
                        <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $value['image'] ).'"/>';?></td>
                    </tr>
                         
                        <?php
                    }
                     
                 }
                ?>
             
         </tbody>
      </table>
    </div>
</div>
<script src="traiteur/js/jquery-3.4.1.min.js"></script>
<script src="traiteur/js/bootstrap.js"></script>
</body>
</html>