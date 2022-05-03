	    <!-- Button to trigger modal -->
    <a class="btn btn-primary" href="#myModal" data-toggle="modal">Click Here To Add</a>
	<br>
	<br>
	<br>
    <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">

    <h3 id="myModalLabel">Add</h3>
    </div>
    <div class="modal-body">
	
					<form method="post" action="add.php"  enctype="multipart/form-data">
					<table class="table1">
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">dish's name</label></td>
							<td width="30"></td>
							<td><input type="text" name="libelle" required /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">price</label></td>
							<td width="30"></td>
							<td><input type="number" name="price"  required /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">description</label></td>
							<td width="30"></td>
							<td><textarea type="text" name="description" placeholder="describe your dish" required></textarea></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">image</label></td>
							<td width="30"><label>Upload Image File:</label><br/>
                            <td><input name="userImage" type="file" class="inputFile" /></td>
						</tr>
					<!--	<tr>
							<td><label style="color:#3a87ad; font-size:18px;">Email</label></td>
							<td width="30"></td>
							<td><input type="email" name="email" placeholder="Email" required /></td>
						</tr> -->
						
					</table>
					
	
    </div>
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" name="Submit" class="btn btn-primary">Add</button>
    </div>
	

					</form>
    </div>			