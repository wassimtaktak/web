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
<?php include ('navbar.php');
?> 
 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">username</th>
                                    <th style="text-align:center;">opinion</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
							<?php
								 require_once('db.php');
                                 $result = $conn->prepare("SELECT avis_c FROM avis  ORDER BY id_avis ASC");
                                 $result->execute();
                                 for($i=0; $row = $result->fetch(); $i++)
							?>
								<tr>							
								<td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['avis_client']; ?></td>
                                 
								<td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['id_user']; ?></td>
									<!-- Modal -->
					
</div>
								<hr>
								<div class="modal-footer">
								<a href="index.php"class="btn btn-danger">return</a>
								</div>
								</div>
								</div>
								</tr>
                              
                            </tbody>
                        </table>
<?php include ('footer.php') ?>
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