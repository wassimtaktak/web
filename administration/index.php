<?php include('header.php'); ?>
<body>


    <div class="row-fluid">
        <div class="span12">


         

            <div class="container">


<?php include('modal_add.php'); ?>

                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong><i class="icon-user icon-large"></i>&nbsp;Data Table</strong>
                            </div>
                            <thead>
                                <tr>
                                    <th style="text-align:center;">dish's name</th>
                                    <th style="text-align:center;">price</th>
                                    <th style="text-align:center;">description</th>
                                    <th style="text-align:center;">image</th>
									<th style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
								require_once('db.php');
								$result = $conn->prepare("SELECT * FROM aliment ORDER BY id_aliment ASC");
								$result->execute();
								for($i=0; $row = $result->fetch(); $i++){
								$id=$row['id_aliment'];
							?>
								<tr>							
								<td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['libelle_aliment']; ?></td>
								<td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['prix']; ?></td>
								<td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['description']; ?></td>
								<td style="text-align:center; word-break:break-all; width:450px;"> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';?></td>
								<td style="text-align:center; width:350px;">
									<a href="edit.php<?php echo '?id_aliment='.$id; ?>" class="btn btn-info">Edit</a>
									 <a href="#delete<?php echo $id;?>"  data-toggle="modal"  class="btn btn-danger" >Delete </a>
								</td>
									
										<!-- Modal -->
								<div id="delete<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
								<h3 id="myModalLabel">Delete</h3>
								</div>
								<div class="modal-body">
								<p><div style="font-size:larger;" class="alert alert-danger">Are you Sure you want to Delete? <b style="color:red;"> <?php echo $row['libelle_aliment'];?> </b> Data?</p>
								</div>
								<hr>
								<div class="modal-footer">
								<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
								<a href="delete.php<?php echo '?id_aliment='.$id; ?>" class="btn btn-danger">Yes</a>
								</div>
								</div>
								</div>
								</tr>
								<?php } ?>
                            </tbody>
                        </table>


          
        </div>
        </div>
        </div>
    </div>


</body>
</html>


